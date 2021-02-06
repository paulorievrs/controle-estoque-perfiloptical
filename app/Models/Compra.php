<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compra';

    public function produto()
    {
        return $this->hasMany(Produto::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }
}
