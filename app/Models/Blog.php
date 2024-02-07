<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    public function translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }
}
