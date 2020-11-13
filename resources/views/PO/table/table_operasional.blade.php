<form action="{{url('/backend/po/status_multiple')}}" method="post" role="form">
  {{ csrf_field() }}
<div class="">
<table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable">
  <thead class="thead-light" style="height: 70px">
    <tr>
      <th scope="col"><b>No</b></th>
      <th scope="col"><b>No PO</b></th>
      <th scope="col"><b>Jenis Sewa</b></th>
      <th scope="col"><b>CP/D</b></th>
      <th scope="col"><b>Vendor</b></th>
      <th scope="col"><b>Type/unit</b></th>
      <th scope="col"><b>No.pol</b></th>
      <th scope="col"><b>Cabang</b></th>
      <th scope="col"><b>Kota</b></th>
      <th scope="col"><b>Mulai Sewa</b></th>
      <th scope="col"><b>Tgl Bastk</b></th>
      <th scope="col"><b>Tgl Bastd</b></th>
      <th scope="col"><b>Selesai Sewa</b></th>
      <th scope="col"><b>Harga Sewa Mobil</b></th>
      <th scope="col"><b>Harga Sewa Driver</b></th>
      <th scope="col"><b>Total Harga</b></th>
      <th scope="col"><b>No Register</b></th>
      <th scope="col"><b>User pengguna</b></th>
      <th scope="col"><b>Completing</th>
      <th scope="col"><b>Status</b></th>
      <th scope="col" style="min-width: 100%">
        <button class="btn btn-icon btn-sm btn-success mr-2" type="submit">
          <span class="btn-inner--icon"><i class="fas fa-paper-plane"></i> Send to database</span>
        </button>
      </th>
      <!-- <th scope="col"><b>Action</b></th> -->
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
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
          <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
          <th>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input checkAll" id="checkAll">
              <label class="custom-control-label" for="checkAll"></label>
            </div>
          </th>
      </tr>
  </thead>
  <tbody>
     <?php 
    $i = 1;
  ?>
  @foreach($pos as $po)
  @if($po->status == 0 || $po->status == 2)
  <tr role="row" class="odd ">
    <td>{{$i}}</td>
    <td>{{$po->Nopo_permanent}}</td>
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
          {{$vendor->KodeVendor}}
        @endif
      @endforeach
    </td>
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

    @if($po->Nopol == '')
      <td class="bg-warning">
    @elseif($po->Nopol == 'null')
      <td class="bg-success text-white">
    @else
      <td>
    @endif
    <!-- <a href="#" class="tglpo" 
      data-name="nopol" 
      data-type="text" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/update/{{$po->id}}" 
      data-title="Masukkan No.pol" > -->
    <span style="<?php if($po->Nopol == '') echo "color:white";  ?>"> 
      @if($po->Nopol == '')
        Empty
      @else
        {{$po->Nopol}}
      @endif
     </span>
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
    <td><!-- <a href="#" class="po_tgl" 
      data-name="mulaisewa" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal Mulai Sewa" > -->
      {{$po->MulaiSewa->format('d-M-Y')}}</a>
    </td>

    @if($po->Sewa == 'Driver')
        <td class="bg-success text-white">
          Null
        </td>
    @else

      @if($po->Tgl_bastk == '')
        <td class="bg-warning">
      @else
        <td>
      @endif
        <span style="<?php if($po->Tgl_bastk == '') echo "color:white";  ?>"> 
        @if($po->Tgl_bastk == '')
          Empty
        @else
          {{$po->Tgl_bastk}}
        @endif
       </span>
      </td>

    @endif

    @if($po->Sewa == 'Mobil')
        <td class="bg-success text-white">
          Null
        </td>
    @else

        @if($po->Tgl_bastd == '')
          <td >
        @else
          <td>
        @endif
          <span style="<?php if($po->Tgl_bastd == '') echo "color:red";  ?>"> 
          @if($po->Tgl_bastd == '')
            Empty
          @else
          {{$po->Tgl_bastd}}
          @endif
         </span>
        </td>

    @endif
    <td><!-- <a href="#" class="po_tgl" 
      data-name="selesaisewa" 
      data-type="date" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan tanggal selesai sewa" > -->
      {{$po->SelesaiSewa->format('d-M-Y')}}</a>
    </td>
    <td><!-- <a href="#" class="tglpo" 
      data-name="hargasewamobil" 
      data-type="number" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan Nominal Harga sewa mobil" > -->
      @currency($po->HargaSewaMobil)</a>
    </td>
    <td><!-- <a href="#" class="tglpo" 
      data-name="hargasewadriver2019" 
      data-type="number" 
      data-pk="{{$po->id}}" 
      data-url="/api/backend/po/tgl/update/{{$po->id}}" 
      data-title="Masukkan Nominal Harga sewa mobil" > -->
      @currency($po->HargaSewaDriver2019)</a>
    </td>

    <td>
      <?php $hsmd = $po->HargaSewaDriver2019 + $po->HargaSewaMobil ?>
      @currency($hsmd)</a>
    </td>




    @if($po->NoRegister == '')
      <td class="bg-warning text-white">Empty</td>
    @else
      <td>{{$po->NoRegister}}</td>
    @endif

    @if($po->UserPengguna == '')
      <td>Empty</td>
    @else
      <td>{{$po->UserPengguna}}</td>
    @endif


    <td>

      
        <a class="btn btn-info btn-sm" href="{{url('/backend/po/completing/'.$po->id)}}">
            <i class="fas fa-check">
            </i>
            Completing
        </a>
    </td>


    <td>
      @if($po->status == 0 & $po->Sewa == 'Mobil' & isset($po->Nopol,$po->Tgl_bastk,$po->NoRegister))
          <span class="badge badge-success">complete</span>
      @elseif($po->status == 0 & $po->Sewa == 'Driver' & isset($po->Nopol,$po->NoRegister))
          <span class="badge badge-success">complete</span>
      @elseif($po->status == 0 & $po->Sewa == 'Mobil+Driver' & isset($po->Nopol,$po->Tgl_bastk,$po->NoRegister))
          <span class="badge badge-success">complete</span>

      @elseif($po->status == 1)
        <span class="badge badge-success">complete</span>
      @elseif($po->status == 2)
        <span class="badge badge-success">complete</span>
      @else
        <span class="badge badge-primary">Not Complete</span>
      @endif
    </td>

    <td>
     
          @if($po->status != 1 & $po->Sewa == 'Mobil' & isset($po->Nopol,$po->Tgl_bastk,$po->NoRegister))      
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="status[]" id="customCheck{{$i}}" value="{{$po->id}}">
              <label class="custom-control-label" for="customCheck{{$i}}"></label>
            </div>
          @elseif($po->status != 1 & $po->Sewa == 'Driver' & isset($po->Nopol,$po->NoRegister))      
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="status[]" id="customCheck{{$i}}" value="{{$po->id}}">
              <label class="custom-control-label" for="customCheck{{$i}}"></label>
            </div>
          @elseif($po->status != 1 & $po->Sewa == 'Mobil+Driver' & isset($po->Nopol,$po->Tgl_bastk,$po->NoRegister))
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="status[]" id="customCheck{{$i}}" value="{{$po->id}}">
              <label class="custom-control-label" for="customCheck{{$i}}"></label>
            </div>
          @endif
      
      
      
    </td>

    <!-- <td>
      <a href="/backend/po/delete/{{$po->id}}" class="btn btn-sm btn-warning"><i class="fas fa-times"></i>&nbsp Delete PO</a>
    </td> -->

    <?php $i++; ?>
  </tr>
  @endif
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-danger">
                Apakah anda yakin ingin menghapus data {{$page}} ini. Jika data sudah dihapus tidak dapat dikembalikan lagi.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="{{url('/backend/po/delete/'.$po->id)}}">
                    <i class="fas fa-trash"></i> &nbspDelete PO
                </a>
              </div>
            </div>
          </div>
        </div>
  @endforeach
  </tbody>
</table>
</div>
</form>













<script type="text/javascript">
  $(document).ready(function(){
    $('.check').click(function() {
      location.reload();
    });
  });
</script>
