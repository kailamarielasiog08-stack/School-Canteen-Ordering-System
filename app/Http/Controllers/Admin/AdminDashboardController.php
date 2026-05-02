<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\MenuItem;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalMenuItems = MenuItem::count();
        $totalOrders = Order::count(); 

        return view('admin.dashboard', compact('totalStudents', 'totalMenuItems', 'totalOrders'));
    }

    public function students()
    {
        $students = User::where('role', 'student')->latest()->get();
        return view('admin.students.index', compact('students'));
    }
}
