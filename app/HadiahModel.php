<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HadiahModel extends Model
{
    protected $table = "hadiah";
    protected $primaryKey = "id";
    // public $fillable = [ 'ID', 'NO', 'NKA_LKA', 'ACCOUNT', 'STORE', 'REGION', 'AREA', 'DISTRIBUTOR', 'COORDINATE'];
    public $timestamps = false;
}
