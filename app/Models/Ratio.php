<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ratio extends Model
{
    use HasFactory, SoftDeletes;

    // If you're using a different table name, uncomment and define it:
    protected $table = 'ratios';

    // Define fillable fields
    protected $fillable = [
        'fund_id',
        'category_name',
        'percentage',
        'percent_amount',
        'total_collected',
    ];

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id');
    }

}
