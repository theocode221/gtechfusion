<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingCard;
use App\Models\RsvpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeddingCardController extends Controller
{
    // ─────────────────────────────────────────
    // Shared validation rules
    // ─────────────────────────────────────────
    private function validationRules(bool $isUpdate = false): array
    {
        $photoRule = 'nullable|image|max:262144';

        return [
            // Couple
            'groom_name'      => 'required|string|max:255',
            'groom_name_card' => 'nullable|string|max:100',
            'bride_name'      => 'required|string|max:255',
            'bride_name_card' => 'nullable|string|max:100',
            'groom_father'    => 'nullable|string|max:255',
            'groom_mother'    => 'nullable|string|max:255',
            'bride_father'    => 'nullable|string|max:255',
            'bride_mother'    => 'nullable|string|max:255',

            // Event
            'wedding_date'    => 'required|date',
            'hijri_date'      => 'nullable|string|max:100',
            'wedding_time'    => 'required|string|max:100',
            'rsvp_deadline'   => 'nullable|date',
            'venue_name'      => 'required|string|max:255',
            'venue_address'   => 'required|string|max:500',
            'maps_url'        => 'nullable|url|max:2048',
            'dress_code'      => 'nullable|string|max:255',

            // Story
            'story_1_year'    => 'nullable|string|max:30',
            'story_1_title'   => 'nullable|string|max:255',
            'story_1_desc'    => 'nullable|string|max:1000',
            'story_2_year'    => 'nullable|string|max:30',
            'story_2_title'   => 'nullable|string|max:255',
            'story_2_desc'    => 'nullable|string|max:1000',
            'story_3_year'    => 'nullable|string|max:30',
            'story_3_title'   => 'nullable|string|max:255',
            'story_3_desc'    => 'nullable|string|max:1000',
            'story_4_year'    => 'nullable|string|max:30',
            'story_4_title'   => 'nullable|string|max:255',
            'story_4_desc'    => 'nullable|string|max:1000',

            // Digital gift
            'tng_number'      => 'nullable|string|max:100',
            'bank_name'       => 'nullable|string|max:100',
            'bank_number'     => 'nullable|string|max:100',
            'bank_holder'     => 'nullable|string|max:255',
            'qr_image' => 'nullable|image|max:262144',

            // Photos
            'photo_1'         => $photoRule,
            'photo_2'         => $photoRule,
            'photo_3'         => $photoRule,

            // Settings
            'music_url'       => 'nullable|url|max:2048',
            'theme'           => 'nullable|string|max:50',
            'is_active'       => 'boolean',
        ];
    }

    // ─────────────────────────────────────────
    // Handle photo uploads — store new, keep old, delete replaced
    // ─────────────────────────────────────────
    private function handlePhotoUpload(Request $request, ?WeddingCard $card = null): array
    {
        $photos = [];

        foreach (['photo_1', 'photo_2', 'photo_3', 'qr_image'] as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                // Delete old file from storage if editing
                if ($card && $card->$field) {
                    Storage::disk('public')->delete($card->$field);
                }
                // Store new file
                $photos[$field] = $request->file($field)
                    ->store('wedding-photos', 'public');
            } elseif ($card) {
                // Keep existing path when editing without new upload
                $photos[$field] = $card->$field;
            }
        }

        return $photos;
    }

    // ─────────────────────────────────────────
    // INDEX
    // ─────────────────────────────────────────
    public function index()
    {
        $cards = WeddingCard::withCount(['rsvpResponses', 'wishes'])
            ->latest()
            ->paginate(15);

        $stats = [
            'total'     => WeddingCard::count(),
            'active'    => WeddingCard::where('is_active', true)->count(),
            'inactive'  => WeddingCard::where('is_active', false)->count(),
            'totalRsvp' => RsvpResponse::count(),
        ];

        return view('admin.cards.index', compact('cards', 'stats'));
    }

    // ─────────────────────────────────────────
    // CREATE
    // ─────────────────────────────────────────
    public function create()
    {
        return view('admin.cards.create');
    }

    // ─────────────────────────────────────────
    // STORE
    // ─────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        // Auto-generate slug
        $validated['slug'] = WeddingCard::generateSlug(
            $validated['groom_name'],
            $validated['bride_name']
        );

        // Handle photo uploads
        $photos = $this->handlePhotoUpload($request);

        // Merge photos into validated data
        $card = WeddingCard::create(array_merge($validated, $photos));

        return redirect()
            ->route('admin.cards.show', $card)
            ->with('success', "Card for {$card->groom_name} & {$card->bride_name} created successfully! 💍");
    }

    // ─────────────────────────────────────────
    // SHOW
    // ─────────────────────────────────────────
    public function show(WeddingCard $card)
    {
        $card->load([
            'rsvpResponses' => fn($q) => $q->latest(),
            'wishes'        => fn($q) => $q->latest(),
        ]);

        $attending = $card->rsvpResponses->where('attendance', 'yes')->sum('pax');
        $declined  = $card->rsvpResponses->where('attendance', 'no')->count();

        return view('admin.cards.show', compact('card', 'attending', 'declined'));
    }

    // ─────────────────────────────────────────
    // EDIT
    // ─────────────────────────────────────────
    public function edit(WeddingCard $card)
    {
        return view('admin.cards.edit', compact('card'));
    }

    // ─────────────────────────────────────────
    // UPDATE
    // ─────────────────────────────────────────
    public function update(Request $request, WeddingCard $card)
    {
        $validated = $request->validate($this->validationRules(isUpdate: true));

        // Handle photo uploads (keeps existing if no new file uploaded)
        $photos = $this->handlePhotoUpload($request, $card);

        // Merge and update
        $card->update(array_merge($validated, $photos));

        return redirect()
            ->route('admin.cards.show', $card)
            ->with('success', 'Card updated successfully!');
    }

    // ─────────────────────────────────────────
    // DESTROY
    // ─────────────────────────────────────────
    public function destroy(WeddingCard $card)
    {
        $name = "{$card->groom_name} & {$card->bride_name}";

        // Delete uploaded photos from storage
        foreach (['photo_1', 'photo_2', 'photo_3', 'qr_image'] as $field) {
            if ($card->$field) {
                Storage::disk('public')->delete($card->$field);
            }
        }

        $card->delete();

        return redirect()
            ->route('admin.cards.index')
            ->with('success', "Card for {$name} deleted.");
    }

    // ─────────────────────────────────────────
    // TOGGLE STATUS
    // ─────────────────────────────────────────
    public function toggleStatus(WeddingCard $card)
    {
        $card->update(['is_active' => !$card->is_active]);

        return back()->with('success',
            $card->is_active ? 'Card activated! ✅' : 'Card deactivated.'
        );
    }
}