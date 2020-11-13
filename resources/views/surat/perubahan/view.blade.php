<?php $page = "Surat"; ?>
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
  }else if($tanggal == '0') {
    $terbilang = 'nol';
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
    $jumlah_unit = 0;
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
                    <h3 class="mb-0">Form Perubahan PO</h3>
                  </div>
                  <!-- Card body -->
                  
                  <div class="card-body p-5">
                    <p>
                      <span>No. {{$template_perubahan->no_surat}}</span> 
                      
                      <span class="float-right">{{$template_perubahan->tgl_surat}}</span>
                    </p>
                    <br>
                    <p>
                      Kepada,
                      <br>
                        

                          @foreach($vendors as $vendor)
                              @if($template_perubahan->nama_vendor == $vendor->NamaVendor)
                                <?php $vendor_nama = $vendor->NamaVendor ?>
                                <?php $vendor_alamat = $vendor->AlamatVendor ?>
                                <?php $vendor_pic = $vendor->PICvendor ?>
                                <?php $vendor_pejabat = $vendor->Pejabatvendor ?>
                                <?php $vendor_id = $vendor->id ?>
                              @endif
                          @endforeach

                        <b>{{$vendor_nama}}</b>

                      <br>

                        <b>{{$vendor_alamat}}</b>
                      
                    </p>
                    <p>
                      <b>Up. Yth. <b>{{$vendor_pejabat}} – {{$template_perubahan->jabatan_vendor}}</b>
                      <!-- <input type="text" class="form-control form-control-sm" list="team_list" id="jabatan_vendor" value="{{$template_perubahan->jabatan_vendor}}" placeholder="Jabatan" required autocomplete="off" style="width: 150px;display: inline;"> -->
                      <datalist id="team_list">
                        @foreach($jabatans as $jabatan)
                          <option>{{$jabatan->jabatan}}</option>
                        @endforeach
                      </datalist>
                      </b>
                    </p>
                    <p>
                      Perihal : <b>Perubahan Data Pairing</b>
                    </p>
                    <p>
                      Dengan hormat,
                    </p>
                    <p>

        
                        @if($template_perubahan->sewa == 'Mobil dan Pengemudi')
                          <?php $count_driver++; ?>
                          <?php $count_mobil++; ?>
                        @elseif($template_perubahan->sewa == 'Mobil')
                          <?php $count_mobil++; ?>
                        @elseif($template_perubahan->sewa == 'Pengemudi')
                          <?php $count_driver++; ?>
                        @endif
               


                      Menunjuk {{$template_perubahan->pks}}
                      
                      No. {{$template_perubahan->no_pks}}
                      
                      tanggal {{$template_perubahan->tgl_pks}}
                      

                      @foreach($table_template_perubahans as $table_template_perubahan)
                        @foreach($poss as $po)
                          @if($po->id == $table_template_perubahan->po_id && $template_perubahan->id == $table_template_perubahan->template_id)
                            <?php $jumlah_unit++; ?>
                          @endif
                        @endforeach
                      @endforeach

                      , dengan ini kami sampaikan perubahan data pairing sebanyak <b>{{$jumlah_unit}}</b> (<b>{{terbilang($jumlah_unit)}}</b>) unit, dengan data sebagai berikut :
                    </p>
                    <br>
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover text-center " id="myTable" style="width: 100%">
                      <thead class="">
                        <tr>
                          <th scope="col" ><b>No</b></th>
                          <th scope="col" class=""><b>Nama cabang</b></th>
                          <th scope="col" class=""><b>Kode Cab. / RCC</b></th>
                          <th scope="col" class="" style="min-width: 250px"><b>Merk/Type/Tahun</b></th>
                          <th scope="col" class="" style="min-width: 300px"><b>No. Polisi</b></th>
                          <th scope="col" class="" style="min-width: 300px"><b>Data Pairing Lama</b></th>
                          <th scope="col" class="" style="min-width: 300px"><b>Data Pairing Baru</b></th>
                          <th scope="col" class="" style="min-width: 250px"><b>Tgl. Efektif</b></th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php $i = 0; ?>
                         @foreach($table_template_perubahans as $table_template_perubahan)
                         @foreach($poss as $po)
                         @if($po->id == $table_template_perubahan->po_id && $template_perubahan->id == $table_template_perubahan->template_id)
                         <?php $i++; ?>
                         <form action="{{url('/backend/po/update/edit_perubahan/proses')}}" method="post" role="form">
                           {{ csrf_field() }}


                           <input type="hidden" name="po_id[]" value="{{$po->id}}">
                           <input type="hidden" id="no_surat_hasil{{$i}}" name="no_surat" value="{{$template_perubahan->no_surat}}">
                           <input type="hidden"                           name="tgl_surat" value="Jakarta, {{ date('d-M-Y', strtotime($currentDateTime))}}">
                           <input type="hidden"                           name="nama_vendor" value="{{$vendor_nama}}">
                           <input type="hidden"                           name="pic_vendor" value="{{$vendor_pic}}">
                           <input type="hidden"                           name="alamat_vendor" value="{{$vendor_alamat}}">
                           <input type="hidden" id="jabatan_vendor_hasil{{$i}}" name="jabatan_vendor" value="{{$template_perubahan->jabatan_vendor}}">
                           <!-- <input type="hidden"                           name="sewa" value="{{$po_sewa}}"> -->
                           <input type="hidden" id="pks_hasil{{$i}}"      name="pks" value="{{$template_perubahan->pks}}">
                           <input type="hidden" id="no_pks_hasil{{$i}}"   name="no_pks" value="{{$template_perubahan->no_pks}}">
                           <input type="hidden" id="tgl_pks_hasil{{$i}}"  name="tgl_pks" value="{{$template_perubahan->tgl_pks}}">
                           <input type="hidden"                           name="jml_mobil" value="{{$count_mobil}}">
                           <input type="hidden"                           name="jml_driver" value="{{$count_driver}}">
                           <input type="hidden" id="nama_pb1_hasil{{$i}}"       name="nama_pb1" value="{{$template_perubahan->nama_pb1}}">
                           <input type="hidden" id="jabatan_pb1_hasil{{$i}}"    name="jabatan_pb1" value="{{$template_perubahan->jabatan_pb1}}">
                           <input type="hidden" id="unitkerja_pb1_hasil{{$i}}"  name="unitkerja_pb1" value="{{$template_perubahan->unitkerja_pb1}}">
                           <input type="hidden" id="nama_pb2_hasil{{$i}}"       name="nama_pb2" value="{{$template_perubahan->nama_pb2}}">
                           <input type="hidden" id="jabatan_pb2_hasil{{$i}}"    name="jabatan_pb2" value="{{$template_perubahan->jabatan_pb2}}">
                           <input type="hidden" id="unitkerja_pb2_hasil{{$i}}"  name="unitkerja_pb2" value="{{$template_perubahan->unitkerja_pb2}}">
                           <input type="hidden" id="vendor_id" value="{{$vendor_id}}">

                           <input type="hidden" name="nopol" value="{{$po->Nopol}}">
                           <input type="hidden" name="template_perubahan_id" value="{{$template_perubahan->id}}">
                           @foreach($cabangs as $cabang)
                              @if($cabang->id == $po->Cabang_id)
                                <input type="hidden" name="status_cabang_lama[]" value="{{$cabang->StatusCabang}}">
                                <input type="hidden" name="nama_cabang_lama[]" value="{{$cabang->NamaCabang}}">
                                <input type="hidden" name="kode_cabang_lama[]" value="{{$cabang->KodeCabang}}">
                              @endif
                           @endforeach

                           @if($po->Sewa_sementara == "Mobil+Driver")
                            <input type="hidden" name="sewa_pengurangan[]" value="Driver">
                           @elseif($po->Sewa_sementara == "Mobil")
                            <input type="hidden" name="sewa_pengurangan[]" value="Mobil+Driver">
                           @endif

                           @foreach($mobils as $mobil)
                              @if($mobil->id == $po->Mobil_id)
                                <input type="hidden" name="mobil_id[]" value="{{$mobil->id}}">
                              @endif
                           @endforeach
                           
                           <tr>
                             <td>{{$i}}</td>
                             

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               {{$table_template_perubahan->nama_cabang}}
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               {{$table_template_perubahan->kode_cabang}}
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               

                               @foreach($mobils as $mobil)
                                 @if($table_template_perubahan->merek == $mobil->id)
                                   <span class="">{{$mobil->MerekMobil}} {{$mobil->Type}} {{$mobil->Tahun}}</span>
                                 @endif
                               @endforeach
                               
                               

                               <!-- @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                                 @if($po->Sewa_sementara == 'Mobil+Driver')
                                    <span class="">+ Pengemudi</span>
                                 @endif
                               @else
                                 @if($po->Sewa == 'Mobil+Driver')
                                    <span class="">+ Pengemudi</span>
                                 @endif
                               @endif -->
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               {{$table_template_perubahan->nopol}}
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               <span>{{$table_template_perubahan->data_pairing_lama}}</span>
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               <!-- <select class="form-control" id="sewa{{$i}}" name="sewa[]"  style="width: 200px;display: inline;"> -->
                                 <span>{{$table_template_perubahan->data_pairing_baru}}</span>
                                 
                               <!-- </select> -->
                             </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                              {{ strftime('%d %B %Y', strtotime($table_template_perubahan->tgl_efektif))}}
                               
                             </td>

                           </tr>

                             @if($po->Cabang_perubahan == '')
                               <input type="hidden" name="cabang_lama[]" value="{{$po->Cabang_id}}">
                               <input type="hidden" name="nopo_lama[]" value="{{$po->NoPo}}">
                               <input type="hidden" name="hargasewadriver[]" value="{{$po->HargaSewaDriver2019}}">
                             @else
                               <input type="hidden" name="cabang_lama[]" value="{{$po->Cabang_perubahan}}">
                               <input type="hidden" name="nopo_lama[]" value="{{$po->Nopo_perubahan}}">
                               <input type="hidden" name="hargasewadriver[]" value="{{$po->Hargasewadriver_perubahan}}">
                             @endif
                           @endif
                           @endforeach
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
                      
                      <div><b>PT BANK CENTRAL ASIA, Tbk.</b></div> 

                      @if($template_perubahan->unitkerja_pb1 == $template_perubahan->unitkerja_pb2)
                        <span id="unitkerja_pb1">{{$template_perubahan->unitkerja_pb1}}</span>
                      @else
                        <span id="unitkerja_pb1">{{$template_perubahan->unitkerja_pb1}}</span> &nbsp <span id="unitkerja_pb2">{{$template_perubahan->unitkerja_pb2}}</span>
                      @endif    

                    </p>
                    <br><br><br><br>
                    <div class="row">
                      <div class="col-md-3">
                        <b><span id="nama_pb1">{{$template_perubahan->nama_pb1}}</span></b> <br>
                        <span id="jabatan_pb1">{{$template_perubahan->jabatan_pb1}}</span>
                      </div>
                      <div class="col-md-9">
                        <b><span id="nama_pb2">{{$template_perubahan->nama_pb2}}</span></b> <br>
                        <span id="jabatan_pb2">{{$template_perubahan->jabatan_pb2}}</span>
                      </div>
                    </div>


                  <br>

                <div class="mr-4">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                      <div class="form-group float-right pull-right">
                        <a href="javascript:history.back()" type="button" class="btn btn-default pl-5 pr-5">Back</a>
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



<script type="text/javascript">

  $(document).ready(function() {

    $('#pilih_pks').on('change', function(e) {

          e.preventDefault();

          var id = $(this).val();

          $.ajax({

               type:'POST',

               url:'{{ route('pks_ajax') }}',

               dataType:"json",

               data:{"_token": "{{ csrf_token() }}",id:id},

               success:function(data){


                  $('#pks').val('');
                  $('#no_pks').val('');
                  $('#tgl_pks').val('');
                  $('#addendum_id').val('');

                    $.each(data, function(key, value) {

                      $('#pks').val(value.nama_kontrak_pks);
                      $('#no_pks').val(value.no_pks);
                      $('#tgl_pks').val(value.tgl_pks);

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

    

    var baris = <?php echo $jumlah_baris_table ?> + 1;
      
    var i=0;
        
        while ( ++i < baris ) {

           (function(i){

              var uk1 = $('#unitkerja_pb1_hasil'+i).val();
              var uk2 = $('#unitkerja_pb2_hasil'+i).val();

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
                $('#no_surat_hasil'+i).val($(this).val());
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






