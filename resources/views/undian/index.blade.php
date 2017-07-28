@extends('user.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
	var timeout = 100;
	var isStart = false;
	var myTimeOut;
	var typeHadiah = 0;
	var idHiadiah = 0;
	var barcode = 0;

	function timeOutRun(){
		myTimeOut = setTimeout("changeImage()", timeout);
	}
	function changeImage(){
		$("#random_number").text(Math.floor(100000 + Math.random() * 900000)+"");
		timeOutRun();
	}
	$(document).ready(function(){
		$("#button_mulai").click(function() {
			if(isStart){
				isStart = false;
				$("#loader").show();
				$.get("/api/search/random?id_hadiah="+idHiadiah, {
						//name : "Donald Duck",
						//city : "Duckburg"
					}, function(data, status) {
						// setTimeout(function(){ 
							$("#button_mulai").text("ACAK");
							clearTimeout(myTimeOut);
							$("#out_hadiah").hide();
							$("#out_hadiah_type").hide();
							$("#button_mulai").hide();
							$("#loader").hide();
							$("#alert_pemenang").show();
							$("#random_number").text(data.karyawan.barcode);
							$("#pemenang_hadiah_alert").text('Selamat barcode : '+data.karyawan.barcode + ' atas nama ' +data.karyawan.nama+ ' ( '+data.karyawan.np+ ' )');
							$("#pemenang_nama_alert").text('Mendapatkan : '+data.hadiah.nama);
							console.log(data.hadiah)
							barcode = data.karyawan.barcode;
						// }, 2000);
					});
			}else{
				isStart = true;
				$("#button_mulai").text("STOP");
				timeOutRun();
				$("#loader").hide();
				$("#out_hadiah").show();
				$("#out_hadiah_type").show();
			}
		});

		// hadiah UI
		// $("#hadiah_0").show();
		// $("#hadiah_1").hide();
		$('input[type=radio][name=type_hadiah]').change(function() {
			if (this.value == '0') {
				$("#hadiah_0").show();
				$("#hadiah_1").hide();
			}
			else if (this.value == '1') {
				$("#hadiah_0").hide();
				$("#hadiah_1").show();
			}
		});

		// $('input[type=radio][name=hadiah]').change(function() {
		// 	var id = this.value;
		// 	console.log(id);
		// 	$("#table_undian > tbody > tr > td").empty();
		// 	$("#table_undian_"+id).show();
		// 	idHiadiah = id;
		// 	console.log("id hadiah : "+idHiadiah);
		// });

		$("#button_ulang").click(function(){
			$("#random_number").text("99999");
			$("#out_hadiah").show();
			$("#out_hadiah_type").show();
			$("#button_mulai").show();
			$("#alert_pemenang").hide();
			$("#asd_table").hide();
		});

		$("#button_simpan").click(function(){
			$("#loader").show();
			$.get("/api/undian/simpan?id_hadiah="+idHiadiah+"&barcode="+barcode, {
						//name : "Donald Duck",
						//city : "Duckburg"
					}, function(data, status) {
						window.location.href="/user/undian";
					});
		});

		$('#type_hadiah_select').on('change', function() {
			// idHiadiah = this.value();
			if(this.value == 0){
				$("#hadiah_0").show();
				$("#hadiah_1").hide();
			}else{
				$("#hadiah_0").hide();
				$("#hadiah_1").show();
			}
		})
		$('#sel_hadiah').on('change', function() {
			idHiadiah = this.value;
			console.log(idHiadiah);
		})

		idHiadiah = $('#sel_hadiah').val();

		// loader
		$("#loader").hide();
	});

</script>
<style type="text/css">
	.loader {
		border: 16px solid #f3f3f3; /* Light grey */
		border-top: 16px solid #3498db; /* Blue */
		border-radius: 50%;
		width: 50px;
		height: 50px;
		animation: spin 2s linear infinite;
		display: block;
	}
	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
</style>
</style>
<section class="content">
	<div id="modal_loading" class="modal fade" role="dialog" ><!-- data-backdrop="static" data-keyboard="false"> -->
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Loading</h4>
				</div>
				<div class="modal-body">
					<br>
					<center><div class="loader"></div></center>
					<br>
				</div>
			</div>

		</div>
	</div>
	<div class="box box-primary" style="min-height: 600px;">
		<div class="box-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<center>
							<div class="btn btn-danger" style="padding: 20px; font-size: 52px; width: 200px; display: ;" id="random_number">99999</div><br><br>
						</center>
					</div>
				</div>
				<br>
				<section id="pemenang">
					<div id="alert_pemenang" style="display: none;" name="asd">
						<div class="alert alert-success alert-dismissible">
							<h4><i class="icon fa fa-check"></i> <span id="pemenang_hadiah_alert"></span></h4>
							<span id="pemenang_nama_alert"></span>
						</div>
						<center>
							<button type="submit" class="btn btn-primary" style="padding: 10px; font-size: 18px; width: 100px;" id="button_simpan">SIMPAN</button> <button type="submit" class="btn btn-danger" style="padding: 10px; font-size: 18px; width: 100px;" id="button_ulang">ULANG</button>
						</center>
					</div>
				</section>
				<!-- <div class="row">
					<div id="out_hadiah_type">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<select class="form-control" id="type_hadiah_select">
								<option value="0">Dorprize</option>
								<option value="1">Hadiah Utama</option>
								<optgroup label="Florida Atlantic University">
									<option value="1">Text</option>
									<option value="2">Text</option>
									<option value="3">Text</option>
								</optgroup>
								<optgroup label="Florida Tech">
									<option value="4">Text</option>
									<option value="5">Text</option>
									<option value="6">Text</option>
								</optgroup>
							</select>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<br> -->
				<div class="row">
					<div id="out_hadiah">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div id="hadiah_0">
								<select class="form-control" id="sel_hadiah">
									<optgroup label="Dorprize">
										@foreach($response['hadiah'] as $item_hadiah) 
										@if($item_hadiah->type_hadiah == 0)
										<option value="{{$item_hadiah->id}}">{{$item_hadiah->nama}}</option>
										@endif
										@endforeach
									</optgroup>
									<optgroup label="Hadiah Utama">
										@foreach($response['hadiah'] as $item_hadiah) 
										@if($item_hadiah->type_hadiah == 1)
										<option value="{{$item_hadiah->id}}">{{$item_hadiah->nama}}</option>
										@endif
										@endforeach
									</optgroup>
								</select>
							</div>
							<!-- <div id="hadiah_1" style="display: none;">
								<select class="form-control" id="sel_hadiah">
									@foreach($response['hadiah'] as $item_hadiah) 
									@if($item_hadiah->type_hadiah == 1)
									<option value="{{$item_hadiah->id}}">{{$item_hadiah->nama}}</option>
									@endif
									@endforeach
								</select>
							</div> -->
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<center>
							<button type="submit" class="btn btn-primary" style="padding: 10px; font-size: 28px; width: 200px;" id="button_mulai">ACAK</button>
						</center>
					</div>
				</div>
				<center>
					<div id="out_hadiah">
						<!-- <div id="hadiah_0">
							@foreach($response['hadiah'] as $item_hadiah) 
							@if($item_hadiah->type_hadiah == 0)
							<label class="btn btn-default" style="padding: 10px">
								<input type="radio" name="hadiah" value="{{$item_hadiah->id}}"><div>{{$item_hadiah->nama}} ( {{$item_hadiah->sisa}} )</div>
							</label>
							@endif
							@endforeach
						</div> -->
						<!-- <div id="hadiah_1" style="display: none;">
							@foreach($response['hadiah'] as $item_hadiah) 
							@if($item_hadiah->type_hadiah == 1)
							<label class="btn btn-default" style="padding: 10px">
								<input type="radio" name="hadiah" value="{{$item_hadiah->id}}"><div>{{$item_hadiah->nama}} ( {{$item_hadiah->sisa}} )</div>
							</label>
							@endif
							@endforeach
						</div> -->
					</div>
				</center>
				<br>
				<center><div class="loader" id="loader" style="display: none;"></div></center>
				<br>
				<br>
				<div class="col-sm-12">
					<table id="table_undian" class="table table-striped" style="display: ;" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>NP</th>
								<th>Nama</th>
								<th>Hadiah</th>
							</tr>
						</thead>
						<tbody>
							<?php $number = 0; ?>
							@foreach($response['undian'] as $item_undian_table)
							<?php $number++; ?>
							<tr >
								<td>{{$number}}</td>
								<td>{{$item_undian_table->np}}</td>
								<td>{{$item_undian_table->nama_karyawan}}</td>
								<td>{{$item_undian_table->nama_hadiah}}</td>
							</tr>
							@endforeach
						</tbody>

						@foreach($response['hadiah'] as $item_hadiah_table)
						@foreach($response['undian'] as $item_undian_table)
						@if($item_undian_table->id_hadiah == $item_hadiah_table->id)
						<tbody id="table_undian_{{$item_hadiah_table->id}}" style="display: none;">
							@foreach($response['undian'] as $item_undian_table)
							@if($item_undian_table->id_hadiah == $item_hadiah_table->id)
							<tr id="undian_tabel_{{$item_hadiah_table->id}}">
								<td>{{$item_undian_table->np}}</td>
								<td>{{$item_undian_table->np}}</td>
								<td>{{$item_undian_table->nama_karyawan}}</td>
								<td>{{$item_undian_table->nama_hadiah}}</td>
							</tr>
							@endif
							@endforeach
						</tbody>
						@endif
						@endforeach
						@endforeach
					</table>
				</div>
			</div>

		</div>
	</div>
</section>
@endsection