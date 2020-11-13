

                <div class="table-responsive table-hover mb-5">
                  <table id="myTable" class="table  align-items-center table-flush text-center mydatatable">
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
                        <th scope="col" class="bg-info text-white"><b>Mulai Sewa</b></th>
                        <th scope="col" class="bg-info text-white"><b>Selesai Sewa</b></th>
<!--                         <th scope="col"><b>Mulai Sewa</b></th>
                        <th scope="col"><b>Tgl Bastk</b></th>
                        <th scope="col"><b>Tgl Bastd</b></th>
                        <th scope="col"><b>Tgl Relokasi</b></th>
                        <th scope="col"><b>Tgl Cut Off</b></th>
                        <th scope="col"><b>Selesai Sewa</b></th>
                        <th scope="col"><b>Harga Sewa Mobil(Rp)</b></th>
                        <th scope="col"><b>Harga Sewa Driver 2019(Rp)</b></th>
                        <th scope="col"><b>Harga Sewa Mobil + Driver(Rp)</b></th>
                        <th scope="col"><b>No Register</b></th> -->
                        <th scope="col"><b>Status</b></th>
                        <th scope="col"><b>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                      $i = 1;
                      $currentDateTime = date('Y-m-d H:i:s');
                    ?>
                    @foreach($pos as $po)
                    @if($po->status == 0)
                    <tr role="row" class="odd">
                      <td>{{$i}}</td>

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
                                {{$vendor->NamaVendor}}
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
                              <td> - </td>
                              <td> - </td>
                            @else
                              @foreach($drivers as $driver)
                                @if($po->Driver_id == $driver->id)
                                  <td>{{$driver->NamaDriver}}</td>
                                  <td>{{$driver->nip}}</td> 
                                @endif
                              @endforeach
                            @endif
                     
                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>{{$po->MulaiSewa->format('d-M-Y')}}</td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>{{$po->SelesaiSewa->format('d-M-Y')}}</td>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <td>
                            @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '')
                              @if($po->Sewa_sementara == 'null')
                                <span class="badge badge-sm badge-danger">Not Active</span>
                              @else
                                <span class="badge badge-sm badge-success">Active</span>
                              @endif
                            @else
                              <span class="badge badge-sm badge-success">Active</span>
                            @endif
                          </td>

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