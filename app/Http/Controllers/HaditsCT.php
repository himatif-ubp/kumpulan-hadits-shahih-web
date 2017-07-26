<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HaditsModel;
use App\BabModel;
use App\ImamModel;
use Illuminate\Support\Facades\DB;

class HaditsCT extends Controller
{
	public function index()
	{
		// $model = new BabModel();
		// $model = $model->orderBy('id', 'desc')->get();
		// $imam = new ImamModel();
		// $imam = $imam->orderBy('id', 'desc')->get();
		// $response['model'] = $model;
		// $response['imam'] = $imam;
		$model = DB::table('bab')
			->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
			->join('imam', 'kitab.id_imam', '=', 'imam.id')
			->select('bab.*', 'imam.nama_imam', 'kitab.nama as nama_kitab')
			->orderBy('bab.id', 'desc')
			->get();
		$kitab = DB::table('kitab')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            ->select('kitab.*', 'imam.nama_imam')
            ->orderBy('kitab.id', 'desc')
            ->get();
		$data = DB::table('hadits')
		->join('bab', 'hadits.id_bab', '=', 'bab.id')
		->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
		->join('imam', 'kitab.id_imam', '=', 'imam.id')
		->select('hadits.*', 'imam.nama_imam', 'bab.nama as nama_bab', 'kitab.nama as nama_kitab')
		->orderBy('hadits.id', 'desc')
		->limit(10)
		->get();
		$response['data'] = $data;
		$response['model'] = $model;
		$response['kitab'] = $kitab;
		// return $response;
		return view('hadits.index', compact('response'));
	}

	public function store(Request $request)
	{
		$model = new HaditsModel();
		$model->id_bab = $request->id_bab;
		$model->isi = $request->isi;
		$model->save();
		return redirect()->route('hadits.index')->with('alert-success', 'Data Berhasil Disimpan.');
	}

	public function edit($id)
	{
		$data = DB::table('hadits')
			->join('bab', 'hadits.id_bab', '=', 'bab.id')
			->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
			->join('imam', 'kitab.id_imam', '=', 'imam.id')
			->select('hadits.*', 'imam.nama_imam', 'bab.nama as nama_bab', 'kitab.nama as nama_kitab')
			->where('hadits.id', $id)
			->first();

		$model = DB::table('bab')
			->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
			->join('imam', 'kitab.id_imam', '=', 'imam.id')
			->select('bab.*', 'imam.nama_imam', 'kitab.nama as nama_kitab')
			->orderBy('bab.id', 'desc')
			->get();
		$response['model'] = $model;
		$response['data'] = $data;
		// return $response;
		return view('hadits.edit', compact('response'));
	}

	public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
		$model = HaditsModel::findOrFail($id);
		$model->isi = $request->isi;
		$model->id_bab = $request->id_bab;
		$model->save();
		return redirect()->route('hadits.index')->with('alert-success', 'Data Berhasil Disimpan.');
	}

	public function delete($id)
	{
		$data = HaditsModel::findOrFail($id);
		return view('hadits.delete', compact('data'));
	}

	public function destroy($id)
	{
		$toko = HaditsModel::findOrFail($id);
		$toko->delete();
		return redirect()->route('hadits.index')->with('alert-success', 'Data Berhasil Hapus.');
	}
}
