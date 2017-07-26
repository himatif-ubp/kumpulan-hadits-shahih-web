<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Edit BAB</h4>
</div>
<form action="{{route('bab.update', $response['model']->id)}}" method="post">
  <input name="_method" type="hidden" value="PATCH">
  {{csrf_field()}}
  <div class="modal-body">
    <div class="form-group">
      <label for="exampleInputEmail1">Kitab</label>
      <select class="form-control" name="id_kitab">
        <option value="{{$response['model']->id_kitab}}">{{$response['model']->nama_kitab}} ( {{$response['model']->nama_imam}} )</option>
        @foreach($response['imam'] as $model) 
        <option value="{{$model->id}}">{{$model->nama}} ( {{$model->nama_imam}} )</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="id" placeholder="ID" required="" value="{{$response['model']->id}}" disabled="true">
      <label for="exampleInputEmail1">Nama BAB</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Imam" name="nama" value="{{$response['model']->nama}}">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
