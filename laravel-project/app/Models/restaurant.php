<?php

namespace App\Models;

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
        'contact',
        'open-hours',
        'address',
        'menu',
        'tables',
    ];
}