<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'surname', 'nick', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //Relacion One to many / de uno a muchos
   //Obtiene las imagenes creadas de un usuario
   public function images(){
       //Devuelve el array de objetos que contiene los comentarios de la imagen
       return $this->hasMany('App\Images');
   }
}
