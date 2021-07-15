<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{   

    protected $primaryKey = 'NumeroPedido';
    public $timestamps = false;
    protected  $guarded = ['id'];

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }

    public function produtos(){
        return $this->belongsToMany('App\Produto')->withPivot(['Quantidade']);
    }
}
