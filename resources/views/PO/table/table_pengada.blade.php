<form action="{{url('/backend/po/pengada/status_multiple')}}" method="post" role="form">
  {{ csrf_field() }}
<div class="">
  <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable">
    <thead class="thead-light" style="height: 70px">
      <tr class="text-left">
        <th scope="col" class="text-center"><b>No</b></th>
        <th scope="col"><b>No PO</b></th>
        <th scope="col"><b>Jenis Sewa</b></th>
        <th scope="col"><b>Nopol</b></th>
        <th scope="col"><b>CP/D</b></th>
        <th scope="col"><b>Vendor</b></th>
        <th scope="col"><b>Cabang</b></th>
        <th scope="col"><b>Kota</b></th>
        <th scope="col"><b>Mulai Sewa</b></th>                       
        <th scope="col"><b>Selesai Sewa</b></th>
        <th scope="col"><b>Harga Sewa Mobil</b></th>
        <th scope="col"><b>Harga Sewa Driver</b></th>
        <th scope="col"><b>Total Harga</b></th>
        <th scope="col" class="text-center"><b>Status</b></th>
        <th scope="col" class="text-center"><b>Action</b></th>
        @if(auth::user()->status != 'blk')
        <th scope="col" style="min-width: 100%">
          <button class="btn btn-icon btn-sm btn-success mr-2" type="submit">
            <span class="btn-inner--icon"><i class="fas fa-paper-plane"></i> &nbsp Send to BOP</span>
          </button>
        </th>
        @endif
      </tr>
    </thead>
    <thead>
        <tr>
            <th><input type="text" class="form-control form-control-sm" placeholder="No" style="min-width:50px" /></td>
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
            @if(auth::user()->status != 'blk')
            <th>
              @include('button_delete.index')
            </th>
            @endif
        </tr>
    </thead>
    <tbody>
       <?php 
      $i = 1;
    ?>
    @foreach($pos as $po)
        @if($po->status == '5' || $po->status == '0')
    <tr role="row" class="odd text-left">
      <td class="text-center">{{$i}}</td>
      <td>{{$po->Nopo_permanent}}</td>
    <!-- <td>
      @foreach($nopos as $nopo)
        @if($po->NoPo == $nopo->id)
          {{$nopo->NoPo}}
        @endif
      @endforeach
    </td> -->
      <td>{{$po->Sewa}}</td>
      <td>

        @if($po->Nopol == 'null')
          -
        @elseif($po->Nopol == '')
          -
        @else
          {{$po->Nopol}}
        @endif
      
      </td>
      <td>{{$po->CP}}</td>
      <td>
        @foreach($vendors as $vendor)
          @if($po->Vendor_Driver == $vendor->id)
            {{$vendor->KodeVendor}}
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
      <td><!-- <a href="#" class="po_tgl" 
        data-name="mulaisewa" 
        data-type="date" 
        data-pk="{{$po->id}}" 
        data-url="/api/backend/po/tgl/update/{{$po->id}}" 
        data-title="Masukkan tanggal Mulai Sewa" >
        {{$po->MulaiSewa->format('d-M-Y')}}</a> -->
        {{$po->MulaiSewa->format('d-M-Y')}}
      </td>
      <td><!-- <a href="#" class="po_tgl" 
        data-name="selesaisewa" 
        data-type="date" 
        data-pk="{{$po->id}}" 
        data-url="/api/backend/po/tgl/update/{{$po->id}}" 
        data-title="Masukkan tanggal selesai sewa" >
        {{$po->SelesaiSewa->format('d-M-Y')}}</a> -->
        {{$po->SelesaiSewa->format('d-M-Y')}}
      </td>
      <td><!-- <a href="#" class="tglpo" 
        data-name="hargasewamobil" 
        data-type="number" 
        data-pk="{{$po->id}}" 
        data-url="/api/backend/po/tgl/update/{{$po->id}}" 
        data-title="Masukkan Nominal Harga sewa mobil" >
        @currency($po->HargaSewaMobil)</a> -->
        @currency($po->HargaSewaMobil)
      </td>
      <td><!-- <a href="#" class="tglpo" 
        data-name="hargasewadriver2019" 
        data-type="number" 
        data-pk="{{$po->id}}" 
        data-url="/api/backend/po/tgl/update/{{$po->id}}" 
        data-title="Masukkan Nominal Harga sewa mobil" >
        @currency($po->HargaSewaDriver2019)</a> -->
        @currency($po->HargaSewaDriver2019)
      </td>

      <td>
        <?php $hsmd = $po->HargaSewaDriver2019 + $po->HargaSewaMobil ?>
        @currency($hsmd)</a>
      </td>
      <td class="text-center">
        @if($po->status == 0)
        <span class="badge badge-warning">on process</span>
        @elseif($po->status == 5)
        <span class="badge badge-primary">need action</span>
        @else
        <span class="badge badge-success">complete</span>
        @endif
      </td>
      <td class="text-center">
        @if($po->status == 5 && $po->NoRegister != '')
        <a class="btn btn-success btn-sm" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
            <i class="fas fa-pencil-alt" >
            </i> Edit
        </a>
        <a href="{{url('/backend/po/delete/driver_eksisting/'.$po->id)}}" class="btn btn-sm btn-warning" ><i class="fas fa-trash"></i> Batalkan</a>
        @elseif($po->status == 5)
        <a class="btn btn-success btn-sm" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
            <i class="fas fa-pencil-alt" >
            </i> Edit
        </a>
        <a href="{{url('/backend/po/delete/'.$po->id)}}" class="btn btn-sm btn-warning" ><i class="fas fa-trash"></i> Batalkan</a>
        @else
        <a class="btn btn-success btn-sm disabled" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
            <i class="fas fa-pencil-alt" >
            </i> Edit
        </a>
        <a href="{{url('/backend/po/delete/'.$po->id)}}" class="btn btn-sm btn-warning disabled" ><i class="fas fa-trash"></i> Batalkan</a>
        @endif
      </td>
      @if(auth::user()->status != 'blk')
      <td class="text-center">
        @if($po->status == 5)
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$po->id}}">
          <label class="custom-control-label" for="customCheck{{$i}}"></label>
        </div>
        @endif
      </td>
      @endif

      <?php $i++; ?>
    </tr>
    @endif
    @endforeach
    </tbody>
  </table>
  <?php $i = 1; ?>
  @foreach(App\tpo::all()->sortBy('id') as $po)
      @if($po->status == '5' || $po->status == '0')
        <div class="delete_checkbox{{$po->id}}"></div> 
        <?php $i = $po->id; ?>                    
      @endif
  @endforeach
</div>
</form>
























