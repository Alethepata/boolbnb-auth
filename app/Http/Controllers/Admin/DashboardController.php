<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $apartments = Apartment::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        return view('admin.dashboard', compact('apartments'));
    }
}
