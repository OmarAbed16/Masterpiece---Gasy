<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
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

        $todaySalesSum = Payment::join('orders', 'payments.order_id', '=', 'orders.order_id')
                                ->whereDate('orders.created_at', Carbon::today())
                                ->sum('payments.amount');

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

        $yesterdaySalesSum = Payment::join('orders', 'payments.order_id', '=', 'orders.order_id')
                                     ->whereDate('orders.created_at', Carbon::yesterday())
                                     ->sum('payments.amount');

        $customerChange = $this->calculatePercentageChange($todayCustomerCount, $yesterdayCustomerCount);
        $driverChange = $this->calculatePercentageChange($todayDriverCount, $yesterdayDriverCount);
        $orderChange = $this->calculatePercentageChange($todayOrderCount, $yesterdayOrderCount);
        $salesChange = $this->calculatePercentageChange($todaySalesSum, $yesterdaySalesSum);

        $sales = Payment::join('orders', 'payments.order_id', '=', 'orders.order_id')
                        ->selectRaw('MONTH(orders.created_at) as month, SUM(payments.amount) as total_sales')
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $salesData = array_fill(0, 12, 0);

        foreach ($sales as $sale) {
            $salesData[$sale->month - 1] = $sale->total_sales;
        }

        // Static list of governorates
        $allGovernorates = ['Amman', 'Zarqa', 'Irbid', 'Aqaba', 'Mafraq', 'Karak', 'Maan', 'Ajloun', 'Balqa', 'Jerash', 'Tafilah', 'Madaba'];

        // Fetch the order counts by governorate
        $governorateData = Order::join('users', 'orders.user_id', '=', 'users.id')
                                ->select('users.governorate', DB::raw('COUNT(*) as count'))
                                ->where('users.is_deleted', '0')
                                ->groupBy('users.governorate')
                                ->orderBy('users.governorate')
                                ->get();

        // Initialize an array for storing the order counts by governorate
        $governorateCounts = [];

        // Loop through the static governorates list and count the orders for each
        foreach ($allGovernorates as $governorate) {
            $governorateCounts[$governorate] = $governorateData->firstWhere('governorate', $governorate) ? 
                                                $governorateData->firstWhere('governorate', $governorate)->count : 
                                                0;
        }

        // Extract the labels (governorate names) and counts
        $governorateLabels = array_keys($governorateCounts);
        $governorateCounts = array_values($governorateCounts);

        // Order Fulfillment Time Data
        $monthlyFulfillmentTimes = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('AVG(TIMESTAMPDIFF(SECOND, created_at, delivery_time)) / 60 as avg_fulfillment_time') // Fulfillment time in minutes
            )
            ->whereNotNull('delivery_time')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $avgFulfillmentTimes = [];
        for ($i = 1; $i <= 12; $i++) {
            $avgFulfillmentTimes[] = $monthlyFulfillmentTimes->firstWhere('month', $i)
                                      ? $monthlyFulfillmentTimes->firstWhere('month', $i)->avg_fulfillment_time
                                      : 0;
        }

        return view('dashboard.index', compact(
            'todayCustomerCount', 'todayDriverCount', 'todayOrderCount', 'todaySalesSum',
            'yesterdayCustomerCount', 'yesterdayDriverCount', 'yesterdayOrderCount', 'yesterdaySalesSum',
            'customerChange', 'driverChange', 'orderChange', 'salesChange',
            'salesData', 'months',
            'governorateLabels', 'governorateCounts',
            'avgFulfillmentTimes'
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
