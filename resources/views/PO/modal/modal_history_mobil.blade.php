<div class="modal fade" id="type" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-secondary modal-dialog-centered modal-" role="document" style="max-width: 1200px">
        <div class="modal-content bg-secondary">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><i class="fas fa-user "></i>&nbsp history mobil</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="py-1">
                            <div class="text-center">
                              <i class="fa fa-car fa-3x"></i>
                              <h4 class="heading mt-4 text-uppercase">
                                @foreach($mobils as $mobil)
                                  @if($po->Mobil_id == $mobil->id)
                                    {{$mobil->MerekMobil}} {{$mobil->Type}} <!-- <span class="text-danger">{{$mobil->Tahun}}</span> -->
                                  @endif
                                @endforeach
                              </h4>
                            </div>
                            <br>
                            <div class="table-responsive">
                            <table class="table align-items-center table-borderless table-flush text-center mydatatable" id="myTable">
                              <thead class="">
                                <tr>

                                  <th scope="col" rowspan="2" >No PO</th>

                                  <th scope="col" colspan="3" class="bg-warning text-white">Before</th>
                                  <th scope="col" colspan="3" class="bg-info text-white">After</th>
                                  

                                  <th scope="col" rowspan="2">tgl update</th>
                                  <th scope="col" rowspan="2">tgl efektif</th>
                                </tr>
                                <tr>
                                  <th scope="col" class="bg-warning text-white">merek & type</th>
                                  <th scope="col" class="bg-warning text-white">tahun</th>
                                  <th scope="col" class="bg-warning text-white">biaya sewa</th>

                                  <th scope="col" class="bg-info text-white">merek & type</th>
                                  <th scope="col" class="bg-info text-white">tahun</th>
                                  <th scope="col" class="bg-info text-white">biaya sewa</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i=1; ?>
                              
                              @foreach($historymobils as $historymobil)
                                  <?php $j=0 ?>
                                  @if($total_historymobil == $i)
                                  @else

                                  <tr role="row" class="odd">
                                    <td>{{$historymobil->Nopo}}</td>

                                    @foreach($historymobils2 as $historymobil2)
                                      @if($j==$i)
                                        @foreach($mobils as $mobil)
                                          @if($mobil->id == $historymobil2->mobil_id)
                                            <td>{{$mobil->MerekMobil}} {{$mobil->Type}}2</td>
                                            <td>{{$mobil->Tahun}}</td>
                                          @endif
                                        @endforeach
                                        <td>@currency($historymobil2->Hargasewamobil)</td>
                                        @break
                                      @else
                                        <?php $j++; ?>
                                      @endif
                                    @endforeach


                                    @foreach($mobils as $mobil)
                                      @if($mobil->id == $historymobil->mobil_id)
                                        <td>{{$mobil->MerekMobil}} {{$mobil->Type}}1</td>
                                        <td>{{$mobil->Tahun}}</td>
                                      @endif
                                    @endforeach
                                    <td>@currency($historymobil->Hargasewamobil)</td>

                                    

                                    <td>{{ date('d-M-Y', strtotime($historymobil->tgl_update))}} </td>
                                    <td>{{ date('d-M-Y', strtotime($historymobil->tgl_efektif))}}</td>
                                  </tr>
                                  <?php $i++; ?>
                                  @endif
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