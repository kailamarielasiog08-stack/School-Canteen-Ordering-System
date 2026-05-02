<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\MenuItem;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $categories = Category::with('menuItems')->get();
        return view('student.dashboard', compact('categories'));
    }

    public function menu()
    {
        $categories = Category::all();
        $menuItems = MenuItem::where('is_available', true)->with('category')->get();
        return view('student.menu', compact('categories', 'menuItems'));
    }
}
