<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HaditsModel extends Model
{
    protected $table = "hadits";
    protected $primaryKey = "id";
    public $timestamps = false;
}
