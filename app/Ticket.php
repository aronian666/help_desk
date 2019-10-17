<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function priority(){
        return $this->belongsTo(Priority::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function shortDescription() {
        return strlen($this->description) > 20 ? substr($this->description, 0, 20) . "..." : $this->description;
    }

    protected $fillable = [
        'title', 'description', 'user_id', 'priority_id', 'type_id', 'product_id', 'status_id'
    ];
}
