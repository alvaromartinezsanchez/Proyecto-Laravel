<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';


    //RELACION Many to One / de Muchos a uno
   //Obtiene objeto usuario que ha creado el Like
   public function user(){
       //indicamos la clase 'App\User'->Usuario y el atributo 'user_id'->Like
       return $this->belongsTo('App\User','user_id');
   }
   
   //Obtiene objeto Imagen que contiene el Like
   public function images(){
       //indicamos la clase 'App\Image'->Image y el atributo 'image_id'->Like
       return $this->belongsTo('App\Image','image_id');
   }
}
