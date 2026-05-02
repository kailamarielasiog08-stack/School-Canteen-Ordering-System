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
        $readyOrders = auth()->user()->orders()->where('status', 'ready')->get();
        return view('student.dashboard', compact('categories', 'readyOrders'));
    }

    public function menu(Request $request)
    {
        $categories = Category::all();
        
        $query = MenuItem::where('is_available', true)->with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $menuItems = $query->get();
        
        return view('student.menu', compact('categories', 'menuItems'));
    }
}
