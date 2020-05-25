<?php

namespace App\Http\Controllers;

use App\Doujinshi;
use Illuminate\Http\Request;

class App extends Controller
{
    # Show the web page of booklist
    public function show()
    {
        $booklist = Doujinshi::all();
        return view('booklist')->with('booklist', $booklist);
    }
}
