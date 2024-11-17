<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // Todo: quizás castear los tipos de cada coso

    protected $fillable = [
        'name',
        'owner',
        'address',
        'menu',
        'tables',
        'timetable',
        'contact',
        'latitude',
        'longitude'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * acceder a las ordenes de un restaurant desde el modelo Restaurant
     */
    public function orders()
    {
        return $this->hasMany(Orders::class, 'restaurant');
    }
}