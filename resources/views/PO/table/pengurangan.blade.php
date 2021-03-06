

                <div class="table-hover">
                  <table id="myTable" class="table table-responsive align-items-center table-flush text-center mydatatable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col"><b>No</b></th>
                        <th scope="col"><b>No PO</b></th>
                        <th scope="col"><b>Jenis Sewa</b></th>
                        <th scope="col"><b>CP/D</b></th>
                        <th scope="col"><b>Merek & Type</b></th>
                        <th scope="col"><b>Nopol</b></th>
                        <th scope="col"><b>Vendor</b></th>
                        <th scope="col"><b>Cabang</b></th>
                        <th scope="col"><b>Kota</b></th>
                        <th scope="col"><b>Nama Driver</b></th>
                        <th scope="col"><b>NIP</b></th>
                        <th scope="col" class="bg-danger text-white"><b>Pengurangan</b></th>
                        <th scope="col" class="bg-danger text-white"><b>Cut Off</b></th>
                        <th scope="col" class="bg-dark text-white"><b>No.PO pengurangan</b></th>
                        @if(auth::user()->status == 'pengada')
                        <th scope="col"><b>Edit</b></th>
                        <th scope="col"><b>Approve</b></th>
                        @endif
                        @if(auth::user()->status == 'blk')
                        <th scope="col"><b>Edit</b></th>
                        @endif
                        <th scope="col" style="min-width: 100%"><b>Action</th>
                      </tr>
                    </thead>
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @if(auth::user()->status == 'pengada')
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                            @endif
                            @if(auth::user()->status == 'blk')
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                            @endif
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                      $i = 1;
                      date_default_timezone_set('Asia/Jakarta');
                      $currentDateTime = date('Y-m-d H:i:s');
                      $currentDate = date('m/d/Y');
                      
                    ?>
                    @foreach($pos as $po)
                    <?php $status_approve = ''; ?>
                    <?php $id_approve = ''; ?> 
                    @foreach($table_template_pengurangans as $table_template_pengurangan) 
                      @if($po->id == $table_template_pengurangan->po_id)
                        @foreach($template_pengurangans as $template_pengurangan)
                          @if($template_pengurangan->id == $table_template_pengurangan->template_id)
                            <?php $status_approve = $template_pengurangan->status ?>
                            <?php $id_approve = $template_pengurangan->id ?>
                          @endif
                        @endforeach
                      @endif
                    @endforeach

                    @if($po->status == 1  &&  $po->Sewa_sementara == 'null')

                    @if(($status_approve == '' && $id_approve != '') || ($status_approve == '1' && $po->Tgl_cutoff != '' && $po->Tgl_cutoff >= $currentDateTime))
                    <tr role="row" class="odd">
                      <td>{{$i}}</td>

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>{{$po->Nopo_permanent}}</td>

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                                    @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                                      {{$po->Sewa_sementara}}
                                    @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara == 'null')
                                      {{$po->Sewa}} 
                                    @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara == 'null')
                                    @else
                                      {{$po->Sewa}}
                                    @endif
                                </td>
                          

                       <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->   
                          
                          <td>{{$po->CP}}</td>

                       <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>

                            @if($po->Mobil_id == 'null')
                              Tanpa Unit
                            @elseif($po->Mobil_id == '')
                              Tanpa Unit
                            @else
                              @foreach($mobils as $mobil)
                                @if($po->Mobil_id == $mobil->id)
                                  {{$mobil->MerekMobil}} {{$mobil->Type}} 
                                @endif
                              @endforeach
                            @endif

                            
                          </td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>

                            @if($po->Nopol == 'null')
                              Tanpa Unit
                            @elseif($po->Nopol == '')
                              Tanpa Unit
                            @else
                              {{$po->Nopol}}
                            @endif
 
                          </td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                            @foreach($vendors as $vendor)
                              @if($po->Vendor_Driver == $vendor->id)
                                {{$vendor->KodeVendor}}
                              @endif
                            @endforeach
                          </td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          @if(empty($po->Cabang_relokasi))

                            <td>
                              @foreach($cabangs as$cabang)
                                @if($po->Cabang_id == $cabang->id)
                                  {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                @endif
                              @endforeach
                            </td>
                            <td> 
                              @foreach($cabangs as$cabang)
                                @if($po->Cabang_id == $cabang->id)
                                  {{$cabang->Kota}}
                                @endif
                              @endforeach
                            </td>

                          @else

                            @if($po->Efisien_relokasi <= $currentDateTime)

                              <td>
                                @foreach($cabangs as $cabang)
                                  @if($po->Cabang_relokasi == $cabang->id)
                                    {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                  @endif
                                @endforeach
                              </td>
                              <td> 
                                @foreach($cabangs as $cabang)
                                  @if($po->Cabang_relokasi == $cabang->id)
                                    {{$cabang->Kota}}
                                  @endif
                                @endforeach
                              </td>

                            @else

                              <td>
                                @foreach($cabangs as$cabang)
                                  @if($po->Cabang_id == $cabang->id)
                                    {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                  @endif
                                @endforeach
                              </td>
                              <td> 
                                @foreach($cabangs as$cabang)
                                  @if($po->Cabang_id == $cabang->id)
                                    {{$cabang->Kota}}
                                  @endif
                                @endforeach
                              </td>

                              @endif
                            
                          @endif

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                            @if($po->Driver_id == '') 
                              <?php $connect = 'no' ?>
                              <?php $nopol_connect = '' ?>
                              @foreach($drivers as $driver)
                                @foreach($history_drivers as $history_driver)
                                  @if($history_driver->Driver_id == $driver->id && $history_driver->Po_id == $po->id)
                                    @if($history_driver->tgl_selesai > $currentDate)
                                      <td>{{$driver->NamaDriver}}</td>
                                      <td>{{$driver->nip}}</td> 
                                      <?php $connect = 'yes' ?>
                                      
                                    @endif
                                  @endif
                                @endforeach
                              @endforeach

                              @if($connect == 'no')
                                <td> - </td>
                                <td> - </td>
                              @endif 
                            @else
                              @foreach($drivers as $driver)
                                @if($po->Driver_id == $driver->id)
                                  <td>{{$driver->NamaDriver}}</td>
                                  <td>{{$driver->nip}}</td> 
                                @endif
                              @endforeach
                            @endif
                          
                            <!-- @if($po->Driver_id == '')
                              <td> - </td>
                              <td> - </td>
                            @else
                              @foreach($drivers as $driver)
                                @if($po->Driver_id == $driver->id)
                                  <td>{{$driver->NamaDriver}}</td>
                                  <td>{{$driver->nip}}</td> 
                                @endif
                              @endforeach
                            @endif -->
                        
                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                            @if($po->Pengurangan == '')
                              -
                            @else
                              {{$po->Pengurangan}}
                            @endif
                            
                          </td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                          @if($po->Tgl_cutoff == '')
                            -
                          @else
                            {{$po->Tgl_cutoff->format('d-M-Y')}}
                          @endif
                        </td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                            <!-- @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '')
                              @if($po->Sewa_sementara == 'null')
                                <span class="badge badge-sm badge-danger">Not Active</span>
                              @else
                                <span class="badge badge-sm badge-success">Active</span>
                              @endif
                            @else
                              <span class="badge badge-sm badge-success">Active</span>
                            @endif -->
                            {{$po->Nopo_pengurangan}}
                          </td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                        @if(auth::user()->status == 'pengada')
                        <td>
                          @foreach($table_template_pengurangans as $table_template_pengurangan) 
                            @if($po->id == $table_template_pengurangan->po_id)
                              @foreach($template_pengurangans as $template_pengurangan)
                                @if($template_pengurangan->id == $table_template_pengurangan->template_id)
                                  @if($table_template_pengurangan->tgl_efektif >= $currentDate)
                                    @if($template_pengurangan->status != '1')
                                      <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_pengurangan/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-pencil-alt" >
                                          </i> Edit
                                      </a>

                                      <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_pengurangan/'.$po->id.'/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-times" >
                                          </i> Batalkan
                                      </a>
                                    @else
                                      <a class="btn btn-danger btn-sm" href="{{url('/backend/po/pengurangan/pembatalan/'.$po->id.'/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-file-upload" >
                                          </i> &nbspPembatalan
                                      </a>
                                    @endif
                                  @elseif($table_template_pengurangan->tgl_efektif <= $currentDate)
                                    @if($template_pengurangan->status != '1')
                                      <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_pengurangan/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-pencil-alt" >
                                          </i> Edit
                                      </a>

                                      <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_pengurangan/'.$po->id.'/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-times" >
                                          </i> Batalkan
                                      </a>
                                    @endif
                                  @endif
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                        </td>

                        <td>
                          @foreach($table_template_pengurangans as $table_template_pengurangan) 
                            @if($po->id == $table_template_pengurangan->po_id)
                              @foreach($template_pengurangans as $template_pengurangan)
                                @if($template_pengurangan->id == $table_template_pengurangan->template_id)
                                  @if($table_template_pengurangan->tgl_efektif >= $currentDate)
                                    @if($template_pengurangan->status != '1')
                                      <a class="btn btn-info btn-sm" href="{{url('/backend/po/pengurangan/approve/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-file-upload" >
                                          </i> &nbspApprove
                                      </a>
                                    @else
                                      <span><b>Approved</b></span>
                                    @endif
                                  @elseif($table_template_pengurangan->tgl_efektif <= $currentDate)
                                    @if($template_pengurangan->status != '1')
                                      <a class="btn btn-info btn-sm" href="{{url('/backend/po/pengurangan/approve/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-file-upload" >
                                          </i> &nbspApprove
                                      </a>
                                    @endif
                                  @endif
                                    
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                        </td>

                        @endif

                        @if(auth::user()->status == 'blk')
                        <td>
                          @foreach($table_template_pengurangans as $table_template_pengurangan) 
                            @if($po->id == $table_template_pengurangan->po_id)
                              @foreach($template_pengurangans as $template_pengurangan)
                                @if($template_pengurangan->id == $table_template_pengurangan->template_id)
                                  @if($table_template_pengurangan->tgl_efektif >= $currentDate)
                                    @if($template_pengurangan->status != '1')
                                      <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_pengurangan/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-pencil-alt" >
                                          </i> Edit
                                      </a>

                                      <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_pengurangan/'.$po->id.'/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-times" >
                                          </i> Batalkan
                                      </a>
                                    @else
                                      <a class="btn btn-success btn-sm disabled" href="" >
                                          <i class="fas fa-pencil-alt" >
                                          </i> Edit
                                      </a>

                                      <a class="btn btn-danger btn-sm disabled" href="" >
                                          <i class="fas fa-times" >
                                          </i> Batalkan
                                      </a>
                                    @endif
                                  @elseif($table_template_pengurangan->tgl_efektif <= $currentDate)
                                    @if($template_pengurangan->status != '1')
                                      <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_pengurangan/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-pencil-alt" >
                                          </i> Edit
                                      </a>

                                      <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_pengurangan/'.$po->id.'/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}" >
                                          <i class="fas fa-times" >
                                          </i> Batalkan
                                      </a>
                                    @endif
                                  @endif
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                        </td>
                        @endif

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                              @if(auth::user()->status == 'operasional' || auth::user()->status == 'admin')

                              <!-- <a class="btn btn-info btn-sm" href="{{url('/backend/po/edit_dashboard/'.$po->id)}}" >
                                  <i class="fas fa-pencil-alt" >
                                  </i>
                                  
                              </a> -->

                              @endif
                              <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                  <i class="fas fa-folder">
                                  </i>
                                  Lihat detail
                              </a>
                          </td>

                          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <?php $i++; ?>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                    </tbody>
<!--                     <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot> -->
                  </table>
                </div>