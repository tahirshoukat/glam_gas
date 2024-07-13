<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'name',
        'item_description',
        'uom',
        'closing_stock',
        'item_avg_rate',
        'total_amount'
    ];

    protected $casts = [
        'closing_stock' => 'integer',
        'item_avg_rate' => 'float',
        'total_amount' => 'float',
    ];

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }
}
