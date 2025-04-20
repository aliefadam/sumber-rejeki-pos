<?php

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists("setNotification")) {
    function setNotification($icon, $title, $text)
    {
        return [
            "icon" => $icon,
            "title" => $title,
            "text" => $text,
        ];
    }
}

if (!function_exists("getMenuSidebar")) {
    function getMenuSidebar()
    {
        if (Auth::check()) {
            return Menu::where("role", Auth::user()->role)->get();
        }
        return;
    }
}

if (!function_exists("active_sidebar")) {
    function active_sidebar($url)
    {
        return request()->is($url) || request()->is($url . '/*') ? 'text-white bg-gray-700' : 'text-gray-700 hover:bg-gray-100';
    }
}

if (!function_exists("redirect_user")) {
    function redirect_user(
        $icon,
        $text,
        $route = "",
    ) {
        return $route != ""
            ? redirect()->route($route)->with("notification", [
                "icon" => $icon,
                "title" => $icon == "success" ? "Success" : "Error",
                "text" => $text,
            ])
            : redirect()->back()->with("notification", [
                "icon" => $icon,
                "title" => $icon == "success" ? "Success" : "Error",
                "text" => $text,
            ]);
    }
}

if (!function_exists("format_rupiah")) {
    function format_rupiah($number)
    {
        $formattedNumber = number_format($number, 0, ',', '.');
        return 'Rp ' . $formattedNumber;
    }
}

if (!function_exists("notificationFlash")) {
    function notificationFlash($icon, $text)
    {
        session()->flash("notification", [
            "icon" => $icon,
            "title" => $icon == "success" ? "Success" : "Error",
            "text" => $text,
        ]);
    }
}

if (!function_exists("getTransactionOneYear")) {
    function getTransactionOneYear()
    {
        $months = range(1, 12);
        $transactions = Transaction::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as total_transactions'),
            DB::raw('SUM(total) as total_revenue')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy('month');

        $monthlyTransactions = collect($months)->map(function ($month) use ($transactions) {
            return [
                'month' => $month,
                'total_transactions' => $transactions[$month]->total_transactions ?? 0,
                'total_revenue' => $transactions[$month]->total_revenue ?? 0.0,
            ];
        });

        return $monthlyTransactions;
    }
}
