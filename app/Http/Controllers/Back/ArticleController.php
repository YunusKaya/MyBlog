<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Front\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Front\Article;
use App\Models\Front\Category;

class ArticleController extends Controller
{
    //

    public  function __construct()
    {
        view()->share('contacts',contact::where('Flag',0)->limit(5)->get());
    }

    public function index()
    {
        $articles = Article::all();
        return view('Back.article.index',compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Back.article.create',compact('categories'));

    }

    public function create_post(Request $request)
    {
        $request->validate([
            'title'=>'min:3|required',
            'category'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            'conten'=>'min:10|required'
        ]);

        $isCategory = Category::where('id',$request->category)->first();

        if (!$isCategory)
        {
            toastr()->error('Seçilen kategori veri tabanında bulunamadı.','Hata');
            return redirect()->back();
        }
        $article=new Article();
        $article->user_id = Auth::user()->id;
        $article->category_id=$request->category;
        $article->title=$request->title;
        $article->article=$request->conten;
        $article->slug=Str::slug($request->title);

        if($request->hasFile('image'))
        {
            $imageName = uniqid() . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/img'), $imageName);
            $article->img = 'uploads/img/' . $imageName;
        }
        $article->save();

        toastr()->success( 'Makale başırıyla oluşturuldu','Başarılı');
        return redirect()->route('admin.article.index');
    }

    public function update($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id);
        return view('Back.article.update',compact('article','categories'));
    }

    public function update_post(Request $request)
    {


        $request->validate([
            'title'=>'min:3|required',
            'category'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            'conten'=>'min:10|required'
        ]);

        $isSlug=Article::where('slug',Str::slug($request->title))->whereNotIn('id',[$request->id])->first();

        if ($isSlug)
        {
            toastr()->error($request->title.' adında bir makale zaten mevcut.');
            return redirect()->back();
        }

        $article=Article::findOrFail($request->id);
        $article->user_id = Auth::user()->id;
        $article->category_id=$request->category;
        $article->title=$request->title;
        $article->article=$request->conten;
        $article->slug=Str::slug($request->title);


        if($request->hasFile('image'))
        {
            if (File::exists($article->img))
            {
                File::delete(public_path($article->img));
            }
            $imageName = uniqid() . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/img'), $imageName);
            $article->img = 'uploads/img/' . $imageName;
        }

        $article->save();
        toastr()->success( 'Makale başırıyla güncellendi','Başarılı');
        return redirect()->route('admin.article.index');
    }

    public function delete(Request $request)
    {

        $article=Article::findOrFail($request->id);
        if (File::exists($article->img))
        {
            File::delete(public_path($article->img));
        }
        $article->delete();
        toastr()->success('Makale başırıyla Silindi','Başarılı');
        return redirect()->route('admin.article.index');
    }
}
