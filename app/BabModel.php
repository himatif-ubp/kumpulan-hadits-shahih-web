<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BabModel extends Model
{
    protected $table = "bab";
    protected $primaryKey = "id";
    public $timestamps = false;
}
