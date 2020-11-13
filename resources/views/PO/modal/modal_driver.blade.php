<div class="modal fade" id="driver" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-lg modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-success">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">DETAIL</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="py-3 text-center">
                    <i class="fa fa-user fa-3x"></i> 
                    @foreach($drivers as $driver)
                        @if($po->Driver_id == $driver->id)
                            <h4 class="heading mt-4 text-uppercase">{{$driver->NamaDriver}}</h4>
                            <br>
                            <table class="table  align-items-center table-flush text-center text-white" id="myTable">
                              <thead class="">
                                <tr>
                                  <th>NIK</th>
                                  <th>NIP</th>
                                  <th>Nama Driver</th>
                                  <th>Vendor</th>
                                </tr>
                              </thead>
                              <tbody>

                                  <tr role="row" class="odd">
                                    <td>{{$driver->nik}}</td>
                                    <td>{{$driver->nip}}</td>
                                    <td>{{$driver->NamaDriver}}</td>
                                    <td>@foreach($vendors as $vendor)
                                      @if($vendor->id == $driver->vendor_id)
                                        {{$vendor->NamaVendor}}
                                      @endif
                                    @endforeach
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                            
                        @endif
                    @endforeach
                </div>
            </div>
            
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-white">Ok, Got it</button>
                <button type="button" class="btn btn-white text-white ml-auto" data-dismiss="modal">Close</button> -->
            </div>
            
        </div>
    </div>
</div>

