<?php

namespace App\Http\Controllers;

use App\Models\User;

use Carbon\Carbon;

class DashboardController extends Controller
{
    // Displays dashboard with customer count and sales sum
    public function index()
    {
        $todayCustomerCount = $this->getTodayCustomerCount();
        $todaySalesSum = $this->getTodaySalesSum();
        return view('dashboard.index', compact('todayCustomerCount', 'todaySalesSum'));
    }

    // Gets the count of customers created today
    private function getTodayCustomerCount()
    {
        $today = Carbon::today();
        return User::where('role', 'customer')
                   ->where('is_deleted', '0') // Add this condition
                   ->whereDate('created_at', $today)
                   ->count();
    }
    
    // Gets the sum of sales for today
    private function getTodaySalesSum()
    {
       
        return "d";
    }
}
