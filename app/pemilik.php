<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pemilik extends Model
{
    protected $fillable = [
      'id_pem','nama','gen','no','email','created_at'
  	];
}
