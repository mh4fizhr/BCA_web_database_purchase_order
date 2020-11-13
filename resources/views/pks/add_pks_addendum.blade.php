  <div class="collapse" id="collapseExample">
    <div class="card">
      <div class="card-header">
          <h3 class=""><i class="fas fa-file-contract"></i> &nbsp Addendum</h3>
      </div>
      <div class="card-body">

                       <form action="{{url('/backend/addendum_id/edit/'.$pks->id)}}" method="post" role="form" enctype="multipart/form-data">
                         {{ csrf_field() }}
                         <h4 class="text-center" id="error_addendum"></h4>

                           <div class="row form-group">
                             <div class="col-md-10">
                               <label for="exampleInputtext1">Addendum</label>
                               <select class="form-control select2" id="addendum_id" name="addendum_id" required>
                                 <option value="">-- pilih addendum --</option>
                                 @foreach($all_addendums as $all_addendum)
                                   @if($all_addendum->active != '1' && $all_addendum->vendor == $pks->vendor && $all_addendum->pks_id == '')
                                   <option value="{{$all_addendum->id}}">{{$all_addendum->no_addendum}} - {{$all_addendum->nama_kontrak_addendum}} - {{ date('d M Y', strtotime($all_addendum->tgl_addendum))}}</option>
                                   @endif
                                 @endforeach
                               </select>
                             </div>
                             <div class="col-md-2">
                               <button type="submit" id="submit" class="btn btn-success btn-block" style="margin-top: 33px"><i class="fa fa-plus"></i> &nbspTambahkan</button>
                             </div>
                           </div>

                           <hr>
                           
                        
                           <h3 class="text-center">~~ Detail addendum ~~</h3>
                           <div class="row form-group">
                             <div class="col-md-12">
                               <label for="exampleInputtext1">Vendor</label>
                               <input type="text" name="vendor" id="vendor" class="form-control" disabled="">
                             </div>
                           </div>
                           
                           <div class="row form-group">
                             <div class="col-md-5">
                               <label for="exampleInputtext1">No addendum</label>
                               <input type="text" name="no_addendum" class="form-control" id="no_addendum"  disabled="">
                             </div>
                             <div class="col-md-7">
                               <label for="exampleInputtext1">Tgl addendum</label>
                               <input class="form-control date" type="text" name="tgl_addendum" id="tgl_addendum" disabled="">
                             </div>
                           </div>
                           <div class="row form-group">
                             <div class="col-md-12">
                               <label for="exampleInputtext1">Nama kontrak addendum</label>
                               <input type="text" name="nama_kontrak_addendum" class="form-control" id="nama_kontrak_addendum" disabled="">
                             </div>
                           </div>
                           <div class="form-group">
                             <label for="exampleInputtext1">Keterangan</label>
                             <textarea class="form-control" name="deskripsi" id="deskripsi" rows="2" disabled=""></textarea>
                           </div>
                           <label for="exampleInputtext1">File </label>
                           <br>
                           <label id="file"></label>
                           
                         <!-- /.card-body -->
                         <!-- <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" id="submit" class="btn btn-success">Submit</button>
                         </div> -->
                       </form>
        
      </div>
      <div class="card-footer">
        <a class="btn btn-danger float-right pl-5 pr-5" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Cancel</a>
      </div>
  </div>
</div>


