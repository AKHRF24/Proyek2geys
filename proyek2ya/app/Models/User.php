<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $points
 * @method static update(array $attributes)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'points'];
    protected $hidden = ['password'];
    protected $attributes = ['points' => 0];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }

    // public function userAnswers()
    // {
    //     return $this->hasMany(UserAnswer::class, 'user_id');
    // }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function decrementPoints(int $amount)
    {
        return $this->decrement('points', $amount);
    }
}
