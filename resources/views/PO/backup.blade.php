<td>
                                  @if($po->Sewa_sementara != 'Driver')
                                  <a href="/backend/po/service/{{$po->id}}" class="btn btn-sm btn-dark"><i class="ni ni-settings"></i>&nbsp Detail Service</a>
                                  @else
                                    -
                                  @endif
                                </td>

                                <td>
                                  @if($po->Sewa_sementara != 'Driver')
                                  <a href="/backend/po/salon/{{$po->id}}" class="btn btn-sm btn-dark"><i class="ni ni-settings"></i>&nbsp Detail Salon </a>
                                  @else
                                    -
                                  @endif
                                </td>

                                <td>
                                  @if($po->Sewa_sementara != 'Mobil')
                                    <a href="/backend/po/mcu/{{$po->id}}" class="btn btn-sm btn-dark"><i class="ni ni-settings"></i>&nbsp Detail MCU </a>
                                  @else
                                    -
                                  @endif
                                </td>

                              

                                <!-- <form action="/backend/po/service/add/{{ $po->id }}" method="post">
                                {{ csrf_field() }}
                                  <td>
                                    <input type="hidden" name="po_id" value="{{$po->id}}">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp service  </button>
                                  </td>
                                  <td>
                                    <input type="hidden" name="po_id" value="{{$po->id}}">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp MCU </button>
                                  </td>
                                </form>
 -->
                              


                              <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#relokasi"><i class="fas fa-clock"></i>&nbsp History Relokasi</a>
                              </td>
                              <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pengurangan"><i class="fas fa-clock"></i>&nbsp History Sewa</a>
                              </td>
                              <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#type"><i class="fas fa-clock"></i>&nbsp History Mobil</a>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#nopol"><i class="fas fa-clock"></i>&nbsp History Nopol</a>
                              </td>

                              <td>

                                    @if($po->Sewa_sementara != 'Mobil')
                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#history_driver"><i class="fas fa-user-tie"></i>&nbsp History Driver</a>
                                    @else
                                      -
                                    @endif
                                  
                              </td>
                              <td>
                                <a href="#" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#cabang"><i class="fas fa-building"></i>&nbsp Detail Cabang</a>
                              </td> 