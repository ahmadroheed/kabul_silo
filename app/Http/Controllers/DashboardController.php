<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::count();
        $totalSliders = Slider::count();
        $totalGallery = Gallery::count();
        $totalUsers = User::count();
        return view('backend.dashboard.index',compact('totalNews', 'totalSliders', 'totalGallery','totalUsers')); // Assuming your dashboard view is in resources/views/dashboard/index.blade.php
    }
}
