<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'name'];

    public function translations()
    {
        return $this->hasMany(TeamTranslation::class, 'teams_id', 'id');
    }
}

