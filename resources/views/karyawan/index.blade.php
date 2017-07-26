@extends('dashboard')
@section('content')
<section class="content-header">
	<h1>
		Hadits
		<small>View All</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-calendar"></i> Hadits</a></li>
		<li class="active">View All</li>
	</ol>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Input Hadits</h3>
		</div>
		<form role="form">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">NP</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter NP">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">NP</label>
					<select class="form-control" id="sel_hadiah">
						<optgroup label="Dorprize">
							<option>asd</option>
						</optgroup>
						<optgroup label="Hadiah Utama">
							<option>asd</option>
						</optgroup>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Barcode</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Barcode">
				</div>
			</div>
			<!-- /.box-body -->

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
									<th>No</th>
									<th>NP</th>
									<th>Nama</th>
									<th>Barcode</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection