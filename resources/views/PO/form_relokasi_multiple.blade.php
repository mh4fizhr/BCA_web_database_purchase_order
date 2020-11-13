<?php $page = "Relokasi"; ?>
@extends('sidebar')

@section('content')

<?php
function terbilang($tanggal){
  $terbilang = '';
  if ($tanggal == '1') {
    $terbilang = 'satu';
  }else if($tanggal == '2') {
    $terbilang = 'dua';
  }else if($tanggal == '3') {
    $terbilang = 'tiga';
  }else if($tanggal == '4') {
    $terbilang = 'empat';
  }else if($tanggal == '5') {
    $terbilang = 'lima';
  }else if($tanggal == '6') {
    $terbilang = 'enam';
  }else if($tanggal == '7') {
    $terbilang = 'tujuh';
  }else if($tanggal == '8') {
    $terbilang = 'delapan';
  }else if($tanggal == '9') {
    $terbilang = 'sembilan';
  }else if($tanggal == '10') {
    $terbilang = 'sepuluh';
  }

  return $terbilang;
}

setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');
    $years = date('Y');
    $vendor_nama = '' ;
    $vendor_id = '';
    $vendor_alamat = 'alamat' ;
    $vendor_pic = '' ;
    $po_sewa = '' ;
    $count_driver = 0;
    $count_mobil = 0;
    $jumlah_baris_table = 0;
?>

<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $("#mobil").show(); 
        $("#driver").hide();
        $("#sewa").change(function () {
            if ($(this).val() == "mobil") {
                $("#mobil").show();
                $("#driver").hide();
            } else if($(this).val() == "Driver") {
                $("#mobil").hide();
                $("#driver").hide();
            } else{
                $("#mobil").show();
                $("#driver").show();
            }
        });
        $("#cabang").change(function () {
            $("#harga_driver").val('0');
        });
        
    });

    $(document).ready(function(){
        var i = 1;
        $('.add').click(function(){
          i++;
          $("#tambuh").clone().appendTo( ".tempat_tambah" );
        });
    });
</script>

