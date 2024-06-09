<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'technician_id',
        'inventory_id',
        'quantity',
        'allocated_at',
        'commission'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
