<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Link;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController  extends Controller
{
    public function index(){
        $userCount = User::where('is_admin', 0)->count();
        $projectCount = Project::count();
        $adsCount = Ad::count();
        $projects = Project::with('user','promoted_project')->latest()->take(10)->get();
        $ads = Ad::with('user')->latest()->take(10)->get();
        return view('pages.index', compact('ads', 'userCount','projectCount','adsCount','projects'));
    }
    public function redirect(){
        return redirect()->route('dashboard');
    }
}
