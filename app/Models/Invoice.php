<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    // If you're using a different table name, uncomment and define it:
    protected $table = 'invoices';

    // Define fillable fields
    protected $fillable = [
        'donator_id',
        'general_fund_id',
        'fund_id',
        'donation_type',
        'ratio_id',
        'notes',
        'amount',
    ];

    public function donator()
    {
        return $this->belongsTo(User::class, 'donator_id');
    }

    public function general_fund()
    {
        return $this->belongsTo(GeneralFund::class, 'general_fund_id');
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id');
    }

    public function ratio()
    {
        return $this->belongsTo(Ratio::class, 'ratio_id');
    }

}
