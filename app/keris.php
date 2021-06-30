<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keris extends Model
{
    protected $fillable = [
      'id_ker','nama','kec','lng','lat','created_at'
  ];
}
