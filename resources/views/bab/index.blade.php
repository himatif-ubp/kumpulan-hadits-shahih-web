@extends('dashboard')
@section('content')
<section class="content-header">
	<h1>
		Bab
		<small>View All</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-calendar"></i> Bab</a></li>
		<li class="active">View All</li>
	</ol>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Input Bab</h3>
		</div>
		<form action="{{route('bab.store')}}" method="post">
			{{csrf_field()}}
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Kitab</label>
					<select class="form-control" name="id_kitab">
					@foreach($response['kitab'] as $model) 
						<option value="{{$model->id}}">{{$model->nama}} ( HR. {{$model->nama_imam}} )</option>
					@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Bab</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Bab" name="nama">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		<div class="box-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Id</th>
									<th>Kitab</th>
									<th>Nama Bab</th>
									<th>Input At</th>
									<th>Update At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($response['data'] as $item)
								<tr>
									<td>{{$item->id}}</td>
									<td><b>{{$item->nama_kitab}}</b><br>HR. {{$item->nama_imam}}</td>
									<td style="max-width: 500px; overflow: hidden;word-wrap: break-word;">{{$item->nama}}</td>
									<td>{{$item->created_at}}</td>
									<td>{{$item->updated_at}}</td>
									<td><a href="{{route('bab.edit', $item->id)}}" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit" data-id="{{$item->id}}" >Edit</a> <a href="#modal_delete'" class="btn btn-danger" data-toggle="modal" data-target="#modal_delete_{{$item->id}}" data-id="{{$item->id}}" >Delete</a></td>
								</tr>
								<div class="modal fade" id="modal_delete_{{$item->id}}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Hapus Data</h4>
											</div>
											<form action="{{route('bab.destroy', $item->id)}}" method="post" id="form_delete" accept-charset="UTF-8">
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
		<div class="modal fade" id="modal_edit" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
	 $(document).ready(function(){
      $("#modal_edit").on("hidden.bs.modal", function(){
        $(this).removeData('bs.modal');
      });
      $("#modal_delete").on("hidden.bs.modal", function(){
        $(this).removeData('bs.modal');
      });
    });
</script>
@endsection