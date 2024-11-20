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
        'user_id'
    ];

    //protected $hidden = [];

    public function getAll()
    {
        return $this::select('restaurant', 'table', 'content','status')
        ->get();
    } 

    public static function getBy($foreignKey, $id)
    {   
        $foreignKey = match ($foreignKey) {
            'restaurant'=> 'restaurant',
            'user_id'      => 'user_id'
        };
        return self::where($foreignKey, $id)
        ->select('restaurant', 'table', 'content', 'status', 'id')
        ->get();
    }

    public function findOrder($id)
    {
        return Order::findOrFail($id);
    }

    public static function newOrder($atributtes)
    {
        return Order::create($atributtes);
    }

    public static function updateOrder($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return $order->status;
    }

    public static function rejectOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }


    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function franchise($id)
    {
        return $this->belongsTo(restaurant::class, 'restaurant');
    }


}
