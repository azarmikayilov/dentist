<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMenuTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['about_menu_id', 'language_id', 'title'];

//    public function quote()
//    {
//        return $this->belongsTo(Quotes::class, 'quote_id', 'id');
//    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
