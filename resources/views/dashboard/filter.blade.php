<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-search"></i>&nbsp Filter Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/backend/dashboard')}}" method="post" role="form">
          {{ csrf_field() }}
          <div class="card-body">

            <div class="row form-group">
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label ml-3 mt-2" >CP/D :</label>
                </div>
              </div>
              <?php $cps = App\cp::where('active','')->get(); ?>
              <div class="col-md-9">
                <div class="form-group">
                  <select class="form-control" id="CP" name="CP">
                    <option value=""></option>
                    <option value=" D ">D</option>
                    @foreach($cps as $cp)
                      @if($cp->active != '1')
                        <option value="{{$cp->jenis}} - {{$cp->kota}}">{{$cp->jenis}} - {{$cp->kota}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-12 mb-3"></div>
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label ml-3 " >No PO :</label>
                    </div>
                    <div id="nopo_ajax"></div>
              </div>
              <div class="col-md-9">
                    <div class="form-group">
                      <!-- <input type="text" class="form-control" name="nopo" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                      <input type="text" id="nopo" class="form-control form-control-sm" name="nopo">
                    </div>
              </div>
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                <div class="form-group" id="contoh_tambahan">
                  <label class="form-control-label ml-3 " >Jenis Sewa :</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <select class="form-control form-control-sm " id="sewa" name="sewa" >
                    <option value=""></option>
                    <option value="Mobil+Driver">Mobil + Driver</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Driver">Driver</option>
                  </select>
                </div>
              </div>
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                <div class="form-group" id="contoh_tambahan">
                  <label class="form-control-label ml-3 " >Nopol :</label>
                </div>
              </div>
              <div class="col-md-9">
                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol">
              </div>
              
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label ml-3 " >Type/Unit :</label>
                    </div>
              </div>
              <div class="col-md-9">
                    <div class="form-group">
                      <select class="form-control form-control-sm" id="type" name="mobil_id">
                        <option value=""></option>
                        <!-- <option value="null">Tanpa Unit</option> -->
                        @foreach($mobils as $mobil)
                          @if($mobil->active != '1')
                          <option value="{{$mobil->id}}">{{$mobil->MerekMobil}}&nbsp{{$mobil->Type}}&nbsp- {{$mobil->Tahun}}</option>
                          @endif
                        @endforeach

                      </select>
                    </div>
              </div>
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label ml-3 " >Vendor :</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <select class="form-control form-control-sm" id="vendor" name="vendor_id">
                    <option value=""></option>
                    @foreach($vendors as $vendor)
                      @if($vendor->active != '1')
                        <option value="{{$vendor->id}}">{{$vendor->KodeVendor}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- ``````````````````````````````````````````````````````````````````` -->
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label ml-3 " >Cabang & Kota:</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <select class="form-control form-control-sm cabang" id="cabang" name="cabang_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                    <option value=""></option>
                    <?php $ckota = "" ?>
                    @foreach($cabangs as $cabang)
                      @if($cabang->active != '1')
                        <option value="{{$cabang->id}}">{{$cabang->NamaCabang}} - {{$cabang->KodeCabang}} - {{$cabang->Kota}} - {{$cabang->StatusCabang}}</option>
                      @endif
                    <?php $ckota = $cabang->Kota ?>
                    @endforeach
                  </select>
                </div>
              </div>
              
              
          </div>
          <!-- /.card-body -->
          
        
      </div>
      <div class="modal-footer">
        <div class="float-right">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Search</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>