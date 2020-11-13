@foreach($umps as $ump)
   @if($po->Ump_id == $ump->id)
    <div class="card">
      <div class="card-header border-0 bg-gradient-primary">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title text-white"><i class="fas fa-map"></i>&nbsp Kota : <b>{{$ump->Kota}}</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th>Kota</th>
              <th>Daerah</th>
              <th>Provinsi</th>
              <th>ump</th>
            </tr>
          </thead>
          <tbody>
  
              <tr role="row" class="odd">
                <td><a href="pages/examples/invoice.html">{{$ump->Kota}}</a></td>
                <td>{{$ump->Daerah1}}</td>
                <td>{{$ump->Daerah2}}</td>
                <td>Rp. {{$ump->ump}}</td>
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

                
    


