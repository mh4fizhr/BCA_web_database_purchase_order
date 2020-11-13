<div class="modal fade" id="pengurangan" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-secondary modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><i class="fas fa-user "></i>&nbsp history sewa</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                  <span class="ml-4" >Sewa awal &nbsp:&nbsp <b>{{$po->Sewa_permanent}}</b></span>
                <div class="py-1">
<!--                     <i class="fa fa-building fa-3x"></i>
                    
                            <h4 class="heading mt-4 text-uppercase">{{$po->Sewa_permanent}}</h4> -->
                            
                            <br>
                            <table class="table table-responsive align-items-center table-borderless table-flush text-center mydatatable" id="myTable">
                              <thead class="">
                                <tr>
                                  <th scope="col" style="width: 100px">No</th>
                                  <th scope="col" style="width: 100px">No.Po</th>
                                  <th scope="col" style="width: 100px">Pengurangan</th>
                                  <th scope="col" style="width: 100px">Penambahan</th>
                                  <th scope="col" style="width: 100px">Perubahan</th>
                                  <th scope="col" style="width: 100px">Tgl Efektif</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i=1; ?>
                              @foreach($pengurangans as $pengurangan)
                                @if($pengurangan->Po_id == $po->id)
                                  <tr role="row" class="odd">
                                    <td>{{$i}}</td>
                                    <td>
                                      @if($pengurangan->Nopo_pengurangan == '')
                                        -
                                      @else
                                        {{$pengurangan->Nopo_pengurangan}}
                                      @endif
                                    </td>
                                    <td>{{$pengurangan->pengurangan}}</td>
                                    <td>
                                      @if(isset($pengurangan->penambahan))
                                        {{$pengurangan->penambahan}}
                                      @endif
                                    </td>
                                    <td>
                                      @if(isset($pengurangan->perubahan))
                                        {{$pengurangan->perubahan}}
                                      @endif
                                    </td>
                                    @if($pengurangan->penambahan != '' || $pengurangan->perubahan != '')
                                      <td>{{ date('d-M-Y', strtotime($pengurangan->tgl_efektif))}}</td>
                                    @else
                                      <td>{{ date('d-M-Y', strtotime($pengurangan->tgl_cutoff))}}</td>
                                    @endif
                                    
                                  </tr>
                                  <?php $i++; ?>
                                @endif
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