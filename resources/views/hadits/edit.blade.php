<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Edit Hadits</h4>
</div>
<form action="{{route('hadits.update', $response['data']->id)}}" method="post">
  <input name="_method" type="hidden" value="PATCH">
  {{csrf_field()}}
  <div class="modal-body">
    <div class="form-group">
      <label for="exampleInputEmail1">BAB</label>
      <select class="form-control" name="id_bab">
        <option value="{{$response['data']->id_bab}}">HR. {{$response['data']->nama_imam}} ( {{$response['data']->nama_kitab}} ) - {{$response['data']->nama_bab}}</option>
        @foreach($response['model'] as $model) 
        <option value="{{$model->id}}"><b>HR. {{$model->nama_imam}} ( {{$model->nama_kitab}} )</b> - {{$model->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Isi Hadits</label>
      <textarea class="form-control" rows="5" name="isi">{{$response['data']->isi}}</textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
