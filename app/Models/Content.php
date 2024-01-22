<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add user_id to the fillable array
        'entry_key', // Add entry_key to the fillable array
        'model_path',
        'title',
        'description',
        // Add more fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function data()
    {
        return $this->hasMany(Data::class, 'entry_key', 'entry_key');
    }
  

    public function getModelPathAttribute()
    {
        // Assuming 'model_path' is the column in your contents table
        return $this->attributes['model_path']
            ? asset('storage/models/' . $this->attributes['model_path'])
            : null;
    }

}

