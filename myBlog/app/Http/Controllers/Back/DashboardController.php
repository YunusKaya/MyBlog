<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Front\contact;

class DashboardController extends Controller
{
    public  function __construct()
    {
        view()->share('contacts',contact::where('Flag',0)->limit(5)->get());
    }
    public function index()
    {
        return view('Back.dashboard');
    }
}
