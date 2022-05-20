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
        'is_public',
        'slug'
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function invitationsCount() {
        return Invitation::whereEventId($this->id)->count();
    }

    public function isLimited() {
        return !is_null($this->max_invitations);
    }

    

    public function isFilled() {
        if(!$this->isLimited()) return false;

        return $this->invitationsCount()>=$this->max_invitations;
    }

    public function isNotFilled() {
        return !$this->isFilled();
    }
}
