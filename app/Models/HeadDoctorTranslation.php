<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadDoctorTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['head_doctor_id', 'language_id', 'description'];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
