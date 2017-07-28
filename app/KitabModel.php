<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitabModel extends Model
{
    protected $table = "kitab";
    protected $primaryKey = "id";
    public $timestamps = false;
}