@foreach($errors->all() as $message)
      <div>{{ $message }}</div>
    @endforeach

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} PO</h1>
              
            </div>

            <!-- <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
          <!-- Card stats -->

        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <section class="content">
        <div class="row">
          <div class="col-12">
            

                

                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form Relokasi PO</h3>
                  </div>
                  <!-- Card body -->
                  
                  <div class="card-body p-5">
                    <p>
                      <span>No. <input class="form-control form-control-sm" type="text" id="no_surat" name="" autocomplete="off" style="width: 150px;display: inline;"> /JS/BPD/KPS/{{$years}}</span> 
                      
                      <span class="float-right">Jakarta, {{ strftime("%d %B %Y", strtotime($currentDateTime))}}</span>
                    </p>
                    <br>
                    <p>
                      Kepada,
                      <br>
                        
                        @foreach($poss as $po)
                          @foreach($vendors as $vendor)
                              @if($po->Vendor_Driver == $vendor->id)
                                <?php $vendor_kode = $vendor->KodeVendor ?>
                                <?php $vendor_nama = $vendor->NamaVendor ?>
                                <?php $vendor_alamat = $vendor->AlamatVendor ?>
                                <?php $vendor_pic = $vendor->PICvendor ?>
                                <?php $vendor_pejabat = $vendor->Pejabatvendor ?>
                                <?php $vendor_jabatan = $vendor->Jabatanvendor ?>
                                <?php $vendor_id = $vendor->id ?>

                              @endif
                          @endforeach
                        @endforeach
                        <b>{{$vendor_nama}}</b>

                      <br>

                        <b>{{$vendor_alamat}}</b>
                      
                    </p>
                    <p>
                      <b>Up. Yth. <b>{{$vendor_pejabat}}</b> – <b>{{$vendor_jabatan}}</b>
                      <!-- <input type="text" class="form-control form-control-sm" list="team_list" id="jabatan_vendor" placeholder="Jabatan" required autocomplete="off" style="width: 150px;display: inline;">
                      <datalist id="team_list">
                        @foreach($jabatans as $jabatan)
                          <option>{{$jabatan->jabatan}}</option>
                        @endforeach
                      </datalist> -->
                      </b>
                    </p>
                    <p>
                      Perihal : Relokasi Sewa 
                      @foreach($poss as $po)
                        @if($po->Sewa_sementara == 'Mobil+Driver')
                          <?php $po_sewa = 'Mobil dan Pengemudi' ?>
                          @break
                        @elseif($po->Sewa_sementara == 'Mobil')
                          <?php $po_sewa = 'Mobil' ?>
                        @elseif($po->Sewa_sementara == 'Driver')
                          <?php $po_sewa = 'Pengemudi' ?>
                        @endif
                      @endforeach
                      <b>{{$po_sewa}}</b>
                    </p>
                    <p>
                      Dengan hormat,
                    </p>

                    @include('PO.form_pks_addendum')

                    <p>

                      @foreach($poss as $po)
                        @if($po->Sewa_sementara == 'Mobil+Driver')
                          <?php $count_driver++; ?>
                          <?php $count_mobil++; ?>
                        @elseif($po->Sewa_sementara == 'Mobil')
                          <?php $count_mobil++; ?>
                        @elseif($po->Sewa_sementara == 'Driver')
                          <?php $count_driver++; ?>
                        @endif
                      @endforeach
                      

                      Menunjuk <b><span id="pks_list"></span></b>
                      <input type="hidden" class="form-control form-control-sm" list="pks_list" id="pks" placeholder="PKS / Addendum PKS" required autocomplete="off" style="width: 180px;display: inline;">
                      <!-- <datalist id="pks_list">
                        @foreach($pkss as $pks)
                          @if($pks->active != '1')
                          <option>{{$pks->nama_kontrak_pks}}</option>
                          @endif
                        @endforeach
                      </datalist> -->
                      <!-- <datalist id="pks">
                        @foreach($jabatans as $jabatan)
                          <option>{{$jabatan->jabatan}}</option>
                        @endforeach
                      </datalist> -->
                      No. <b><span id="no_pks_list"></span></b>
                      <input type="hidden" class="form-control form-control-sm" list="no_pks_list" id="no_pks" placeholder="nomor PKS / Addendum PKS" required autocomplete="off" style="width: 180px;display: inline;">
                      <!-- <datalist id="no_pks_list">
                        @foreach($pkss as $pks)
                          <option>{{$pks->no_pks}}</option>
                        @endforeach
                      </datalist> -->
                      <!-- <datalist id="no_pks">
                        @foreach($jabatans as $jabatan)
                          <option>{{$jabatan->jabatan}}</option>
                        @endforeach
                      </datalist> --> 
                      tanggal <b><span id="tgl_pks_list"></span></b>
                      <input class="form-control form-control-sm date" type="hidden" list="tgl_pks_list" name="tgl_pks" id="tgl_pks" placeholder="tanggal PKS / Addendum PKS" required autocomplete="off" style="width: 180px;display: inline;">
                      <!-- <datalist id="tgl_pks_list">
                        @foreach($pkss as $pks)
                          <option>{{$pks->tgl_pks}}</option>
                        @endforeach
                      </datalist> -->
                      , dengan ini kami sampaikan relokasi sewa mobil sebanyak <b>{{$count_mobil}} ({{terbilang($count_mobil)}})</b> unit dan pengemudi sebanyak <b>{{$count_driver}} ({{terbilang($count_driver)}})</b> orang, dengan data sebagai berikut :
                    </p>
                    <br>
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover text-center " id="myTable" style="width: 100%">
                      <thead class="">
                        <tr>
                          <th scope="col" rowspan="2"><b>No</b></th>
                          <th scope="col" rowspan="2"><b>Merk/Type/Tahun</b></th> 
                          <th scope="col" rowspan="2"><b>No polisi</b></th> 
                          <th scope="col" rowspan="2"><b>Data Pairing</b></th> 
                          <th scope="col" colspan="2" class="bg-yellow text-white"><b>Cabang Lama</b></th>
                          <th scope="col" colspan="1" class="bg-info text-white"><b>Cabang Baru</b></th>               
                          <th scope="col" rowspan="2" style="min-width: 200px"><b>Tgl efektif</b></th>   
                        </tr>
                        <tr>
                          <th scope="col" class="bg-yellow text-white"><b>Nama</b></th>
                          <th scope="col" class="bg-yellow text-white"><b>Kode</b></th>
                          <th scope="col" class="bg-info text-white" style="min-width: 300px"><b>Nama cabang</b></th>
                          <!-- <th scope="col" class="bg-info text-white" style="min-width: 250px"><b>Harga driver</b></th> -->
                        </tr>
                      </thead>
                      <tbody>
                         <?php $i = 0; ?>
                         @foreach($poss as $po)
                         <?php $i++; ?>
                         <form action="{{url('/backend/po/edit_relokasi/multiple/'.$po->id)}}" method="post" role="form">
                           {{ csrf_field() }}

                           <input type="hidden" name="po_id[]" value="{{$po->id}}">
                           <input type="hidden" id="no_surat_hasil{{$i}}" name="no_surat">
                           <input type="hidden"                           name="tgl_surat" value="Jakarta, {{ strftime('%d %B %Y', strtotime($currentDateTime))}}">
                           <input type="hidden"                           name="nama_vendor" value="{{$vendor_nama}}">
                           <input type="hidden"                           name="pic_vendor" value="{{$vendor_pic}}">
                           <input type="hidden"                           name="alamat_vendor" value="{{$vendor_alamat}}">
                           <input type="hidden" id="jabatan_vendor_hasil{{$i}}" name="jabatan_vendor" value="{{$vendor_jabatan}}">
                           <input type="hidden" id="pks_hasil{{$i}}"      name="pks" >
                           <input type="hidden" id="no_pks_hasil{{$i}}"   name="no_pks" >
                           <input type="hidden" id="tgl_pks_hasil{{$i}}"  name="tgl_pks" >
                           <input type="hidden"                           name="jml_mobil" value="{{$count_mobil}}">
                           <input type="hidden"                           name="jml_driver" value="{{$count_driver}}">
                           <input type="hidden" id="nama_pb1_hasil{{$i}}"       name="nama_pb1" >
                           <input type="hidden" id="jabatan_pb1_hasil{{$i}}"    name="jabatan_pb1" >
                           <input type="hidden" id="unitkerja_pb1_hasil{{$i}}"  name="unitkerja_pb1" >
                           <input type="hidden" id="nama_pb2_hasil{{$i}}"       name="nama_pb2" >
                           <input type="hidden" id="jabatan_pb2_hasil{{$i}}"    name="jabatan_pb2" >
                           <input type="hidden" id="unitkerja_pb2_hasil{{$i}}"  name="unitkerja_pb2" >
                           <input type="hidden" id="vendor_id" value="{{$vendor_id}}">

                           <input type="hidden" name="nopol[]" value="{{$po->Nopol}}">
                           @foreach($cabangs as $cabang)
                              @if($cabang->id == $po->Cabang_id)
                                <input type="hidden" name="status_cabang_lama[]" value="{{$cabang->StatusCabang}}">
                                <input type="hidden" name="nama_cabang_lama[]" value="{{$cabang->NamaCabang}}">
                                <input type="hidden" name="kode_cabang_lama[]" value="{{$cabang->KodeCabang}}">
                              @endif
                           @endforeach

                           @foreach($mobils as $mobil)
                              @if($mobil->id == $po->Mobil_id)
                                <input type="hidden" name="mobil_id[]" value="{{$mobil->id}}">
                              @endif
                           @endforeach
                           <tr>
                             <td>{{$i}}</td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               @if(!isset($po->Mobil_id))

                                 <span class="">Tanpa Unit </span>
                               
                               @else

                               @foreach($mobils as $mobil)
                                 @if($po->Mobil_id == $mobil->id)
                                   <span class="">{{$mobil->MerekMobil}} {{$mobil->Type}} </span>
                                 @endif
                               @endforeach
                               
                               @endif

                               @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                                 @if($po->Sewa_sementara == 'Mobil+Driver')
                                    <span class="">+ Pengemudi</span>
                                 @endif
                               @else
                                 @if($po->Sewa == 'Mobil+Driver')
                                    <span class="">+ Pengemudi</span>
                                 @endif
                               @endif
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               @if($po->Nopol == 'null' || $po->Nopol == '')

                                 <span class="">Tanpa Unit</span> 
                               
                               @else

                                 <span class="">{{$po->Nopol}}</span>

                               @endif
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               @if($po->Sewa_sementara == 'Mobil+Driver')
                                  <span class="">Mobil + Driver</span> 
                               @elseif($po->Sewa_sementara == 'Mobil')
                                  <span class="">Mobil</span> 
                               @elseif($po->Sewa_sementara == 'Driver')
                                  <span class="">Driver</span> 
                               @endif
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               @if($po->Cabang_relokasi == '')
                                 @foreach($cabangs as $cabang)
                                   @if($cabang->id == $po->Cabang_id)
                                      <span class="">{{$cabang->StatusCabang}} {{$cabang->NamaCabang}}</span> 
                                   @endif
                                 @endforeach
                               @else
                                 @foreach($cabangs as $cabang)
                                   @if($cabang->id == $po->Cabang_relokasi)
                                     <span class="">{{$cabang->StatusCabang}} {{$cabang->NamaCabang}}</span> 
                                   @endif
                                 @endforeach
                               @endif
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               @if($po->Cabang_relokasi == '')
                                 @foreach($cabangs as $cabang)
                                   @if($cabang->id == $po->Cabang_id)
                                      <span class="">{{$cabang->KodeCabang}}</span> 
                                   @endif
                                 @endforeach
                               @else
                                 @foreach($cabangs as $cabang)
                                   @if($cabang->id == $po->Cabang_relokasi)
                                     <span class="">{{$cabang->KodeCabang}}</span> 
                                   @endif
                                 @endforeach
                               @endif
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <!-- <td>
                               
                                 @if($po->Nopo_relokasi == '')
                                 <input type="text" class="form-control" name="nopo_relokasi[]" value="" id="example3cols2Input" placeholder="">
                                 @else
                                 <input type="text" class="form-control" name="nopo_relokasi[]" value="" id="example3cols2Input" placeholder="">
                                 @endif
                              
                             </td> -->

                             <td>
                               
                                 <select class="form-control cabang select2" id="cabang{{$i}}" name="cabang_relokasi[]">
                                   <option value="unknown">unknown</option>
                                   <?php $ckota = "" ?>
                                   @foreach($cabangs as $cabang)
                                     @if($cabang->active != '1')
                                     <option value="{{$cabang->id}}">{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                     <?php $ckota = $cabang->Kota ?>
                                     @endif
                                   @endforeach
                                 </select>
                               
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <!-- <td> -->

                                                                  

                                      @if($po->Sewa == 'Mobil+Driver' || $po->Sewa == 'Driver')

                                      <input type="hidden" class="form-control harga_driver" id="harga_driver{{$i}}" type="text" value="0">
                                      <input type="hidden" id="harga_driver_hidden{{$i}}" name="hargasewadriver_relokasi[]" value="0">

                                      @else

                                      <input type="hidden" class="form-control harga_driver" type="text" value="0" disabled>
                                      <input type="hidden" name="hargasewadriver_relokasi[]" value="0">

                                      @endif

                                    
                             <!-- </td> -->

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               <input class="form-control date" type="text" name="tgl_efektif_relokasi[]" id="example-date-input" placeholder="mm / dd / yyyy" required autocomplete="off" required>
                             </td>
                           </tr>

                           @if($po->Cabang_relokasi == '')
                             <input type="hidden" name="cabang_lama[]" value="{{$po->Cabang_id}}">
                             <input type="hidden" name="nopo_lama[]" value="{{$po->NoPo}}">
                             <input type="hidden" name="hargasewadriver[]" value="{{$po->HargaSewaDriver2019}}">
                           @else
                             <input type="hidden" name="cabang_lama[]" value="{{$po->Cabang_relokasi}}">
                             <input type="hidden" name="nopo_lama[]" value="{{$po->Nopo_relokasi}}">
                             <input type="hidden" name="hargasewadriver[]" value="{{$po->Hargasewadriver_relokasi}}">
                           @endif

                         @endforeach
                         <?php $jumlah_baris_table += $i ?>
                      </tbody>
                    </table>
                    </div>
                    <br>
                    <p>
                      Demikian kami sampaikan, atas perhatian dan kerjasama Bapak kami ucapkan terima kasih.
                    </p>
                    <p>
                      Hormat Kami,<br>
                      <select class="form-control form-control-sm" id="pb1" style="width: 300px;display: inline;">
                        <option>Pilih Pejabat 1</option>
                        @foreach($pejabats as $pejabat)
                          @if($pejabat->active != '1')  
                            <option value="{{$pejabat->id}}">{{$pejabat->nama}} - {{$pejabat->jabatan_id}} - {{$pejabat->unitkerja_id}}</option>
                          @endif
                        @endforeach
                      </select>
                      &nbsp | &nbsp
                      <select class="form-control form-control-sm"  id="pb2" style="width: 300px;display: inline;">
                        <option>Pilih Pejabat 2</option>
                        @foreach($pejabats as $pejabat)
                          @if($pejabat->active != '1')  
                            <option value="{{$pejabat->id}}">{{$pejabat->nama}} - {{$pejabat->jabatan_id}} - {{$pejabat->unitkerja_id}}</option>
                          @endif
                        @endforeach
                      </select>
                      <br>
                      <br>

                      <div><b>PT BANK CENTRAL ASIA, Tbk.</b></div>     
                    
                      <span id="unitkerja_pb1">Unit Kerja PB 1</span> &nbsp  &nbsp <span id="unitkerja_pb2">Unit Kerja PB 2</span>

                    </p>
                    <br><br><br><br>
                    <div class="row">
                      <div class="col-md-3">
                        <b><span id="nama_pb1">[Nama PB 1]</span></b> <br>
                        <span id="jabatan_pb1">[jabatan PB 1]</span>
                      </div>
                      <div class="col-md-9">
                        <b><span id="nama_pb2">[Nama PB 2]</span></b> <br>
                        <span id="jabatan_pb2">[jabatan PB 2]</span>
                      </div>
                    </div>


                  <br>

<!-- 
                  <?php $i = 0; ?>
                  @foreach($poss as $pos)
                  <?php $i++; ?>
                  <form action="{{url('/backend/po/edit_relokasi/multiple/'.$pos->id)}}" method="post" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="po_id[]" value="{{$pos->id}}">

                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO :</label>
                                    </div>
                              </div>
                              
                              <div class="col-md-10">
                                    <div class="form-group">
                                      @if($pos->Nopo_relokasi == '')
                                      <input type="text" class="form-control" value="{{$pos->NoPo}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled>
                                      @else
                                      <input type="text" class="form-control" value="{{$pos->Nopo_relokasi}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled>
                                      @endif
                                    </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota (Old)</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                    <?php $ckota = "" ?>
                                    @if($pos->Cabang_relokasi == '')
                                      @foreach($cabangs as $cabang)
                                        @if($cabang->id == $pos->Cabang_id)
                                          <input type="text" class="form-control" value="{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled="">
                                        @endif
                                      @endforeach
                                    @else
                                      @foreach($cabangs as $cabang)
                                        @if($cabang->id == $pos->Cabang_relokasi)
                                          <input type="text" class="form-control" value="{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled="">
                                        @endif
                                      @endforeach
                                    @endif
                                    
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor </label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" id="vendor{{$i}}" name="vendor_id[]" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}" {{ $pos->Vendor_Mobil == $vendor->id ? 'selected' : '' }}>{{$vendor->NamaVendor}}</option>
                              
                                    @endforeach

                                  </select>
                                </div>
                              </div>


                              <div class="col-md-2">
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <label class="form-control-label mt-3" for="example3cols1Input">NEW</label>
                                </div>  
                              </div>

                              <div class="col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO :</label>
                                    </div>
                              </div>
                              
                              <div class="col-md-10">
                                    <div class="form-group">
                                      @if($pos->Nopo_relokasi == '')
                                      <input type="text" class="form-control" name="nopo_relokasi[]" value="" id="example3cols2Input" placeholder="">
                                      @else
                                      <input type="text" class="form-control" name="nopo_relokasi[]" value="" id="example3cols2Input" placeholder="">
                                      @endif
                                    </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota (New)</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control cabang select2" id="cabang{{$i}}" name="cabang_relokasi[]" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                                    <option value="unknown">unknown</option>
                                    <?php $ckota = "" ?>
                                    @foreach($cabangs as $cabang)
                                      @if($cabang->active != '1')
                                      <option value="{{$cabang->id}}">{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                      <?php $ckota = $cabang->Kota ?>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Efektif Relokasi</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <input class="form-control date" type="text" name="tgl_efektif_relokasi[]" id="example-date-input" placeholder="mm / dd / yyyy" required>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Driver (include)</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <div class="input-group input-group-merge">
                                    <div class="input-group-prepend" id="harga_driver_aja{{$i}}">
                                      <span class="input-group-text">Rp</span>
                                    </div>                                       

                                      @if($pos->Sewa == 'Mobil+Driver' || $pos->Sewa == 'Driver')

                                      <input class="form-control harga_driver" id="harga_driver{{$i}}" type="text" value="0">
                                      <input type="hidden" id="harga_driver_hidden{{$i}}" name="hargasewadriver_relokasi[]" value="0">

                                      @else

                                      <input class="form-control harga_driver" type="text" value="0" disabled>
                                      <input type="hidden" name="hargasewadriver_relokasi[]" value="0">

                                      @endif

                                    <div class="input-group-append">
                                      <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                    </div>    

                                  </div>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                          <div class="col-md-6" >
                                
                                @if($pos->Cabang_relokasi == '')
                                <input type="hidden" name="cabang_lama[]" value="{{$pos->Cabang_id}}">
                                <input type="hidden" name="nopo_lama[]" value="{{$pos->NoPo}}">
                                <input type="hidden" name="hargasewadriver[]" value="{{$pos->HargaSewaDriver2019}}">
                                @else
                                <input type="hidden" name="cabang_lama[]" value="{{$pos->Cabang_relokasi}}">
                                <input type="hidden" name="nopo_lama[]" value="{{$pos->Nopo_relokasi}}">
                                <input type="hidden" name="hargasewadriver[]" value="{{$pos->Hargasewadriver_relokasi}}">
                                @endif

                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>
                </div>
                
                @endforeach -->
                <div class="mr-4">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                      <div class="form-group float-right pull-right">
                        <a href="{{url('backend/po/relokasi')}}" type="button" class="btn btn-default">Back</a>
                        <button type="submit" id="save" class="btn btn-success pl-5 pr-5">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            
            <div class="tempat_tambah">
              
            </div>

          </div>
        </div>
      </div>
    </section>



<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>


<script type="text/javascript">

  $(document).ready(function() {

    $('#pilih_pks').change(function(){

       // Department id
       var value = $(this).val();
       var _token = $('input[name="_token"]').val();

       // Empty the dropdown
       $('#pilih_addendum').find('option').not(':first').remove();

       // AJAX request 
       $.ajax({
         url:"{{ route('pilih_pks.check') }}",
         method:"POST",
         data:{value:value, _token:_token},
         success: function(data) {
             $('#pilih_addendum').html(data.html);
         }
      });
    });

    $('#pilih_addendum').on('change', function(e) {

          e.preventDefault();

          var id = $(this).val();

          $.ajax({

               type:'POST',

               url:'{{ route('pks_addendum_ajax') }}',

               dataType:"json",

               data:{"_token": "{{ csrf_token() }}",id:id},

               beforeSend: function() {
                  $('#pks_list').empty();
                  $('#pks_list').append('<b class="text-danger"><b>Processing...</b></b>');
                  $('#no_pks_list').empty();
                  $('#no_pks_list').append('<b class="text-danger"><b>Processing...</b></b>');
                  $('#tgl_pks_list').empty();
                  $('#tgl_pks_list').append('<b class="text-danger"><b>Processing...</b></b>');
                },

               success:function(data){

                  $('#pks').val('');
                  $('#no_pks').val('');
                  $('#tgl_pks').val('');
                  $('#addendum_id').val('');

                   $.each(data, function(key, value) {

                      $('#pks').val(value.nama_kontrak_addendum);
                      $('#no_pks').val(value.no_addendum);
                      $('#tgl_pks').val(value.tgl_addendum);
                      $('#pks_list').empty();
                      $('#no_pks_list').empty();
                      $('#tgl_pks_list').empty();   
                      $('#pks_list').append(value.nama_kontrak_addendum);
                      $('#no_pks_list').append(value.no_addendum);
                      $('#tgl_pks_list').append(value.tgl_addendum);

                    });

               }

          });

    });

    $('#pilih_pks').on('change', function(e) {

          e.preventDefault();

          var id = $(this).val();

          $.ajax({

               type:'POST',

               url:'{{ route('pks_ajax') }}',

               dataType:"json",

               data:{"_token": "{{ csrf_token() }}",id:id},

               beforeSend: function() {
                  $('#pks_list').empty();
                  $('#pks_list').append('<b class="text-danger"><b>Processing...</b></b>');
                  $('#no_pks_list').empty();
                  $('#no_pks_list').append('<b class="text-danger"><b>Processing...</b></b>');
                  $('#tgl_pks_list').empty();
                  $('#tgl_pks_list').append('<b class="text-danger"><b>Processing...</b></b>');
                },

               success:function(data){

                  $('#pks').val('');
                  $('#no_pks').val('');
                  $('#tgl_pks').val('');
                  $('#addendum_id').val('');

                    $.each(data, function(key, value) {

                      $('#pks').val(value.nama_kontrak_pks);
                      $('#no_pks').val(value.no_pks);
                      $('#tgl_pks').val(value.tgl_pks);
                      $('#pks_list').empty();
                      $('#no_pks_list').empty();
                      $('#tgl_pks_list').empty();
                      $('#pks_list').append(value.nama_kontrak_pks);
                      $('#no_pks_list').append(value.no_pks);
                      $('#tgl_pks_list').append(value.tgl_pks);


                      var id = value.addendum_id;

                      $.ajax({

                           type:'POST',

                           url:'{{ route('pks_addendum_ajax') }}',

                           dataType:"json",

                           data:{"_token": "{{ csrf_token() }}",id:id},

                           success:function(data){ 

                                $.each(data, function(key, value) {

                                  $('#pks').val(value.nama_kontrak_addendum);
                                  $('#no_pks').val(value.no_addendum);
                                  $('#tgl_pks').val(value.tgl_addendum);
                                  $('#pks_list').empty();
                                  $('#no_pks_list').empty();
                                  $('#tgl_pks_list').empty();   
                                  $('#pks_list').append(value.nama_kontrak_addendum);
                                  $('#no_pks_list').append(value.no_addendum);
                                  $('#tgl_pks_list').append(value.tgl_addendum);

                                });

                           }

                      });

                    });

               }

          });

    });

    // $('#addendum_id').on('change', function(e) {

    //       e.preventDefault();

    //       var id = $(this).val();

    //       $.ajax({

    //            type:'POST',

    //            url:'{{ route('pks_addendum_ajax') }}',

    //            dataType:"json",

    //            data:{"_token": "{{ csrf_token() }}",id:id},

    //            success:function(data){


    //               $('#pks').val('');
    //               $('#no_pks').val('');
    //               $('#tgl_pks').val('');
                  

    //                 $.each(data, function(key, value) {

    //                   $('#pks').val(value.nama_kontrak_addendum);
    //                   $('#no_pks').val(value.no_addendum);
    //                   $('#tgl_pks').val(value.tgl_addendum);

    //                 });

    //            }

    //       });

    // });

    var uk1 = '';
    var uk2 = '';

    $('#pb1').on('change', function(e) {

          e.preventDefault();

          var id = $(this).val();

          $.ajax({

               type:'POST',

               url:'{{ route('pb_ajax') }}',

               dataType:"json",

               data:{"_token": "{{ csrf_token() }}",id:id},

               success:function(data){


                  $('#nama_pb1').empty();
                  $('#jabatan_pb1').empty();
                  $('#unitkerja_pb1').empty();
                  uk1 = '';

                    $.each(data, function(key, value) {

                      $('#nama_pb1').append(value.nama);
                      $('#jabatan_pb1').append(value.jabatan_id);
                      uk1 = value.unitkerja_id;
                      if (uk1 != uk2) {
                        $('#unitkerja_pb1').append(value.unitkerja_id);
                      }

                    });

               }

          });

    });

    $('#pb2').on('change', function(e) {

              e.preventDefault();

              var id = $(this).val();

              $.ajax({

                   type:'POST',

                   url:'{{ route('pb_ajax') }}',

                   dataType:"json",

                   data:{"_token": "{{ csrf_token() }}",id:id},

                   success:function(data){


                      $('#nama_pb2').empty();
                      $('#jabatan_pb2').empty();
                      $('#unitkerja_pb2').empty();
                      uk2 = '';

                        $.each(data, function(key, value) {

                          $('#nama_pb2').append(value.nama);
                          $('#jabatan_pb2').append(value.jabatan_id);
                          uk2 = value.unitkerja_id;
                          if (uk1 != uk2) {
                            $('#unitkerja_pb2').append(value.unitkerja_id);
                          }

                        });

                   }

              });

        });

    var baris = <?php echo $jumlah_baris_table ?> + 1;
      
    var i=0;
        
        while ( ++i < baris ) {

           (function(i){

              $('#pilih_addendum').on('change', function(e) {

                    e.preventDefault();

                    var id = $(this).val();

                    $.ajax({

                         type:'POST',

                         url:'{{ route('pks_addendum_ajax') }}',

                         dataType:"json",

                         data:{"_token": "{{ csrf_token() }}",id:id},

                         success:function(data){

                            $('#pks_hasil'+i).val('');
                            $('#no_pks_hasil'+i).val('');
                            $('#tgl_pks_hasil'+i).val('');

                             $.each(data, function(key, value) {

                                $('#pks_hasil'+i).val(value.nama_kontrak_addendum);
                                $('#no_pks_hasil'+i).val(value.no_addendum);
                                $('#tgl_pks_hasil'+i).val(value.tgl_addendum);

                              });

                         }

                    });

              });

              $('#pilih_pks').on('change', function(e) {

                    e.preventDefault();

                    var id = $(this).val();

                    $.ajax({

                         type:'POST',

                         url:'{{ route('pks_ajax') }}',

                         dataType:"json",

                         data:{"_token": "{{ csrf_token() }}",id:id},

                         success:function(data){


                            $('#pks_hasil'+i).val('');
                            $('#no_pks_hasil'+i).val('');
                            $('#tgl_pks_hasil'+i).val('');

                              $.each(data, function(key, value) {

                                $('#pks_hasil'+i).val(value.nama_kontrak_pks);
                                $('#no_pks_hasil'+i).val(value.no_pks);
                                $('#tgl_pks_hasil'+i).val(value.tgl_pks);

                                var id = value.addendum_id;

                                $.ajax({

                                     type:'POST',

                                     url:'{{ route('pks_addendum_ajax') }}',

                                     dataType:"json",

                                     data:{"_token": "{{ csrf_token() }}",id:id},

                                     success:function(data){                           

                                          $.each(data, function(key, value) {

                                            $('#pks_hasil'+i).val(value.nama_kontrak_addendum);
                                            $('#no_pks_hasil'+i).val(value.no_addendum);
                                            $('#tgl_pks_hasil'+i).val(value.tgl_addendum);

                                          });

                                     }

                                });

                              });

                         }

                    });

              });

              $('#pb1').on('change', function(e) {

                    e.preventDefault();

                    var id = $(this).val();

                    $.ajax({

                         type:'POST',

                         url:'{{ route('pb_ajax') }}',

                         dataType:"json",

                         data:{"_token": "{{ csrf_token() }}",id:id},

                         success:function(data){


                            $('#unitkerja_pb1_hasil'+i).empty();
                            $('#jabatan_pb1_hasil'+i).empty();
                            $('#nama_pb1_hasil'+i).empty();

                              $.each(data, function(key, value) {

                                $('#nama_pb1_hasil'+i).val(value.nama);
                                $('#jabatan_pb1_hasil'+i).val(value.jabatan_id);
                                $('#unitkerja_pb1_hasil'+i).val(value.unitkerja_id);

                              });

                         }

                    });

              });

              $('#pb2').on('change', function(e) {

                        e.preventDefault();

                        var id = $(this).val();

                        $.ajax({

                             type:'POST',

                             url:'{{ route('pb_ajax') }}',

                             dataType:"json",

                             data:{"_token": "{{ csrf_token() }}",id:id},

                             success:function(data){


                                $('#unitkerja_pb2_hasil'+i).empty();
                                $('#jabatan_pb2_hasil'+i).empty();
                                $('#nama_pb2_hasil'+i).empty();

                                  $.each(data, function(key, value) {

                                    $('#nama_pb2_hasil'+i).val(value.nama);
                                    $('#jabatan_pb2_hasil'+i).val(value.jabatan_id);
                                    $('#unitkerja_pb2_hasil'+i).val(value.unitkerja_id);

                                  });

                             }

                        });

                  });

              $('#no_surat').on('keyup',function() {
                var d = new Date();
                var yyyy = d.getFullYear();
                $('#no_surat_hasil'+i).val($(this).val()+'/JS/BPD/KPS/'+yyyy);
              });

              $('#jabatan_vendor').on('keyup',function() {
                $('#jabatan_vendor_hasil'+i).val($(this).val());
              });

              $('#pks').on('keyup',function() {
                $('#pks_hasil'+i).val($(this).val());
              });

              $('#no_pks').on('keyup',function() {
                $('#no_pks_hasil'+i).val($(this).val());
              });

              $('#tgl_pks').on('blur',function() {
                $('#tgl_pks_hasil'+i).val($(this).val());
              });


              $('#jabatan_vendor').on('input',function() {
                $('#jabatan_vendor_hasil'+i).val($(this).val());
              });
              
              $('#cabang'+i).on('change', function(e) {

                        e.preventDefault();

                        var kota = $(this).val();

                        var vendor = $('#vendor_id').val();

                        $.ajax({

                             type:'POST',

                             url:'{{ route('kota_ajax') }}',

                             dataType:"json",

                             data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

                             success:function(data){

                                $('#harga_driver_ajax_empty').empty();

                                  $.each(data, function(key, value) {

                                    $('#harga_driver_hidden'+i).val(value.Harga_include);
                                    var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    $('#harga_driver'+i).val(hasil);

                                  });

                             }

                        });

                  });

                  

                  $(document).ready(function() {

                    $('#harga_mobil'+i).autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});
                    
                    $('#harga_driver'+i).autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

                    $('#harga_mobil'+i).on('keyup',function() {
                      $('#toggle').val('no');
                      var x = document.getElementById("harga_mobil"+i).value;
                      var z = x.replace(/\./g, "");
                      var qty = parseInt(z);
                      $('#harga_mobil_hidden'+i).val(qty);
                      var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                      $('#harga_mobil'+i).val(hasil);
                    });
                    $('#harga_mobil'+i).on('input',function() {
                      $('#toggle').val('no');
                      var x = document.getElementById("harga_mobil"+i).value;
                      var z = x.replace(/\./g, "");
                      var qty = parseInt(z);
                      $('#harga_mobil_hidden'+i).val(qty);
                      var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                      $('#harga_mobil'+i).val(hasil);
                    });

                    $('#harga_driver'+i).on('keyup',function() {
                      $('#toggle').val('no');
                      var x = document.getElementById("harga_driver"+i).value;
                      var z = x.replace(/\./g, "");
                      var qty = parseInt(z);
                      $('#harga_driver_hidden'+i).val(qty);
                      var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                      $('#harga_driver'+i).val(hasil);
                    });
                    $('#harga_driver'+i).on('input',function() {
                      $('#toggle').val('no');
                      var x = document.getElementById("harga_driver"+i).value;
                      var z = x.replace(/\./g, "");
                      var qty = parseInt(z);
                      $('#harga_driver_hidden'+i).val(qty);
                      var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                      $('#harga_driver'+i).val(hasil);
                    });

                  });
     
           })(i);
        }
      

    });




