@foreach($umps as $ump)
    @if($po->Ump_id == $ump->id)
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <span class="card-title"><i class="fas fa-calendar-alt"></i>&nbsp Tanggal Sewa <b>mulai - selesai</b></span>
          </div>
          <div class="col text-right">
            <a href="/backend/po/show/{{$po->id}}" class="btn btn-sm btn-primary">Refresh</a>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th scope="col">Harga Sewa Mobil(Rp)</th>
              <th scope="col">Harga Sewa Mobil 2019(Rp)</th>
              <th scope="col">Harga Sewa Mobil + Driver(Rp)</th>
            </tr>
          </thead>
          <tbody>
              <tr role="row" class="odd">
                <td><a href="#" class="tglpo" 
                  data-name="hargasewamobil" 
                  data-type="number" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan Nominal Harga sewa mobil" style="color: black">
                  @currency($po->HargaSewaMobil)</a>
                </td>
                <td><a href="#" class="tglpo" 
                  data-name="hargasewadriver2019" 
                  data-type="number" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan Nominal Harga sewa mobil" style="color: black">
                  @currency($po->HargaSewaDriver2019)</a>
                </td>
                <td>
                  <?php $hsmd = $po->HargaSewaDriver2019 + $po->HargaSewaMobil ?>
                  @currency($hsmd)</a>
                </td>
              </tr>

          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix text-right" style="display: block;">
        <a class="btn btn-danger btn-sm" href="/backend/po/delete/{{$po->id}}">
            <i class="fas fa-trash">
            </i>
            Delete
        </a>
      </div>
    </div>
  @endif
@endforeach

                  