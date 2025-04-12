<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseMain extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function details() {
        return $this->hasMany(PurchaseDetail::class, 'purchase_main_id');
    }
}
