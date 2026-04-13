<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RsvpResponse extends Model
{
    protected $fillable = [
        'wedding_card_id','guest_name',
        'phone','attendance','pax',
    ];

    public function weddingCard()
    {
        return $this->belongsTo(WeddingCard::class);
    }
}