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
        'product_category',
        'barcode',
        'complaint_details',
        'status'
    ];
}
