<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Front\contact;
use Illuminate\Http\Request;
use App\Models\Front\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public  function __construct()
    {
        view()->share('contacts',contact::where('Flag',0)->limit(5)->get());
    }

    public function index()
    {
        $categories = Category::all();
        return view('back.category.index',compact('categories'));
    }
    public function category_post(Request $request)
    {
        //dd($request->post());

        $request->validate([
            'name'=>'min:3|required',
        ]);

        $isSlug = Category::where('name',$request->name)->first();

        if ($isSlug)
        {
            toastr()->error($request->name.' adında bir kategori zaten mevcut.','Hata');
            return redirect()->back();
        }

        $category=new Category;
        $category->name = $request->name;
        $category->slug=Str::slug($request->name);

        $category->save();
        toastr()->success( 'Kategori başırıyla oluşturuldu','Başarılı');
        return redirect()->route('admin.category.index');
    }

    public function category_edit($id)
    {
        $category=Category::findOrFail($id);
        return view('back.category.update',compact('category'));
    }

    public function category_edit_post(Request $request)
    {

        $request->validate([
            'name'=>'min:3|required',
        ]);
        $isSlug=Category::where('name',$request->name)->where('id','<>',$request->id)->first();

        if ($isSlug)
        {
            toastr()->error($request->name.' adında bir kategori zaten mevcut.');
            return redirect()->back();
        }

        $category=Category::findOrFail($request->id);
        $category->name=$request->name;
        $category->slug=Str::slug($request->name);


        $category->save();

        toastr()->success('Kategori başarıyla kaydedildi.','Başarılı');
        return redirect()->route('admin.category.index');
    }

    public function category_delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->delete();
        toastr()->success('Kategori başarıyla silindi','Başarılı');
        return redirect()->back();
    }
}
