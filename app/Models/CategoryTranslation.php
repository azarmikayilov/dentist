<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'slug',
        'name',
        'language_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }


}
