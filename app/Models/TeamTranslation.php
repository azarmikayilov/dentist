<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'teams_id',
        'language_id',
        'position'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'teams_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
