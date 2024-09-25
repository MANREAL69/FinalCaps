<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $primaryKey = 'appointmentID';

    protected $fillable = [
        'datetime',
        'description',
        'therapistID',
        'patientID',
        'created_at',
        'updated_at'
    ];
    
    public function patient()
    {
        return $this->belongsTo(User::class, 'patientID');
    }

    // Relationship to get the therapist
    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapistID');
    }
}
