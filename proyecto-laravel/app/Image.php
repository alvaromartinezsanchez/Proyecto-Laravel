<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //Indica la tabla de la BD sobre la que va a trabajar
   protected $table = 'images';
   
   //Relacion One to many / de uno a muchos
   //Obtiene los comentarios que contiene la foto
   public function comments(){
       //Devuelve el array de objetos que contiene los comentarios de la imagen
       return $this->hasMany('App\Comment');
   }
   
   //Obtiene los likes que contiene la foto
   public function likes(){
       //Devuelve el array de objetos que contiene los likes de la imagen
       return $this->hasMany('App\Like');
   }
   
   //RELACION Many to One / de Muchos a uno
   //Obtiene objeto usuario que ha creado la imagen
   public function user(){
       //indicamos la clase 'App\User'->Usuario y el atributo 'user_id'->Imagen
       return $this->belongsTo('App\User','user_id');
   }
}
