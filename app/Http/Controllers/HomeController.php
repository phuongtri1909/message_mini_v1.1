<?php

namespace App\Http\Controllers;

use App\Models\Socials;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $socials = Socials::all();
        return view('pages.home', compact('socials'));
    }
}
