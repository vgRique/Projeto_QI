<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'email',
        'is_admin',
    ];
    

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
}
?>