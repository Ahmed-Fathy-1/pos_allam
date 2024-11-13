<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin\ContactUs;
use App\Models\SuperAdmin\FeedBack;
use App\Models\SuperAdmin\User;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $domainsCount = Tenant::count();
        $feedbackCount = FeedBack::count();
        $contactusCount = ContactUs::count();

        /**
         * Charts
         */
        $userCounts = [];
        $domainsCounts = [];
        $feedbackCounts = [];
        $contactusCounts = [];
        $months = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('F Y');

            /**
             * Count Monthly Number
             */
            $userCounts[] = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $domainsCounts[] = Tenant::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $feedbackCounts[] = FeedBack::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $contactusCounts[] = ContactUs::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return view('home', compact(
            'userCounts', 'domainsCounts', 'feedbackCounts', 'contactusCounts',
            'months', 'userCount', 'domainsCount', 'feedbackCount', 'contactusCount'
        ));
    }
}
