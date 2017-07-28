<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmModel extends Model
{
    protected $table = "admin";
    protected $primaryKey = "id";
    public $timestamps = false;
}
