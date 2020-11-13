<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $("#mobil").show();
        $("#driver").show();
        $("#sewa").change(function () {
            if ($(this).val() == "Mobil") {
                $("#mobil").show();
                $("#driver").hide();
            } else if($(this).val() == "Driver") {
                $("#mobil").hide();
                $("#driver").show();
            } else{
                $("#mobil").show();
                $("#driver").show();
            }
        });
    });
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $page ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/backend/po/create')}}" method="post" role="form">
          {{ csrf_field() }}
          <div class="card-body">
            <p class="text-center text-danger">*Masukkan data <?php echo $page ?> sesuai petunjuk yang ada di form</p>
            <br>
            <div class="form-group">
                <label for="exampleInputtext1">Nomor PO</label>
                <input type="text" name="nopo" class="form-control" id="exampleInputtext1" placeholder="Masukkan no po" required>
            </div>
            <div class="row form-group">
              <div class="col-md-8">
                <label for="exampleInputtext1">Sewa</label>
                  <select class="form-control" id="sewa" name="sewa">
                    <option value="Mobil+Driver">Mobil + Driver</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Driver">Driver</option>
                  </select>
              </div>
              <div class="col-md-4">
                <label for="exampleInputtext1">CP/D</label>
                <select class="form-control" name="CP">
                  <option value="CP">CP</option>
                  <option value="D">D</option>
                </select>
              </div>
            </div>
            
            <div class="row form-group">
              <div class="col-md-12">
                  <label for="exampleInputtext1">Mulai sewa</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Select date" name="mulaisewa" type="text" value="04/20/2020">
                    </div>
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col-md-6">
                  <label for="exampleInputtext1">Nama Cabang</label>
                    <select id="cabang" class="form-control" name="cabang_id">
                      <option value="unknown">unknown</option>
                      @foreach($cabangs as $cabang)
                      <option value="{{$cabang->id}}">{{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputtext1">Kota</label>
                    <select class="form-control" name="ump_id">
                      <option value="unknown">unknown</option>
                      @foreach($umps as $ump)
                      <option value="{{$ump->id}}">{{$ump->Kota}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
              <label for="exampleInputtext1">Vendor</label>
                  <select class="form-control" name="vendor_id">
                    <option value="unknown">unknown</option>
                    @foreach($vendors as $vendor)
                    <option value="{{$vendor->id}}">{{$vendor->NamaVendor}}</option>
                    @endforeach
                  </select>
            </div>
            <input type="hidden" name="status" value="No Complete">
          </div>
          <!-- /.card-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


