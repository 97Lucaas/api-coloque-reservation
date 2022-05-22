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

    //pas besoin de () car c'est un hasMany (donc pris en charge par laravel)
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
    

    public function invitationsCount() {
        return Invitation::whereEventId($this->id)->count();
    }

    public function scanCount() {
        return Invitation::whereEventId($this->id)->whereNotNull('scanned_by_user_id')->count();
    }

    //ici, il faut recup maxInvitationsEnabled lorsque laravel transforme ce get ..... atribute en ....

    public function getMaxInvitationsEnabledAttribute() {
        return $this->isLimited();
    }

    public function isLimited() {
        return !is_null($this->max_invitations);
    }

    public function needS($number) {

        if($number > 1){
            $return = "s";
        }else{
            $return = "";
        }

        return $return;
    }

    public function remainingInvitationsCount() {
        return $this->max_invitations-$this->invitationsCount();
    }

    public function isFull() {
        if(!$this->isLimited()) return false;

        return $this->invitationsCount()>=$this->max_invitations;
    }

    public function isNotFull() {
        return !$this->isFull();
    }

}
