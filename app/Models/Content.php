<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Data;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add user_id to the fillable array
  
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
        return $this->hasMany(Data::class);
    }


  

    public function getModelPathAttribute()
    {
        // Assuming 'model_path' is the column in your contents table
        return $this->attributes['model_path']
            ? asset('storage/' . $this->attributes['model_path'])
            : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($content) {
            // Create a new Data entry when a Content is created
            $data = new Data([
                'key' => 'your_key', // Adjust as needed
                'value' => 'your_value', // Adjust as needed
            ]);

            $content->data()->save($data);
        });
    }

}

