<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index() {
        $title = 'Dashboard';

        return view('backend.dashboard')->with(compact('title'));
    }
}
