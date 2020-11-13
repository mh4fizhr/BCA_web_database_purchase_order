<div class="modal fade" id="history_driver" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-secondary modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><i class="fas fa-user-tie "></i>&nbsp history driver</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="">
<!--                     <i class="fa fa-user fa-3x"></i> 
                    
                            <h4 class="heading mt-4 text-uppercase">History Driver</h4> -->
                            
                            <table class="table table-responsive table-borderless align-items-center table-flush text-center mydatatable" id="myTable">
                              <thead class="">
                                <tr>
                                  <th>No</th>
                                  <!-- <th>action</th> -->
                                  <th style="width:200px">Nama Driver</th>
                                  <th>NIK</th>
                                  <th>NIP</th>
                                  
                                  <th>Tanggal mulai</th>
                                  <th>Tanggal Selesai</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; ?>
                              @foreach($historys as $history)
                                @if($po->id == $history->Po_id)
                                @foreach($drivers as $driver)
                                  @if($driver->id == $history->Driver_id) 
                                    <tr role="row" class="odd text-left">
                                      <td>{{$i}}</td>
                                      
                                        <!-- @if($po->Driver_id == $driver->id)
                                        <td>
                                          <a class="btn btn-secondary btn-sm disabled" href="">
                                              <i class="fas fa-check">
                                              </i>
                                              Active
                                          </a>
                                        </td>
                                        @elseif($po->Driver_id != '')
                                        <td>
                                          <a class="btn btn-info btn-sm disabled" href="">
                                              <i class="fas fa-undo">
                                              </i>
                                              Restore Driver
                                          </a>
                                        </td>
                                        @else
                                        <td>
                                          <form action="{{url('/backend/driver/restore/proses/'.$driver->id)}}" method="post" role="form" id="dynamic_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="po_id" value="{{$po->id}}">
                                            <input type="hidden" name="driver_id" value="{{$driver->id}}">
                                            <button type="submit" class="btn btn-info btn-sm "><i class="fas fa-undo">
                                              </i> Restore Driver</button>
                                          </form>
                                        </td>
                                        @endif -->
                                      
                                      <td class="text-center">{{$driver->NamaDriver}}</td> 
                                      <td>{{$driver->nik}}</td>
                                      <td>{{$driver->nip}}</td>
                                      
                                      <td>
                                        @if($history->tgl_mulai != '')
                                          {{ date('d-M-Y', strtotime($history->tgl_mulai))}}
                                        @else
                                          
                                        @endif
                                      </td>
                                      <td>
                                        @if($history->tgl_selesai != '')
                                          {{ date('d-M-Y', strtotime($history->tgl_selesai))}}
                                        @else
                                          
                                        @endif
                                      </td>
                                    </tr>
                                    <?php $i++; ?>
                                  @endif
                                @endforeach
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



