<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory, SoftDeletes;

    // If you're using a different table name, uncomment and define it:
    protected $table = 'funds';

    // Define fillable fields
    protected $fillable = [
        'treasurer_id',
        'name',
        'target_amount',
        'end_date',
        'description',
        'image',
        'qr_code',
        'status',
    ];

    public function treasurer()
    {
        return $this->belongsTo(User::class, 'treasurer_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'fund_id');
    }

    public function ratio()
    {
        return $this->hasMany(Ratio::class, 'fund_id');
    }
    
}
