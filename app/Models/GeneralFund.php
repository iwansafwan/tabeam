<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GeneralFund extends Model
{
    use HasFactory, SoftDeletes;

    // If you're using a different table name, uncomment and define it:
    protected $table = 'general_funds';

    // Define fillable fields
    protected $fillable = [
        'name',
        'collected_amount',
        'qr_code',
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'general_fund_id');
    }

}
