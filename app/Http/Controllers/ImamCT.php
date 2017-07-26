<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImamModel;

class ImamCT extends Controller
{
    //
    public function index()
    {
    	$model = new ImamModel();
    	$model = $model->all();
        return view('imam.index', compact('model'));
    }

    public function store(Request $request)
    {
        $model = new ImamModel();
        $model->nama_imam = $request->nama;
        $model->save();
        return redirect()->route('imam.index')->with('alert-success', 'Data Berhasil Disimpan.');
    }

    public function edit($id)
    {
        $model = ImamModel::findOrFail($id);
        return view('imam.edit', compact('model'));
    }

    public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
    	$model = ImamModel::findOrFail($id);
        $model->nama_imam = $request->nama;
        $model->save();
        return redirect()->route('imam.index')->with('alert-success', 'Data Berhasil Disimpan.');
    }

    public function delete($id)
    {
        $data = ImamModel::findOrFail($id);
        return view('imam.delete', compact('data'));
    }

    public function destroy($id)
    {
        $toko = ImamModel::findOrFail($id);
        $toko->delete();
        return redirect()->route('imam.index')->with('alert-success', 'Data Berhasil Hapus.');
    }
}
