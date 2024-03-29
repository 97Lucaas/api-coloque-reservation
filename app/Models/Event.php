<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Invitation;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'place',
        'end_participation_date',
        'start_date',
        'max_invitations',
        'is_public',
        'slug'
    ];

    //pas besoin de () car c'est un hasMany (donc pris en charge par laravel)
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function getEndParticipationDateHumanizedAttribute() // Mardi 24 Mai | 24 mai 2022 | 
    {
        if($this->end_participation_date != NULL){
            return Carbon::parse($this->end_participation_date)->translatedFormat('d F Y à H\hi');
        }
    }

    public function getStartDateHumanizedAttribute() // Mardi 24 Mai | 24 mai 2022 | 
    {
        if($this->start_date != NULL){
            return Carbon::parse($this->start_date)->translatedFormat('d F Y à H\hi');
        }
    }

    public function getIsParticipationEndedAttribute() // Mardi 24 Mai | 24 mai 2022 | 
    {
        $now = Carbon::now();
        $timestamp_end_date = Carbon::parse($this->end_participation_date);
        return $now->greaterThan($timestamp_end_date);
    }

    public function getIsEventEndedAttribute() // Mardi 24 Mai | 24 mai 2022 | 
    {
        $now = Carbon::now();
        $timestamp_end_date = Carbon::parse($this->start_date);
        return $now->greaterThan($timestamp_end_date);
    }

    public function getEndParticipationDateComputedAttribute()
    {
        if($this->end_participation_date != NULL){
            return Carbon::parse($this->end_participation_date)->format('Y-m-d\TH:i');
        }
    }
    
    public function getStartDateComputedAttribute()
    {
        if($this->start_date != NULL){
            return Carbon::parse($this->start_date)->format('Y-m-d\TH:i');
        }
    }


    public function getPlaceLinkAttribute() 
    {
        return "https://www.google.com/maps/search/?api=1&query=".urlencode($this->place);
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
