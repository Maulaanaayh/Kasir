<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function cart(){
        return $this->hasOne(cart::class);
    }

    public function transaction(){
        return $this->hasManyThrough(transaction::class, transactiondetail::class);
    }

    public $timestaps = false;
}
