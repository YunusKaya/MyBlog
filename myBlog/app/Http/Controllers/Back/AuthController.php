<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Front\contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public  function __construct()
    {
        view()->share('contacts',contact::where('Flag',0)->limit(5)->get());
    }

    public function login()
    {
        return view('back.auth.login');
    }

    public function loginPost(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            toastr()->success('Tekrar hoş geldiniz', Auth::user()->name);
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->route('login.index')->withErrors('Email adresi veya şifre hatalı!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    public function profile()
    {
        return view('Back.auth.profile');
    }

    public function profile_post(Request $request)
    {

        $request->validate([
            'name'=>'min:3|required',
            'email'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            'borderImage'=>'image|mimes:jpeg,png,jpg|max:2048',
            'conten'=>'min:10|required'
        ]);

        $isSlug=User::where('email',$request->email)->whereNotIn('id',[$request->id])->first();

        if ($isSlug)
        {
            toastr()->error($request->email.' adresi kullanılmaktadır. Başka bir adres giriniz.','Hata');
            return redirect()->back();
        }

        $user=User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email=$request->email;
        $user->biography=$request->conten;
        $user->slug=Str::slug($request->name).uniqid();


        if($request->hasFile('image'))
        {
            if (File::exists($user->img))
            {
                File::delete(public_path($user->img));
            }
            $imageName = uniqid() . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/profil'), $imageName);
            $user->img = 'uploads/profil/' . $imageName;
        }

        if($request->hasFile('borderImage'))
        {
            if (File::exists($user->borderimg))
            {
                File::delete(public_path($user->borderimg));
            }
            $imageName = uniqid() . $request->borderImage->getClientOriginalName();
            $request->borderImage->move(public_path('uploads/profil'), $imageName);
            $user->borderimg = 'uploads/profil/' . $imageName;
        }


        $user->save();
        toastr()->success( 'Profil bilgileri başırıyla güncellendi','Başarılı');
        return redirect()->route('admin.profile');
    }

    public function settings()
    {
        return view('Back.auth.settings');
    }

    public function settings_post(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'min:4|required'
        ]);
        $user=User::findOrFail($request->id);

        $user->email=$request->email;
        $user->password=bcrypt($request->password);

        $user->save();
        toastr()->success( 'Şifre başırıyla güncellendi','Başarılı');
        return redirect()->route('admin.settings');
    }

    public function message()
    {
        $contacts = contact::OrderBy('Flag','desc')->get();
        return view('Back.auth.message',compact('contacts'));
    }
}
