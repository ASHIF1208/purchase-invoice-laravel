<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function main() {
        return $this->belongsTo(PurchaseMain::class, 'purchase_main_id');
    }
}
