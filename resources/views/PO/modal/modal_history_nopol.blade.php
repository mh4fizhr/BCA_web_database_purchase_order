<div class="modal fade" id="nopol" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-secondary modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><i class="fas fa-user "></i>&nbsp history nopol</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="py-1">
                            <!-- <div class="text-center">
                              <i class="fa fa-car fa-3x"></i>
                              <h4 class="heading mt-4 text-uppercase">

                              </h4>
                            </div> -->
                            <br>
                            <table class="table align-items-center table-borderless table-flush text-center mydatatable" id="myTable">
                              <thead class="">
                                <tr>

                                  <th scope="col" style="width: 15%">Nopol</th>
                                  <th scope="col" style="width: 50%">Keterangan</th>
                                  <th scope="col" style="width: 25%">tgl update</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i=1; ?>
                              @foreach($historynopols as $historynopol)
                                  <tr role="row" class="odd">
                                    <td>{{$historynopol->nopol}}</td>
                                    <td>{{$historynopol->keterangan}}</td>
                                    <td>{{ date('d-M-Y', strtotime($historynopol->tgl_update))}} </td>
                                  </tr>
                                  <?php $i++; ?>
                              @endforeach
                              </tbody>
                            </table>
                </div>
                
            </div>
            
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-white">Ok, Got it</button>
                <button type="button" class="btn btn-white text-white ml-auto" data-dismiss="modal">Close</button> -->
            </div>
            
        </div>
    </div>
</div>