<div class="modal fade" id="mobil" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-secondary modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">DETAIL</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="py-3 text-center">
                    <i class="fa fa-car fa-3x"></i>
                    @foreach($mobils as $mobil)
                        @if($po->Mobil_id == $mobil->id)
                            <h4 class="heading mt-4 text-uppercase">{{$mobil->MerekMobil}} {{$mobil->Type}}</h4>
                            <br>
                            <table class="table align-items-center table-flush text-center" id="myTable">
                              <thead class="">
                                <tr>
                                  <th>Merek & Type</th>
                                  <th>Tahun</th>
                                </tr>
                              </thead>
                              <tbody>

                                  <tr role="row" class="odd">
                                    <td>{{$mobil->MerekMobil}} {{$mobil->Type}}</td>
                                    <td>{{$mobil->Tahun}}</span></td>
                                  </tr>
                              </tbody>
                            </table>
                            
                        @endif
                    @endforeach
                </div>
                
            </div>
            
            <div class="modal-footer">
              <!--   <button type="button" class="btn btn-white">Ok, Got it</button>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> -->
            </div>
            
        </div>
    </div>
</div>