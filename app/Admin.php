<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $fillable = ['name', 'type', 'mobile', 'email', 'password', 'image', 'status', 'created_at', 'updated_at'];
    protected $hidden = ['password', 'remember_token'];
}
