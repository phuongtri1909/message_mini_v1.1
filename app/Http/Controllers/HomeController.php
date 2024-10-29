<?php

namespace App\Http\Controllers;

use App\Models\Socials;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('pages.home');
    }
    public function listfriend()
    {
        return view('pages.friend.listfriend');
    }

    public function loimoi()
    {
        
        return view('pages.friend.loimoi');
    }
}
