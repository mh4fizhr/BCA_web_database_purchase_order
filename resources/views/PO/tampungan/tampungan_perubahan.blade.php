<section class="content">
        <div class="row">
          <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <?php $count_of_po = App\tampungan_perubahan::all()->count(); ?>
              <div class="row">
                  <div class="col-6">
                    <p class="mb-0 text-bold d-inline-block" style="font-size: 25px"> &nbsp<b class="text-danger"><b>{{$count_of_po}}</b></b> PO telah dipilih </p>
                  </div>
                  <div class="col-6 text-right">
                    @if($count_of_po == 0)
                      <a href="{{url('/backend/po/form_perubahan_button')}}" class="btn btn-primary btn-round btn-icon disabled">
                        <span class="btn-inner--text">perubahan</span>
                      </a>
                    @else
                      <a href="{{url('/backend/po/form_perubahan_button')}}" class="btn btn-primary btn-round btn-icon">
                        <span class="btn-inner--text">perubahan</span>
                      </a>
                    @endif
                  </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              @if($count_of_po != 0)
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col"><b>No</b></th>
                      <th scope="col"><b>ID</b></th>
                      <th scope="col"><b>No PO</b></th>
                      <th scope="col"><b>Jenis Sewa</b></th>
                      <th scope="col"><b>Kode cabang</b></th>
                      <th scope="col"><b>Nama Cabang</b></th>
                      <th scope="col"><b>Kota</b></th>
                      <th scope="col"><b>Nopol</b></th>
                      <th scope="col"><b>Vendor</b></th>
                      <th scope="col"><b>Action</b></th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <?php $i = 1; ?>
                    @foreach($tp_perubahans as $tp_perubahan)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$tp_perubahan->po_id}}</td>
                        <td>{{$tp_perubahan->po->NoPo}}</td>
                        <td>{{$tp_perubahan->po->Sewa_sementara}}</td>
                        <td>{{$tp_perubahan->po->cabang->KodeCabang}}</td>
                        <td>{{$tp_perubahan->po->cabang->NamaCabang}}</td>
                        <td>{{$tp_perubahan->po->cabang->Kota}}</td>
                        <td>{{$tp_perubahan->po->Nopol}}</td>
                        <td>{{$tp_perubahan->po->vendor->KodeVendor}}</td>
                        <td><a class="btn btn-danger btn-sm" href="{{url('/backend/po/perubahan/tampungan/delete/'.$tp_perubahan->id)}}"><i class="fas fa-times"></i> &nbspDelete</a></td>
                      </tr>
                      <?php $i++; ?>
                    @endforeach
                    <tr>
                      
                    </tr>
                  </tbody>
                </table>
              @endif
            </div>
            <!-- Card footer -->

          </div>
        </div>
        </div>
      </section>