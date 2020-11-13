

 
                    <div class="">
                      <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable" style="width: 100%">
                        <thead class="thead-light" style="height: 70px">
                          <tr>
                            <th scope="col" rowspan="2"><b>No</b></th>
                            <th scope="col" rowspan="2"><b>No PO</b></th>
                            <th scope="col" rowspan="2"><b>Jenis Sewa</b></th>
                            <th scope="col" rowspan="2"><b>CP/D</b></th>
                            <th scope="col" rowspan="2"><b>Merek & Type</b></th>
                            <th scope="col" rowspan="2"><b>Nopol</b></th>
                            <th scope="col" rowspan="2"><b>Vendor</b></th>
                            <th scope="col" colspan="3" class="bg-info text-white"><b>Cabang Baru</b></th>        
                            <th scope="col" rowspan="2" class="bg-dark text-white"><b>No.PO relokasi</b></th>     
                            @if(auth::user()->status == 'pengada')   
                            <th scope="col" rowspan="2"><b>Edit</b></th>
                            <th scope="col" rowspan="2"><b>Approve</b></th>
                            @endif
                            @if(auth::user()->status == 'blk')   
                            <th scope="col" rowspan="2"><b>Edit</b></th>
                            @endif
                            <th scope="col" rowspan="2" style="min-width: 100%"><b>Action</b></th>
                          </tr>
                          <tr>                            
                            <th scope="col" class="bg-info text-white"><b>Cabang</b></th>
                            <th scope="col" class="bg-info text-white"><b>Kota</b></th>
                            <th scope="col" class="bg-info text-white"><b>Efektif</b></th>
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
                                <th><input type="text" class="form-control form-control-sm" placeholder="Cabang" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="Kota" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="Efektif" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="PO relokasi" style="min-width:100px" /></th>
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
                          @foreach($table_template_relokasis as $table_template_relokasi) 
                            @if($po->id == $table_template_relokasi->po_id)
                              @foreach($template_relokasis as $template_relokasi)
                                @if($template_relokasi->id == $table_template_relokasi->template_id)
                                  <?php $status_approve = $template_relokasi->status ?>
                                  <?php $id_approve = $template_relokasi->id ?>
                                @endif
                              @endforeach
                            @endif
                          @endforeach

                          @if($po->status == 1 && $po->SelesaiSewa >= $currentDateTime )

                          @if(($status_approve == '' && $id_approve != '') || ($status_approve == '1' && $po->Efisien_relokasi != '' && $po->Efisien_relokasi >= $currentDateTime))
                          <tr role="row" class="odd "> 
                            <td>{{$i}}{{$id_approve}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>{{$po->Nopo_permanent}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                    @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                                      {{$po->Sewa_sementara}}
                                    @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara == 'null')
                                      {{$po->Sewa}} (Cutoff)
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


                            
                            
                            @if($po->Cabang_relokasi == '')
                                <td>-</td>
                                <td>-</td>
                            @else
                                  
                                  @foreach($cabangs as $cabang)
                                
                                    @if($po->Cabang_relokasi == $cabang->id)
                                    <td>{{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}</td>
                                    <td>{{$cabang->Kota}}</td>
                                    @endif
                                
                                  @endforeach
                                  
                            @endif
                            <td>
                              @if($po->Efisien_relokasi == '')
                                -
                              @else
                                {{$po->Efisien_relokasi->format('d-M-Y')}}
                              @endif
                            </td>

                            <td>{{$po->Nopo_relokasi}}</td>

                            @if(auth::user()->status == 'pengada')
                            <td>
                              @foreach($table_template_relokasis as $table_template_relokasi) 
                                @if($po->id == $table_template_relokasi->po_id)
                                      @if($table_template_relokasi->tgl_efektif >= $currentDate)
                                        @if($table_template_relokasi->template->status != '1')
                                          <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_relokasi/'.$table_template_relokasi->template->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-pencil-alt" >
                                              </i> Edit
                                          </a>

                                          <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_relokasi/'.$po->id.'/'.$table_template_relokasi->template->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-times" >
                                              </i> Batalkan
                                          </a>
                                        @else
                                          <a class="btn btn-danger btn-sm" href="{{url('/backend/po/relokasi/pembatalan/'.$po->id.'/'.$table_template_relokasi->template->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-file-upload" >
                                              </i> &nbspPembatalan
                                          </a>
                                        @endif
                                      @elseif($table_template_relokasi->tgl_efektif <= $currentDate)
                                        @if($table_template_relokasi->template->status != '1')
                                          <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_relokasi/'.$table_template_relokasi->template->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-pencil-alt" >
                                              </i> Edit
                                          </a>

                                          <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_relokasi/'.$po->id.'/'.$table_template_relokasi->template->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-times" >
                                              </i> Batalkan
                                          </a>
                                        @endif
                                      @endif
                                @endif
                              @endforeach
                            </td>

                            <td>
                              @foreach($table_template_relokasis as $table_template_relokasi) 
                                @if($po->id == $table_template_relokasi->po_id)
                                      @if($table_template_relokasi->tgl_efektif >= $currentDate)
                                        @if($table_template_relokasi->template->status != '1')
                                          <a class="btn btn-info btn-sm" href="{{url('/backend/po/relokasi/approve/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-file-upload" >
                                              </i> &nbspApprove
                                          </a>
                                        @else
                                          <span><b>Approved</b></span>
                                          
                                        @endif
                                      @elseif($table_template_relokasi->tgl_efektif <= $currentDate)
                                        @if($table_template_relokasi->template->status != '1')
                                          <a class="btn btn-info btn-sm" href="{{url('/backend/po/relokasi/approve/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-file-upload" >
                                              </i> &nbspApprove
                                          </a>                                         
                                        @endif
                                      @endif
                                @endif
                              @endforeach
                            </td>
                            @endif

                            @if(auth::user()->status == 'blk') 

                            <td>
                              @foreach($table_template_relokasis as $table_template_relokasi) 
                                @if($po->id == $table_template_relokasi->po_id)
                                      @if($table_template_relokasi->tgl_efektif >= $currentDate)
                                        @if($table_template_relokasi->template->status != '1')
                                          <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_relokasi/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-pencil-alt" >
                                              </i> Edit
                                          </a>

                                          <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_relokasi/'.$po->id.'/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}" >
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
                                      @elseif($table_template_relokasi->tgl_efektif <= $currentDate)
                                        @if($table_template_relokasi->template->status != '1')
                                          <a class="btn btn-success btn-sm" href="{{url('/backend/po/update/edit_relokasi/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-pencil-alt" >
                                              </i> Edit
                                          </a>

                                          <a class="btn btn-danger btn-sm" href="{{url('/backend/po/delete/edit_relokasi/'.$po->id.'/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}" >
                                              <i class="fas fa-times" >
                                              </i> Batalkan
                                          </a>
                                        @endif
                                      @endif
                                @endif
                              @endforeach
                            </td>
                            
                            @endif
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

                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endif
                          @endforeach
                           
                        </tbody>
                      </table>
                    </div>
                