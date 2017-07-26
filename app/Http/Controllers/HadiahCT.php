<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HadiahModel;

class HadiahCT extends Controller
{
    public function index()
    {
    	$model = new HadiahModel();
    	$model = $model->all();
        return view('hadiah.index', compact('model'));
    }

    public function store(Request $request)
    {
        $model = new HadiahModel();
        $model->nama = $request->nama;
        $model->qty = $request->qty;
        $model->type_hadiah = $request->type;
        $model->save();
        return redirect()->route('hadiah.index')->with('alert-success', 'Data Berhasil Disimpan.');
    }

    public function edit($id)
    {
        $model = HadiahModel::findOrFail($id);
        return view('hadiah.edit', compact('model'));
    }

    public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
    	$model = HadiahModel::findOrFail($id);
        $model->nama = $request->nama;
        $model->qty = $request->qty;
        $model->type_hadiah = $request->type;
        $model->save();
        return redirect()->route('hadiah.index')->with('alert-success', 'Data Berhasil Disimpan.');
    }

    public function delete($id)
    {
        $data = HadiahModel::findOrFail($id);
        return view('hadiah.delete', compact('data'));
    }

    public function destroy($id)
    {
        $toko = HadiahModel::findOrFail($id);
        $toko->delete();
        return redirect()->route('hadiah.index')->with('alert-success', 'Data Berhasil Hapus.');
    }

}
