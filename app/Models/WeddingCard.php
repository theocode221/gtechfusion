<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeddingCard extends Model
{
    use HasFactory;

protected $fillable = [
    'slug','groom_name','groom_name_card','bride_name','bride_name_card',
    'groom_father','groom_mother','bride_father','bride_mother',
    'wedding_date','hijri_date','wedding_time',
    'venue_name','venue_address','maps_url',
    'dress_code','rsvp_deadline','music_url',
    'tng_number','bank_name','bank_number','bank_holder',
    'photo_1','photo_2','photo_3','theme','is_active',
    'story_1_year','story_1_title','story_1_desc',
    'story_2_year','story_2_title','story_2_desc',
    'story_3_year','story_3_title','story_3_desc',
    'story_4_year','story_4_title','story_4_desc',
    'qr_image',
];

    protected $casts = [
        'wedding_date'  => 'date',
        'rsvp_deadline' => 'date',
        'is_active'     => 'boolean',
    ];

    // Auto-generate slug from groom+bride name
    public static function generateSlug($groom, $bride): string
    {
        $base = strtolower(
            preg_replace('/[^a-zA-Z0-9]+/', '-',
                $groom . '-' . $bride
            )
        );
        $slug = trim($base, '-');
        $count = 1;
        $original = $slug;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }

    public function rsvpResponses()
    {
        return $this->hasMany(RsvpResponse::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }

    public function getCardUrlAttribute(): string
    {
        return url('/card/' . $this->slug);
    }

    public function getAttendingCountAttribute(): int
    {
        return $this->rsvpResponses()->where('attendance', 'yes')->sum('pax');
    }

    public function getDeclinedCountAttribute(): int
    {
        return $this->rsvpResponses()->where('attendance', 'no')->count();
    }
}