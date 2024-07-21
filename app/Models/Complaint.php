<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'contact1',
        'contact2',
        'address',
        'problem',
        'warranty_status',
        'purchased_from',
        'cancel_reason',
        'model_photo',
        'product',
        'complaint_number',
        'status',
        'technician_id'
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }
}