// $(document).ready(function(){
//   var count = 1;


//   function dynamic_field(number)
//   {
//     var html = '<div class="row">'

//     html += '<p>asfasdad</p>';

//     if(number > 1)
//     {
//       html += '<button type="submit" id="tombol_remove" class="btn btn-danger pl-5 pr-5 pull-right float-right">Remove</button></div>';
//       $('#tombol_remove').append(html)
//     }else{

//     }
//   }

//   $('.add').click(function(){
//     count++;
//     dynamic_field(count);
//     $('#dynamic_field').append('<p>ketambah nih</p><br>')  
//   });

//   $(document).on('click', '#tombol_remove', function(){
//     count--;
//     dynamic_field(count);
//   });

//   $(#dynamic_field).on('submit', function(event){
//     event.preventDefault();
//     $.ajax({
//       url:'{{url("/backend/po/create")}}',
//       method:'post',
//       data:$(this).serialize(),
//       dataType:'json',
//       beforeSend:function(){
//         $('#save').attr('disabled','disabled');
//       },
//       success:function(data)
//       {
//         if (data.error) 
//         {
//           var error_html = '';
//           for(var count = 0;count < data.error.length; count++)
//           {
//             error_html += '<p>'+data.error[count]+'<p>';
//           }
//           $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
//         }
//         else
//         {
//           dynamic_field(1);
//           $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
//         }
//         $('#save').attr('disabled', false);
//       }
//     })
//   });

//   });
</script>


@endsection






