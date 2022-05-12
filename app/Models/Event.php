<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Invitation;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'max_invitations',
        'is_public'
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function isLimited() {
        return is_null($this->invitations_max);
    }
}
