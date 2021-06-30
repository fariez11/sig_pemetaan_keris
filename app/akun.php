<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class akun extends Model
{
    protected $fillable = [
      'id_ak','nama','user','pass','created_at'
  	];
}
