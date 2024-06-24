<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id', 'status' ,'qty', 'supplier_id', 'created_by'
    ];
}