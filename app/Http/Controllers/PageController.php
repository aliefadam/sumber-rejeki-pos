<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function direct()
    {
        return to_route("admin.dashboard");
    }

    public function dashboard()
    {
        return view("dashboard", [
            "title" => "Dashboard",
        ]);
    }
}
