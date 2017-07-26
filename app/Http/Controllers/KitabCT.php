<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImamModel;
use App\KitabModel;
use Illuminate\Support\Facades\DB;

class KitabCT extends Controller
{
    public function index()
    {
        $imam = new ImamModel();
        $imam = $imam->all();
        $response['model'] = $imam;
        $response['imam'] = $imam;
        $data = DB::table('kitab')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            ->select('kitab.*', 'imam.nama_imam')
            ->orderBy('kitab.id', 'desc')
            ->get();
        $response['data'] = $data;
        return view('kitab.index', compact('response'));
    }

    public function store(Request $request)
    {
        $model = new KitabModel();
        $model->nama = $request->nama;
        $model->id_imam = $request->id_imam;
        $model->save();
        if($request->is_hadits != null){
            return redirect()->route('hadits.index')->with('alert-success', 'Data Berhasil Disimpan.');
        }else{
            return redirect()->route('kitab.index')->with('alert-success', 'Data Berhasil Disimpan.');
        }
    }

    public function edit($id)
    {
        // $model = BabModel::findOrFail($id);
        $model = DB::table('kitab')
            ->join('imam', 'kitab.id_imam', '=', 'imam.id')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('kitab.*', 'imam.nama_imam')
            ->where('kitab.id', $id)
            ->first();
        $imam = new ImamModel();
        $imam = $imam->all();
        $response['model'] = $model;
        $response['imam'] = $imam;
        return view('kitab.edit', compact('response'));
    }

    public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
    	$model = KitabModel::findOrFail($id);
        $model->nama = $request->nama;
        $model->id_imam = $request->id_imam;
        $model->save();
        return redirect()->route('kitab.index')->with('alert-success', 'Data Berhasil Disimpan.');
    }

    public function delete($id)
    {
        $data = KitabModel::findOrFail($id);
        return view('kitab.delete', compact('data'));
    }

    public function destroy($id)
    {
        $toko = KitabModel::findOrFail($id);
        $toko->delete();
        return redirect()->route('kitab.index')->with('alert-success', 'Data Berhasil Hapus.');
    }
}
