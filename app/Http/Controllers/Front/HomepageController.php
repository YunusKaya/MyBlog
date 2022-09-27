<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Front\Article;
use App\Models\Front\Category;
use App\Models\Front\contact;

class HomepageController extends Controller
{
    //

    public  function __construct()
    {
        view()->share('catagories',Category::all());
    }

    public function index()
    {
        $article = Article::Orderby('updated_at')->paginate(10);
        $category_name = "Tüm Makaleler";
        return view('Front.index',compact('article','category_name'));
    }

    public function category($slug)
    {
        $category_name = "";
        if ($slug == 'tum-makaleler')
        {
            $article = Article::Orderby('updated_at')->paginate(10);
            $category_name = "Tüm Makaleler";
        }
        else
        {
            $category = Category::where('slug',$slug)->first();
            $article = Article::where('category_id',$category->id)->Orderby('updated_at')->paginate(10);
            $category_name = $category->name;
        }
        return view('Front.index',compact('article','category_name'));
    }

    public function ArticleDetail ($slug)
    {
        $article = Article::where('slug',$slug)->first();
        return view('Front.ArticleDetail',compact('article'));
    }

    public function writers()
    {
        $writers = User::paginate(12);
        return view('Front.writers',compact('writers'));
    }

    public function contact()
    {
        return view('Front.contact');
    }

    public function contactPost(Request $request)
    {
        $rules=[
            'firstname'=>'required|min:3',
            'lastname'=>'required|min:3',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);
        if ($validate->fails())
        {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        $contact = new contact();
        $contact->firstName = $request->firstname;
        $contact->lastName = $request->lastname;
        $contact->Subject = $request->subject;
        $contact->email = $request->email;
        $contact->Message = $request->message;

        $contact->save();
        return redirect()->route('contact')->with('success','Mesajınız başarı bir şekilde iletildi');
    }
}
