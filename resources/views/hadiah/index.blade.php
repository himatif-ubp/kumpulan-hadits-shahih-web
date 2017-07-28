@extends('dashboard')
@section('content')
<section class="content-header">
	<h1>
		Hadiah
		<small>View All</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-calendar"></i> Hadiah</a></li>
		<li class="active">View All</li>
	</ol>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Input Hadiah</h3>
		</div>

		<div class="box-footer">
			<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal_input">Tambah</button>
		</div>
		
		<div class="box-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Hadiah</th>
									<th>Qty</th>
									<th>Type Hadiah</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($model as $item)
								<tr>
									<td>{{$item->id}}</td>
									<td>{{$item->nama}}</td>
									<td>{{$item->qty}}</td>
									<td>
										@if ($item->type_hadiah == 0)
										Dorprize
										@endif
										@if ($item->type_hadiah == 1)
										Hadiah Utama
										@endif
									</td>
									<td><a href="{{route('hadiah.edit', $item->id)}}" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-id="{{$item->id}}" >Edit</a> <a href="#modal_delete'" class="btn btn-danger" data-toggle="modal" data-target="#modal_delete_{{$item->id}}" data-id="{{$item->id}}" >Delete</a></td>
								</tr>
								<!-- Modal Delete-->
								<div class="modal fade" id="modal_delete_{{$item->id}}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Hapus Data</h4>
											</div>
											<form action="{{route('hadiah.destroy', $item->id)}}" method="post" id="form_delete" accept-charset="UTF-8">
												<input name="_method" type="hidden" value="DELETE">
												<input name="_token" type="hidden" value="{{ csrf_token() }}">
												<div class="modal-body">
													<h4 class="modal-title">Apakah anda yakin akan menghapus?</h4>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-danger">Ya</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Input -->
		<div class="modal fade" id="modal_input" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Input Hadiah</h4>
					</div>
					<form action="{{route('hadiah.store')}}" method="post">
						{{csrf_field()}}
						<div class="box-body">
							<div class="form-group">
								<label for="qyy">Nama Hadiah</label>
								<input type="text" class="form-control" id="nama" placeholder="Nama Hadiah" name="nama">
							</div>
							<div class="form-group">
								<label for="qty">Qty</label>
								<input type="number" class="form-control" id="qty" placeholder="Qty" name="qty">
							</div>
							<div class="form-group">
								<label for="sel1">Type Hadiah</label>
								<select class="form-control" id="sel1" name="type">
									<option value="0">Dorprize</option>
									<option value="1">Hadiah Utama</option>
								</select>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>

			</div>
		</div>
		<!-- Modal Edit-->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>

	</div>
</section>
@endsection