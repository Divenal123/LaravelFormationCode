<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
    public function items() {
        return $this->belongsToMany(Item::class);
    }
}
