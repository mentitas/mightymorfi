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


    public function getAll()
    {
        return $this::select('restaurant', 'table', 'content','status')
        ->get();
    } 

    public static function getByOwner($id)
    {
        return Restaurant::where('owner_id', $id)->get();
        //->select('restaurant', 'table', 'content', 'status', 'id')
    }

    public static function getByName($name)
    {
        return Restaurant::where('name', $name)->get();
    }

    public static function getInfo($id)
    {
        return Order::findOrFail($id);
    }

    public static function newRestaurant($atributtes)
    {
        return Restaurant::factory()->create($atributtes);
    }

    public static function updateRestaurant($id, $attributes)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->fill($attributes);
        $restaurant->save();

        return $restaurant->id;
    }



    public function locations($id)
    {
        return $this->select('name', 'latitude', 'longitude','horarios','menu')->get();
    }


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner');
    }

    /**
     * acceder a las ordenes de un restaurant desde el modelo Restaurant
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'restaurant');
    }
}