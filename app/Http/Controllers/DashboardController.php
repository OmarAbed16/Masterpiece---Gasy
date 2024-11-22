<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;  // Payment model to get sales amount
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's Data
        $todayCustomerCount = User::where('role', 'customer')
                                  ->where('is_deleted', '0')
                                  ->whereDate('created_at', Carbon::today())
                                  ->count();

        $todayDriverCount = User::where('role', 'driver')
                                ->where('is_deleted', '0')
                                ->whereDate('created_at', Carbon::today())
                                ->count();

        $todayOrderCount = Order::whereDate('created_at', Carbon::today())
                                ->count();

        // Corrected Sales Calculation: Join Payments with Orders and sum 'amount' for today's orders
        $todaySalesSum = Payment::join('orders', 'payments.order_id', '=', 'orders.order_id')  // Correct join on order_id
                                ->whereDate('orders.created_at', Carbon::today())  // Filtering orders created today
                                ->sum('payments.amount');  // Sum the 'amount' from Payments table

        // Yesterday's Data
        $yesterdayCustomerCount = User::where('role', 'customer')
                                      ->where('is_deleted', '0')
                                      ->whereDate('created_at', Carbon::yesterday())
                                      ->count();

        $yesterdayDriverCount = User::where('role', 'driver')
                                    ->where('is_deleted', '0')
                                    ->whereDate('created_at', Carbon::yesterday())
                                    ->count();

        $yesterdayOrderCount = Order::whereDate('created_at', Carbon::yesterday())
                                     ->count();

        // Corrected Sales Calculation for Yesterday: Join Payments with Orders and sum 'amount' for yesterday's orders
        $yesterdaySalesSum = Payment::join('orders', 'payments.order_id', '=', 'orders.order_id')  // Correct join on order_id
                                     ->whereDate('orders.created_at', Carbon::yesterday())  // Filtering orders created yesterday
                                     ->sum('payments.amount');  // Sum the 'amount' from Payments table

        // Calculate percentage change for each metric
        $customerChange = $this->calculatePercentageChange($todayCustomerCount, $yesterdayCustomerCount);
        $driverChange = $this->calculatePercentageChange($todayDriverCount, $yesterdayDriverCount);
        $orderChange = $this->calculatePercentageChange($todayOrderCount, $yesterdayOrderCount);
        $salesChange = $this->calculatePercentageChange($todaySalesSum, $yesterdaySalesSum);

        return view('dashboard.index', compact(
            'todayCustomerCount', 'todayDriverCount', 'todayOrderCount', 'todaySalesSum',
            'yesterdayCustomerCount', 'yesterdayDriverCount', 'yesterdayOrderCount', 'yesterdaySalesSum',
            'customerChange', 'driverChange', 'orderChange', 'salesChange'
        ));
    }

    private function calculatePercentageChange($todayValue, $yesterdayValue)
    {
        if ($yesterdayValue == 0) {
            return $todayValue == 0 ? 0 : 100;
        }
        return (($todayValue - $yesterdayValue) / $yesterdayValue) * 100;
    }
}
