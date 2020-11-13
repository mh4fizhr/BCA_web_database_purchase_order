@foreach($umps as $ump)
    @if($po->Ump_id == $ump->id)
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title"><i class="fas fa-calendar-alt"></i>&nbsp Tanggal Sewa <b>mulai - selesai</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th scope="col">Mulai Sewa</th>
              <th scope="col">Tgl Bastk</th>
              <th scope="col">Tgl Bastd</th>
              <th scope="col">Tgl Cut Off</th>
              <th scope="col">Selesai Sewa</th>
            </tr>
          </thead>
          <tbody>
              <tr role="row" class="odd">
                <td><a href="#" class="tglpo" 
                  data-name="mulaisewa" 
                  data-type="date" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan tanggal Mulai Sewa">
                  {{$po->MulaiSewa}}</a>
                </td>
                <td><a href="#" class="tglpo" 
                  data-name="tgl_bastk" 
                  data-type="date" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan tanggal bastk">
                  {{$po->Tgl_bastk}}</a>
                </td>
                <td><a href="#" class="tglpo" 
                  data-name="tgl_bastd" 
                  data-type="date" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan tanggal bastd">
                  {{$po->Tgl_bastd}}</a>
                </td>
                <td><a href="#" class="tglpo" 
                  data-name="tgl_cutoff" 
                  data-type="date" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan tanggal Cut Off">
                  {{$po->Tgl_cutoff}}</a>
                </td>
                <td><a href="#" class="tglpo" 
                  data-name="selesaisewa" 
                  data-type="date" 
                  data-pk="{{$po->id}}" 
                  data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                  data-title="Masukkan tanggal selesai sewa">
                  {{$po->SelesaiSewa}}</a>
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

                  