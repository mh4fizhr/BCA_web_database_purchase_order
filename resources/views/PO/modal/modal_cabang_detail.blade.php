<div class="modal fade" id="cabang" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                    <i class="fa fa-building fa-3x"></i> 

                            <h4 class="heading mt-4 text-uppercase">Detail Cabang</h4>
                            <br>
                                <table class="table table-borderless table-responsive align-items-center table-flush text-center" id="myTable">
                                  <thead class="">
                                    <tr>
                                      <th scope="col"><b>Kode Cabang</b></th>
                                      <th scope="col"><b>Nama Cabang</b></th>
                                      <th scope="col"><b>Inisial Cabang</b></th>
                                      <th scope="col"><b>Cabang Utama</b></th>
                                      <th scope="col"><b>Status Cabang</b></th>
                                      <th scope="col"><b>Wilayah</b></th>
                                      <th scope="col"><b>Kota</b></th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                    <?php 
                                      $i = 1;
                                    ?>

                                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')

                                      
                                        <tr role="row" class="odd">
                                          <td>{{$po->cabang_relokasi->KodeCabang}}</td>
                                          <td>{{$po->cabang_relokasi->NamaCabang}}</td>
                                          <td>{{$po->cabang_relokasi->InisialCabang}}</td>
                                          <td>{{$po->cabang_relokasi->CabangUtama}}</td>
                                          <td>{{$po->cabang_relokasi->StatusCabang}}</td>
                                          <td>{{$po->cabang_relokasi->KWL}}</td>
                                          <td>{{$po->cabang_relokasi->Kota}}</td>
                                          <?php $i++; ?>
                                        </tr>
                                        

                                    @else

                                      
                                        <tr role="row" class="odd">
                                          <td>{{$po->cabang->KodeCabang}}</td>
                                          <td>{{$po->cabang->NamaCabang}}</td>
                                          <td>{{$po->cabang->InisialCabang}}</td>
                                          <td>{{$po->cabang->CabangUtama}}</td>
                                          <td>{{$po->cabang->StatusCabang}}</td>
                                          <td>{{$po->cabang->KWL}}</td>
                                          <td>{{$po->cabang->Kota}}</td>
                                          <?php $i++; ?>
                                        </tr>
                                        

                                    @endif

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