<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions'; // Ensure the table name is correct

    protected $primaryKey = 'id';

    protected $fillable = [
        'patient_id',
        'service_name',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Ensure this method is defined correctly
    public function payment()
    {
        return $this->hasOne(Payment::class, 'subscription_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class);
    }
}
