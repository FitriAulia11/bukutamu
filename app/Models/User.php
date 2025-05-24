<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', // Pastikan 'role' ada di sini
    ];

    // Metode untuk memeriksa peran
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class); // Assuming you have a Role model
    }

}