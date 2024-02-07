<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\SmartPunct\Quote;

class QuotesTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['quote_id', 'language_id', 'title', 'description'];

    public function quote()
    {
        return $this->belongsTo(Quotes::class, 'quote_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
