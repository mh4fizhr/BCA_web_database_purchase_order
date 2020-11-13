@foreach($vendors as $vendor)
  @if($po->Vendor_Driver == $vendor->id)
    <div class="card">
      <div class="card-header border-0 bg-gradient-primary">
        <div class="row align-items-center">
          <div class="col-12">
            <span class="card-title text-white"><i class="fas fa-user-tie"></i>&nbsp Vendor : <b>{{$vendor->NamaVendor}}</b></span>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush text-center" id="myTable">
          <thead class="thead-light">
            <tr>
              <th>Kode Vendor</th>
              <th>Nama Vendor</th>
              <th>PIC Vendor</th>
            </tr>
          </thead>
          <tbody>
              <tr role="row" class="odd">
                <td>{{$vendor->KodeVendor}}</td>
                <td>{{$vendor->NamaVendor}}</td>
                <td>{{$vendor->PICvendor}}</span></td>
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

                
    



