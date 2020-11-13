<div class="modal fade" id="relokasi" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-secondary modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><i class="fa fa-building "></i>&nbsp History Relokasi Cabang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="">
<!--                   <div class="text-center">
                    <i class="fa fa-user fa-3x "></i> 
                  </div>
                            <h4 class="heading mt-4 text-uppercase text-center">History Relokasi Cabang</h4> -->
                            <br>
                              <div class="">
                                <table class="table table-responsive align-items-center table-borderless table-flush text-center mydatatable" id="myTable">
                                  <thead class="">
                                    <tr>
                                      <th scope="col" style="width: 100px">No</th>
                                      <th scope="col" style="width: 100px" class="bg-warning text-white">cabang lama</th>
                                      <th scope="col" style="width: 100px" class="bg-info text-white">cabang baru</th>
                                      <th scope="col" style="width: 100px">Nopo Relokasi</th>
                                      <th scope="col" style="width: 100px">Tgl Efektif</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  
                                    <?php $i=1; ?>
                                    @foreach($relokasis as $relokasi)
                                      <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$relokasi->cabang_lama->KodeCabang}} - {{$relokasi->cabang_lama->NamaCabang}}</td>
                                        <td>{{$relokasi->cabang_baru->KodeCabang}} - {{$relokasi->cabang_baru->NamaCabang}}</td>
                                        <td>{{$relokasi->Nopo_relokasi}}</td>
                                        <td>{{$relokasi->Efisien_relokasi->format('d-M-Y')}}</td>
                                      </tr>
                                    @endforeach
                                  
                                  </tbody>
                                </table>
                              </div>
                </div>
                
            </div>
              
            
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-white">Ok, Got it</button>
                <button type="button" class="btn btn-white text-white ml-auto" data-dismiss="modal">Close</button> -->
            </div>
            
        </div>
    </div>
</div>


