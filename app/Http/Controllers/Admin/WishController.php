<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wish;

class WishController extends Controller
{
    public function index()
    {
        $wishes = Wish::with('weddingCard')->latest()->paginate(20);
        return view('admin.wishes.index', compact('wishes'));
    }

    public function destroy(Wish $wish)
    {
        $wish->delete();
        return back()->with('success', 'Wish removed.');
    }
    
// WishController store
public function store(Request $request, string $card)
{
    $weddingCard = \App\Models\WeddingCard::where('slug', $card)
        ->where('is_active', true)
        ->firstOrFail();

    $validated = $request->validate([
        'guest_name' => 'required|string|max:255',
        'message'    => 'required|string|max:1000',
    ]);

    $validated['wedding_card_id'] = $weddingCard->id;
    $wish = \App\Models\Wish::create($validated);

    return response()->json([
        'success' => true,
        'wish'    => [
            'name'    => $wish->guest_name,
            'message' => $wish->message,
        ],
    ]);
}


}