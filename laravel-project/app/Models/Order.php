<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        'id',
        'restaurant',
        'table',
        'content',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
