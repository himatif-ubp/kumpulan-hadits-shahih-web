<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Edit Imam</h4>
</div>
<form action="{{route('imam.update', $model->id)}}" method="post">
  <input name="_method" type="hidden" value="PATCH">
  {{csrf_field()}}
  <div class="modal-body">
    <div class="form-group">
      <input type="hidden" class="form-control" name="id" placeholder="ID" required="" value="{{$model->id}}" disabled="true">
      <label for="exampleInputEmail1">Nama Imam</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Imam" name="nama" value="{{$model->nama_imam}}">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
