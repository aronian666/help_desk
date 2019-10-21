<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Ticket;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function attachments() {
        return $this->hasMany(Attachment::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function isSuperAdmin() {
        return $this->role->id == 1;
    }

    public function createTicket()
    {
        return $this->role->id == 1 || $this->role->id == 2;
    }

    public function getTickets() {
        return Ticket::where('technical_id', $this->id)->get();
    }

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'description', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
