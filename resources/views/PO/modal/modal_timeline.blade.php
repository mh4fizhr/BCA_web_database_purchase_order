<div class="modal fade" id="timeline" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-secondary modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><i class="ni ni-calendar-grid-58"></i>&nbsp History Activity</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
              <div class="pl-5 mr-5">
                <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">

                  @foreach($timelines as $timeline)
                    @if($timeline->po_id == $po->id)
                      <div class="timeline-block">
                        
                          @if($timeline->judul == 'Create PO - BPD' || $timeline->judul == 'Create PO - BLK')
                          <span class="timeline-step badge-info">
                            <i class="fa fa-file-invoice"></i>
                          </span>
                          @elseif($timeline->judul == 'Completing PO - BOP')
                          <span class="timeline-step badge-success">
                            <i class="fa fa-check"></i>
                          </span>
                          @elseif($timeline->judul == 'Pairing driver - BPD' || $timeline->judul == 'Pairing driver - BOP')
                          <span class="timeline-step badge-warning">
                            <i class="fa fa-user-plus"></i>
                          </span>
                          @elseif($timeline->judul == 'Pengurangan - BPD' || $timeline->judul == 'Pengurangan - BOP' || $timeline->judul == 'Pengurangan - BLK')
                          <span class="timeline-step badge-danger">
                            <i class="fa fa-file-download"></i>
                          </span>
                          @elseif($timeline->judul == 'Relokasi - BPD' || $timeline->judul == 'Relokasi - BOP' || $timeline->judul == 'Relokasi - BLK')
                          <span class="timeline-step badge-info">
                            <i class="fa fa-file-export"></i>
                          </span>
                          @elseif($timeline->judul == 'Penggantian mobil - BPD' || $timeline->judul == 'Penggantian mobil - BOP')
                          <span class="timeline-step badge-primary">
                            <i class="fa fa-car"></i>
                          </span>
                          @elseif($timeline->judul == 'Penggantian nopol - BPD' || $timeline->judul == 'Penggantian nopol - BOP')
                          <span class="timeline-step badge-primary">
                            <i class="fa fa-exchange-alt"></i>
                          </span>
                          @elseif($timeline->judul == 'Add driver - BPD' || $timeline->judul == 'Add driver - BOP')
                          <span class="timeline-step badge-info">
                            <i class="fa fa-user-plus"></i>
                          </span>
                          @elseif($timeline->judul == 'Delete driver - BPD' || $timeline->judul == 'Delete driver - BOP')
                          <span class="timeline-step badge-danger">
                            <i class="fa fa-user-minus"></i>
                          </span>
                          @elseif($timeline->judul == 'Perubahan pairing - BPD' || $timeline->judul == 'Perubahan pairing - BOP' || $timeline->judul == 'Perubahan pairing - BLK')
                          <span class="timeline-step badge-warning">
                            <i class="fa fa-window-restore"></i>
                          </span>
                          @elseif($timeline->judul == 'Perpanjang PO - BPD' || $timeline->judul == 'Perpanjang PO - BOP')
                          <span class="timeline-step badge-warning">
                            <i class="fa fa-stopwatch"></i>
                          </span>
                          @elseif($timeline->judul == 'Pembatalan relokasi - BPD' || $timeline->judul == 'Pembatalan relokasi - BOP' || $timeline->judul == 'Pembatalan relokasi - BLK')
                          <span class="timeline-step badge-dark">
                            <i class="fa fa-file-export"></i>
                          </span>
                          @elseif($timeline->judul == 'Pembatalan cutoff - BPD' || $timeline->judul == 'Pembatalan cutoff - BOP' || $timeline->judul == 'Pembatalan cutoff - BLK')
                          <span class="timeline-step badge-dark">
                            <i class="fa fa-file-download"></i>
                          </span>
                          @elseif($timeline->judul == 'Pembatalan perubahan - BPD' || $timeline->judul == 'Pembatalan perubahan - BOP' || $timeline->judul == 'Pembatalan perubahan - BLK')
                          <span class="timeline-step badge-dark">
                            <i class="fa fa-window-restore"></i>
                          </span>
                          @endif
                          
                        </span>
                        <div class="timeline-content">
                          <small class="text-muted font-weight-bold">{{date('d-M-Y H:i:s', strtotime($timeline->tanggal))}}</small>

                          @if($timeline->judul == 'Create PO - BPD' || $timeline->judul == 'Create PO - BLK' || $timeline->judul == 'Completing PO - BOP' || $timeline->judul == 'Completing PO - BLK')
                            @if($timeline->user_id != '')
                              <h5 class=" mt-3 mb-3">{{$timeline->judul}} ({{$timeline->user_id}})</h5>
                            @else
                              <h5 class=" mt-3 mb-3">{{$timeline->judul}}</h5>
                            @endif
                          @else
                            <h5 class=" mt-3 mb-3">{{$timeline->judul}}</h5>
                          @endif


                          @if($timeline->ket1 != '')
                            <p class="ml-3 text-sm mt-1 mb-0">{{$timeline->ket1}}</p>
                          @endif
                          @if($timeline->ket2 != '')
                            <p class="ml-3 text-sm mt-1 mb-0">{{$timeline->ket2}}</p>
                          @endif
                          @if($timeline->ket3 != '')
                            <p class="ml-3 text-sm mt-1 mb-0">{{$timeline->ket3}}</p>
                          @endif
                        </div>
                      @endif
                    @endforeach

                  </div>
                  
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
