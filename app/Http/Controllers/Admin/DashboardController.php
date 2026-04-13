<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingCard;
use App\Models\RsvpResponse;
use App\Models\Wish;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCards   = WeddingCard::count();
        $activeCards  = WeddingCard::where('is_active', true)->count();
        $totalRsvp    = RsvpResponse::count();
        $totalWishes  = Wish::count();
        $recentCards  = WeddingCard::withCount(['rsvpResponses','wishes'])
                            ->latest()->take(5)->get();
        $recentRsvp   = RsvpResponse::with('weddingCard')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCards','activeCards','totalRsvp',
            'totalWishes','recentCards','recentRsvp'
        ));
    }
}