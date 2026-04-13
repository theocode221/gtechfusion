<?php
namespace App\Http\Controllers;

use App\Models\WeddingCard;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function show(string $slug)
    {
        // Find card by slug, 404 if not found
        $card = WeddingCard::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Load RSVP count and wishes
        $attending = $card->rsvpResponses()
            ->where('attendance', 'yes')
            ->sum('pax');

        $declined = $card->rsvpResponses()
            ->where('attendance', 'no')
            ->count();

        $wishes = $card->wishes()
            ->latest()
            ->take(20)
            ->get();

        return view('cards.template', compact(
            'card',
            'attending',
            'declined',
            'wishes'
        ));
    }
}