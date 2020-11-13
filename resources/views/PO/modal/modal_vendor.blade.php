<div class="modal fade" id="vendor" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-info">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">DETAIL</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="py-3 text-center">
                    <i class="fas fa-user-tie fa-3x"></i> 
                    @foreach($vendors as $vendor)
                        @if($po->Vendor_Driver == $vendor->id)
                            <h4 class="heading mt-4 text-uppercase">{{$vendor->NamaVendor}}</h4>
                            <br>
                            <table class="table align-items-center table-flush text-center text-white" id="myTable">
                              <thead class="">
                                <tr>
                                  <th>Kode Vendor</th>
                                  <th>PIC Vendor</th>
                                </tr>
                              </thead>
                              <tbody>

                                  <tr role="row" class="odd">
                                    <td>{{$vendor->KodeVendor}}</td>
                                    <td>{{$vendor->PICvendor}}</td>
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

