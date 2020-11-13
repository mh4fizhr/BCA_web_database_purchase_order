@foreach($mobils as $mobil)
              @if($po->Mobil_id == $mobil->id)
    <div class="card">
      <div class="card-header border-0 bg-gradient-default">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title text-white"><i class="fa fa-car"></i>&nbsp mobil : <b>{{$mobil->MerekMobil}}</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th>Kode Mobil</th>
              <th>Merek Mobil</th>
              <th>Tahun</th>
              <th>No.Polisi</th>
            </tr>
          </thead>
          <tbody>
              <tr role="row" class="odd">
                <td>{{$mobil->KodeMobil}}</td>
                <td>{{$mobil->MerekMobil}}</td>
                <td>{{$mobil->Tahun}}</span></td>
                <td><span class="badge badge-success">{{$mobil->NoPolisi}}</span></td>
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

                
    

