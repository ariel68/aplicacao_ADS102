<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public $timestamps = false;
    protected  $guarded = ['id'];
    
    public function pedidos(){
        return $this->belongsToMany('App\Pedido')->withPivot(['Quantidade']);;
    }
}
