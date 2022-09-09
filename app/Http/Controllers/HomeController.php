<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $browser = $_SERVER['HTTP_USER_AGENT'];
        Log::info($browser);

        if(auth()->check() && auth()->user()->active == false){
            return redirect()->to('/');
        }
        return view('home');
    }
}
