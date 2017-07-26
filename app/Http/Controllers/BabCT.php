<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BabModel;
use App\KitabModel;
use Illuminate\Support\Facades\DB;

class BabCT extends Controller
{
    public function index()
    {
    	// $model = new BabModel();
    	// $model = $model->all();
        $data = DB::table('kitab')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            ->select('kitab.*', 'imam.nama_imam')
            ->orderBy('kitab.id', 'desc')
            ->get();
        // $response['model'] = $data;
        $response['kitab'] = $data;
        $data = DB::table('bab')
            ->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            ->select('bab.*', 'kitab.nama as nama_kitab', 'imam.nama_imam')
            ->orderBy('bab.id', 'desc')
            ->get();
        $response['data'] = $data;
        return view('bab.index', compact('response'));
    }

    public function store(Request $request)
    {
        $model = new BabModel();
        $model->nama = $request->nama;
        $model->id_kitab = $request->id_kitab;
        $model->save();
        if($request->is_hadits != null){
            return redirect()->route('hadits.index')->with('alert-success', 'Data Berhasil Disimpan.');
        }else{
            return redirect()->route('bab.index')->with('alert-success', 'Data Berhasil Disimpan.');
        }
    }

    public function edit($id)
    {
        // $model = BabModel::findOrFail($id);
        // $model = DB::table('bab')
        //     ->join('imam', 'bab.id_imam', '=', 'imam.id')
        //     // ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('bab.*', 'imam.nama_imam')
        $model = DB::table('bab')
            ->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            ->select('bab.*', 'kitab.nama as nama_kitab', 'imam.nama_imam')
            ->where('bab.id', $id)
            ->first();
        // $imam = new KitabModel();
        // $imam = $imam->all();
        $imam = DB::table('kitab')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            ->select('kitab.*', 'imam.nama_imam')
            ->orderBy('kitab.id', 'desc')
            ->get();
        $response['model'] = $model;
        $response['imam'] = $imam;
        // return $response;
        return view('bab.edit', compact('response'));
    }

    public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
    	$model = BabModel::findOrFail($id);
        $model->nama = $request->nama;
        $model->id_kitab = $request->id_kitab;
        $model->save();
        return redirect()->route('bab.index')->with('alert-success', 'Data Berhasil Disimpan.');
    }

    public function delete($id)
    {
        $data = BabModel::findOrFail($id);
        return view('bab.delete', compact('data'));
    }

    public function destroy($id)
    {
        $toko = BabModel::findOrFail($id);
        $toko->delete();
        return redirect()->route('bab.index')->with('alert-success', 'Data Berhasil Hapus.');
    }
}
