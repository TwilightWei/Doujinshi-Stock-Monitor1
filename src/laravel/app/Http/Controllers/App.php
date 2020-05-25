<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class App extends Controller
{
    # Show the web page of booklist
    public function show()
    {
        return view('booklist');
    }
}
