<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\MenuItem;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalMenuItems = MenuItem::count();
        // Placeholder for orders (Phase 4)
        $totalOrders = 0; 

        return view('admin.dashboard', compact('totalStudents', 'totalMenuItems', 'totalOrders'));
    }

    public function students()
    {
        $students = User::where('role', 'student')->latest()->get();
        return view('admin.students.index', compact('students'));
    }
}
