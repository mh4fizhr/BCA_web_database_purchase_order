@foreach($cabangs as $cabang)
       @if($po->Cabang_id == $cabang->id)
    <div class="card">
      <div class="card-header border-0 bg-gradient-danger">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title text-white"><i class="fas fa-map"></i>&nbsp Cabang : <b>{{$cabang->NamaCabang}}</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th scope="col">Kode Cabang</th>
              <th scope="col">Nama Cabang</th>
              <th scope="col">Inisial Cabang</th>
              <th scope="col">Cabang Utama</th>
              <th scope="col">Status</th>
              <th scope="col">KWL</th>
              <th scope="col">Kota</th>
            </tr>
          </thead>
          <tbody>

              <tr role="row" class="odd">
                <td>{{$cabang->KodeCabang}}</td>
                <td>{{$cabang->NamaCabang}}</td>
                <td>{{$cabang->InisialCabang}}</span></td>
                <td>{{$cabang->CabangUtama}}</td>
                <td>{{$cabang->StatusCabang}}</td>
                <td>{{$cabang->KWL}}</td>
                <td>{{$cabang->Kota}}</td>
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

                  