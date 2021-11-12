<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{    
    public function __construct(Request $request) {
        if (!$request->session()->get('token')) {
            redirect('login')->send();
        }
    }
    
    public function index(Request $request)
    {
        
        return view('layouts.app');
    }
}