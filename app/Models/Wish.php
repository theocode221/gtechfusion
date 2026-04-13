<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = [
        'wedding_card_id','guest_name','message',
    ];

    public function weddingCard()
    {
        return $this->belongsTo(WeddingCard::class);
    }
}