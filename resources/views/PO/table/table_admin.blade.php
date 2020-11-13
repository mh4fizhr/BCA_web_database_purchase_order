<table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
  <thead class="thead-light">
    <tr>
      <th scope="col"><b>No</b></th>
      <th scope="col"><b>No PO</b></th>
      <th scope="col"><b>Jenis Sewa</b></th>
      <th scope="col"><b>CP/D</b></th>
      <th scope="col"><b>Vendor</b></th>
      <th scope="col"><b>Cabang</b></th>
      <th scope="col"><b>Kota</b></th>
      <th scope="col"><b>Mulai Sewa</b></th>
      <th scope="col"><b>Tgl Bastk</b></th>
      <th scope="col"><b>Tgl Bastd</b></th>
      <th scope="col"><b>Tgl Cut Off</b></th>
      <th scope="col"><b>Selesai Sewa</b></th>
      <th scope="col"><b>Harga Sewa Mobil(Rp)</b></th>
      <th scope="col"><b>Harga Sewa Driver 2019(Rp)</b></th>
      <th scope="col"><b>Harga Sewa Mobil + Driver(Rp)</b></th>
      <th scope="col"><b>Status</b></th>
      <th scope="col"><b>Action</th>
    </tr>
  </thead>
  <tbody>
     <?php 
    $i = 1;
  ?>
  @foreach($pos as $po)
  <tr role="row" class="odd ">
    <td>{{$i}}</td>
    <td>{{$po->NoPo}}</td>
    <!-- <td>
      @foreach($nopos as $nopo)
        @if($po->NoPo == $nopo->id)
          {{$nopo->NoPo}}
        @endif
      @endforeach
    </td> -->
    <td>{{$po->Sewa}}</td>
    <td>{{$po->CP}}</td>
    <td>
      @foreach($vendors as $vendor)
        @if($po->Vendor_Driver == $vendor->id)
          {{$vendor->NamaVendor}}
        @endif
      @endforeach
    </td>
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
    <td><a href="#" class="po_tgl" 
      data-name="mulaisewa" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal Mulai Sewa" style="color: black">
      {{$po->MulaiSewa->format('d-M-Y')}}</a>
    </td>
    <td><a href="#" class="po_tgl" 
      data-name="tgl_bastk" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal bastk" style="color: black">
      {{$po->Tgl_bastk}}</a>
    </td>
    <td><a href="#" class="po_tgl" 
      data-name="tgl_bastd" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal bastd" style="color: black">
      {{$po->Tgl_bastd}}</a>
    </td>
    <td><a href="#" class="po_tgl" 
      data-name="tgl_cutoff" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal Cut Off" style="color: black">
      {{$po->Tgl_cutoff}}</a>
    </td>
    <td><a href="#" class="po_tgl" 
      data-name="selesaisewa" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal selesai sewa" style="color: black">
      {{$po->SelesaiSewa->format('d-M-Y')}}</a>
    </td>
    <td><a href="#" class="tglpo" 
      data-name="hargasewamobil" 
      data-type="number" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan Nominal Harga sewa mobil" style="color: black">
      @currency($po->HargaSewaMobil)</a>
    </td>
    <td><a href="#" class="tglpo" 
      data-name="hargasewadriver2019" 
      data-type="number" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan Nominal Harga sewa mobil" style="color: black">
      @currency($po->HargaSewaDriver2019)</a>
    </td>
    <td>
      <?php $hsmd = $po->HargaSewaDriver2019 + $po->HargaSewaMobil ?>
      @currency($hsmd)</a>
    </td>
    <td>
      @if($po->Status == 0)
      <span class="badge badge-danger">On Process</span>
      @else
      <span class="badge badge-success">complete</span>
      @endif
    </td>

    <td><a class="btn btn-warning btn-sm" href="/backend/po/show/{{ $po->id }}">
                    <i class="fas fa-folder">
                    </i>
                    Lihat detail
                </a></td>
    <?php $i++; ?>
  </tr>
  @endforeach
  </tbody>
</table>