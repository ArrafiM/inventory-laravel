<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\ItemCategory;
use App\Models\Stok;


class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','type','category_id','created_by','description'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(ItemCategory::class,'category_id');
    }

    public function stok():HasOne
    {
        return $this->hasOne(Stok::class,'item_id');
    }
}
