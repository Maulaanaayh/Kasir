<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactiondetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaction(){
        return $this->belongsTo(transaction::class);
    }

    public function item(){
        return $this->belongsTo(item::class);
    }

    public $timestaps = false;
}
