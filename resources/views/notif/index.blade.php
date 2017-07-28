@extends('dashboard')
@section('content')
<style type="text/css">
	#custom-search-input{
		padding: 3px;
		border: solid 1px #E4E4E4;
		border-radius: 6px;
		background-color: #fff;
	}

	#custom-search-input input{
		border: 0;
		box-shadow: none;
	}

	#custom-search-input button{
		margin: 2px 0 0 0;
		background: none;
		box-shadow: none;
		border: 0;
		color: #666666;
		padding: 0 8px 0 10px;
		border-left: solid 1px #ccc;
	}

	#custom-search-input button:hover{
		border: 0;
		box-shadow: none;
		border-left: solid 1px #ccc;
	}

	#custom-search-input .glyphicon-search{
		font-size: 23px;
	}

</style>
<section class="content-header">
	<h1>
		Notifikasi
		<small>View All</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-calendar"></i> Notifikasi</a></li>
		<li class="active">View All</li>
	</ol>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Notifikasi</h3>
		</div>
		<form action="{{route('notif.store')}}" method="post">
			{{csrf_field()}}
			<div class="box-body">
				<div class="form-group">
					<div id="custom-search-input">
						<div class="input-group col-md-12">
							<input type="text" class="form-control input-lg" name="cari" placeholder="Cari..." />
							<span class="input-group-btn">
								<button class="btn btn-info btn-lg" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
			</div>
		</form>
		<div class="box-body">
			@if(Session::has('alert-success'))
			<div class="alert alert-success">
				{{ Session::get('alert-success') }}
			</div>
			@endif
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						@if(isset($response))
						<table id="table" class="table table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Id</th>
									<th>Imam</th>
									<th>Bab</th>
									<th>Isi</th>
									<th>Action</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						@endif
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
		$("#table").each(function(){
			var search = "menceritakan";
			var text = $(".hadits_class").text();
			// $('.hadits_class').text(text.replace(search, '<span style="color:red;">$1</span>')).html(); 
			// console.log();
		});
		@if(isset($response))
		$('#table').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false,
			"processing": true,
			"serverSide": true,
			"ajax": "/api/notif/all?term={{$response['cari']}}",
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'nama_imam', name: 'nama_imam' },
			{ data: 'nama_kitab', name: 'nama_kitab' },
			{ data: 'nama_bab', name: 'nama_bab' },
			{ data: 'isi', name: 'isi' },
			{ render : function(data, type, row, meta){
				var a = '<a href="/api/notif/kirim?id='+row.id_bab+'" class="btn btn-info btn-small" id="custId">KIRIM</a>'
				return a;
			}
		}]
	})
		@endif
	});
</script>
@endsection