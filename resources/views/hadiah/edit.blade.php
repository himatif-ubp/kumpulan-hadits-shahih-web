<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Edit Hadiah</h4>
</div>
<form action="{{route('hadiah.update', $model->id)}}" method="post">
  <input name="_method" type="hidden" value="PATCH">
  {{csrf_field()}}
  <div class="modal-body">
    <div class="form-group">
      <input type="hidden" class="form-control" name="id" placeholder="ID" required="" value="{{$model->id}}" disabled="true">
      <label >Nama Hadiah</label>
      <input type="text" class="form-control" name="nama" placeholder="Emg Name" required="" value="{{$model->nama}}">
    </div>
    <div class="form-group">
      <label >Qty</label>
      <input type="text" class="form-control" name="qty" placeholder="Emg Kode" required="" value="{{$model->qty}}">
    </div>
    <div class="form-group">
      <label >Type Hadiah</label>
      <select class="form-control" id="sel1" name="type">
        <option value="{{$model->type_hadiah}}">
          @if ($model->type_hadiah == 0)
          Dorprize
          @endif
          @if ($model->type_hadiah == 1)
          Hadiah Utama
          @endif
        </option>
        <option value="0">Dorprize</option>
        <option value="1">Hadiah Utama</option>
      </select>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
