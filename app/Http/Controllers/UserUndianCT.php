<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HadiahModel;
use Illuminate\Support\Facades\DB;
class UserUndianCT extends Controller
{
    //

    public function index()
    {
    	// $model = new HadiahModel();
    	// $model = $model->all();
        $model = DB::select("select a.id, a.nama, a.type_hadiah, a.qty, case when b.qty_undian is null then a.qty else a.qty - b.qty_undian end as sisa from (select id, nama, type_hadiah, qty from hadiah) a left join (select id_hadiah, count(*) as qty_undian from undian group by id_hadiah) b on (a.id = b.id_hadiah)");
    	$response['hadiah'] = $model;
    	$model_undian = DB::select("select b.np, b.nama as 'nama_karyawan', c.nama as 'nama_hadiah', c.id as 'id_hadiah'  from undian a inner join karyawan b on a.barcode = b.barcode inner join hadiah c on a.id_hadiah = c.id");
    	$response['undian'] = $model_undian;
    	// return $response;
        return view('undian.index', compact('response'));
    }

    public function searchRandom(Request $request){
    	$id_hadiah = $request['id_hadiah'];
    	$model = DB::select("SELECT barcode, nama, np FROM karyawan AS r1 JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM karyawan)) AS id) AS r2 WHERE r1.id >= r2.id AND barcode NOT IN (SELECT barcode FROM undian) ORDER BY r1.id ASC LIMIT 1");
    	$hadiah = new HadiahModel();
    	$hadiah = $hadiah->where("id", $id_hadiah)->first();
    	$response['hadiah'] = $hadiah;
    	$response['karyawan'] = $model[0];
    	return json_decode(json_encode($response), true);
    }

    public function insertUndian(Request $request){
    	
    	DB::table('undian')->insert(['barcode' => $request['barcode'], 'id_hadiah' => $request['id_hadiah']]);
    	return "success";
    }
}
