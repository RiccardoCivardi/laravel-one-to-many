<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $count_project = Project::count();

        // dd($count_project);

        return view('admin.home', compact('count_project'));
    }
}
