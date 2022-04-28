<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;


    public $additional_attributes = ["full_name_patient"];


    public function getFullNamePatientAttribute()
    {
        return $this->name . " " . $this->last_name;;
    }
}
