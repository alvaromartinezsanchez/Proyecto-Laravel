<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
   //RELACION Many to One / de Muchos a uno
   //Obtiene objeto usuario que ha creado el comentario
   public function user(){
       //indicamos la clase 'App\User'->Usuario y el atributo 'user_id'->Imagen
       return $this->belongsTo('App\User','user_id');
   }
   
   //Obtiene objeto Imagen que contiene el comentario
   public function images(){
       //indicamos la clase 'App\Image'->Image y el atributo 'image_id'->Comment
       return $this->belongsTo('App\Image','image_id');
   }
}
