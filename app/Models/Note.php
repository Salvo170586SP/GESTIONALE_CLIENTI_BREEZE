<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function months()
    {
        return $this->belongsToMany(Month::class);
    }
}
