<?php $nikdriver = "";$nipdriver = "";$namadriver = ""; ?>
@foreach($drivers as $driver)
  @if($po->Driver_id == $driver->id)
    <?php 
      $nikdriver = $driver->nik;
      $nipdriver = $driver->nip;
      $namadriver = $driver->NamaDriver;       
    ?>
  @endif
@endforeach
 @if($nikdriver == "")
    <div class="card">
      <div class="card-header border-0 bg-gradient-success">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title text-white"><i class="fa fa-user"></i>&nbsp Driver : <b>-</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th>NIK</th>
              <th>NIP</th>
              <th>Nama Driver</th>
            </tr>
          </thead>
          <tbody>
     
              <tr role="row" class="odd">
                <td>-</td>
                <td>-</td>
                <td>-</span></td>
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
    @else
    <div class="card">
      <div class="card-header border-0 bg-gradient-success">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title text-white"><i class="fa fa-user"></i>&nbsp Driver : <b>{{$namadriver}}</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th>NIK</th>
              <th>NIP</th>
              <th>Nama Driver</th>
              <th>Vendor</th>
            </tr>
          </thead>
          <tbody>
     
              <tr role="row" class="odd">
                <td>{{$nikdriver}}</td>
                <td>{{$nipdriver}}</td>
                <td>{{$namadriver}}</td>
                <td>@foreach($vendors as $vendor)
                  @if($vendor->id == $driver->vendor_id)
                    {{$vendor->NamaVendor}}
                  @endif
                @endforeach
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


                
    




