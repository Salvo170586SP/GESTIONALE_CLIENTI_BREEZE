<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_client',
        'surname_client',
        'date_of_birth',
        'city_of_birth',
        'address',
        'cap',
        'img_url',
        'position',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Aggiungi qui le tue personalizzazioni per il metodo boot
        static::creating(function ($client) {
            if ($client->position  === null) {
                // quando aggiunge un client aggiorna la posizione assegnando la posizione di 1
                $maxPosition = self::max('position');
                $client->position = $maxPosition + 1;
            }
        });

        static::deleting(function ($client) {
            // quando elimina un client controlla se la posizione è maggiore di quella esistente e la decrementa 
            self::where('position', '>', $client->position)->decrement('position');
        });
    }
}
