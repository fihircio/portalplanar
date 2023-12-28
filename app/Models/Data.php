<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Data extends Model
{
    use HasFactory;
    protected $fillable = ['content_id', 'key', 'value', 'entry_key'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
   /* public function user()
    {
        return $this->belongsTo(User::class);
    }*/
    
    public function setContentIdAttribute($value)
    {
        $this->attributes['content_id'] = $value;
        $this->attributes['entry_key'] = Str::random(10); // Adjust the length as needed
    }
}
