<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RsvpResponse;
use App\Models\WeddingCard;

class RsvpController extends Controller
{
    public function index()
    {
        $responses = RsvpResponse::with('weddingCard')
            ->latest()->paginate(20);
        return view('admin.rsvp.index', compact('responses'));
    }

    public function destroy(RsvpResponse $rsvp)
    {
        $rsvp->delete();
        return back()->with('success', 'RSVP removed.');
    }
    
// RsvpController store
public function store(Request $request, string $card)
{
    $weddingCard = \App\Models\WeddingCard::where('slug', $card)
        ->where('is_active', true)
        ->firstOrFail();

    $validated = $request->validate([
        'guest_name' => 'required|string|max:255',
        'phone'      => 'nullable|string|max:50',
        'attendance' => 'required|in:yes,no',
        'pax'        => 'nullable|integer|min:1|max:20',
    ]);

    $validated['wedding_card_id'] = $weddingCard->id;
    $validated['pax'] = $validated['attendance'] === 'yes'
        ? ($validated['pax'] ?? 1) : 0;

    \App\Models\RsvpResponse::create($validated);

    return response()->json([
        'success'   => true,
        'message'   => 'RSVP received!',
        'attending' => $weddingCard->rsvpResponses()->where('attendance','yes')->sum('pax'),
        'declined'  => $weddingCard->rsvpResponses()->where('attendance','no')->count(),
    ]);
}

}