<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'model_path', 
        // Add more fields as needed
    ];

  /*  public function user()
    {
        return $this->belongsTo(User::class);
    }*/
    public function data()
    {
        return $this->hasOne(Data::class);
    }
  

    public function getModelPathAttribute()
    {
        // Assuming 'model_path' is the column in your contents table
        return $this->attributes['model_path']
            ? asset('storage/models/' . $this->attributes['model_path'])
            : null;
    }

}

