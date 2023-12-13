<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail(){
        return $this->hasMany(transactiondetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $timestaps = false;
}
