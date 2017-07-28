<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HaditsModel;
use App\BabModel;
use App\ImamModel;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;
use Carbon\Carbon;

class NotifCT extends Controller
{
    public function index()
	{
		return view('notif.index');
	}

	public function store(Request $request)
	{
		// $model = DB::table('bab')
		// 	->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
		// 	->join('imam', 'kitab.id_imam', '=', 'imam.id')
		// 	->select('bab.*', 'imam.nama_imam', 'kitab.nama as nama_kitab')
		// 	->orderBy('bab.id', 'desc')
		// 	->get();
		// $kitab = DB::table('kitab')
  //           ->join('imam', 'kitab.id_imam', '=', 'imam.id')
  //           ->select('kitab.*', 'imam.nama_imam')
  //           ->orderBy('kitab.id', 'desc')
  //           ->get();
		// $data = DB::table('hadits')
		// ->join('bab', 'hadits.id_bab', '=', 'bab.id')
		// ->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
		// ->join('imam', 'kitab.id_imam', '=', 'imam.id')
		// ->select('hadits.*', 'imam.nama_imam', 'bab.nama as nama_bab', 'kitab.nama as nama_kitab')
		// ->orderBy('hadits.id', 'desc')
		// // ->where('hadits.isi', 'like', 'solat')
		// ->whereRaw("hadits.isi like CONCAT('%', '".$cari."', '%')")
		// ->limit(10)
		// ->get();
		// return Datatables::of($data)->make(true);
		// $response['data'] = $data;
		// $response['model'] = $model;
		$cari = $request->cari;
		$response['aftersearch'] = true;
		$response['cari'] = $cari;
		// return $response;
		return view('notif.index', compact('response'));
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
		return view('notif.edit', compact('response'));
	}

	public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
		$model = HaditsModel::findOrFail($id);
		$model->isi = $request->isi;
		$model->id_bab = $request->id_bab;
		$model->save();
		return redirect()->route('notif.index')->with('alert-success', 'Data Berhasil Disimpan.');
	}

	public function delete($id)
	{
		$data = HaditsModel::findOrFail($id);
		return view('notif.delete', compact('data'));
	}

	public function destroy($id)
	{
		$toko = HaditsModel::findOrFail($id);
		$toko->delete();
		return redirect()->route('notif.index')->with('alert-success', 'Data Berhasil Hapus.');
	}

	public function all(Request $request){
		$cari = $request->term;
		$data = DB::table('hadits')
		->join('bab', 'hadits.id_bab', '=', 'bab.id')
		->join('kitab', 'bab.id_kitab', '=', 'kitab.id')
		->join('imam', 'kitab.id_imam', '=', 'imam.id')
		->select('hadits.*', 'imam.nama_imam', 'bab.nama as nama_bab', 'kitab.nama as nama_kitab')
		->orderBy('hadits.id', 'desc')
		// ->where('hadits.isi', 'like', 'solat')
		->whereRaw("hadits.isi like CONCAT('%', '".$cari."', '%')")
		// ->limit(10)
		->get();
		return Datatables::of($data)->make(true);
	}

	public function sentNotif(Request $request){

		$id = $request->id;

		$model = BabModel::findOrFail($id);
		$model->created_at = Carbon::now()->format('Y-m-d H:m:s');
		// return $model;


    	$notificationBuilder = new PayloadNotificationBuilder('Hadits Hari Ini');
		$notificationBuilder->setBody($model->nama)
		->setSound('default');

		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData(['data' =>  $model]);

		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();

		$topic = new Topics();
		$topic->topic('news');

		$topicResponse = FCM::sendToTopic($topic, null, null, $data);
		// $topicResponse = FCM::sendTo($topic, $option, $notification, $data);

		// return "$topicResponse";
		$topicResponse->isSuccess();
		$topicResponse->shouldRetry();
		$topicResponse->error();
		// return view('notif.index')->;
		return redirect()->route('notif.index')->with('alert-success', 'Notifikasi berhasil dikirim.');
    }
}
