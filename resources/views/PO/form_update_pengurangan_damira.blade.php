<?php $page = "Pengurangan"; ?>
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
    // $(function () {
    //     $("#tgl_cutoff").show();
    //     $("#tgl_cutoff_disabled").hide();
    //     $("#sewa").change(function () {
    //         if ($(this).val() == "null") {
    //             $("#tgl_cutoff").show();
    //             $("#tgl_cutoff_disabled").hide();
    //         } else if($(this).val() == "Driver") {
    //             $("#tgl_cutoff").hide();
    //             $("#tgl_cutoff_disabled").show();
    //         } else{
    //             $("#mobil").show();
    //             $("#driver").show();
    //         }
    //   });
        
    // });

    $(document).ready(function(){
        var i = 1;
        $('.add').click(function(){
          i++;
          $("#tambuh").clone().appendTo( ".tempat_tambah" );
        });
    });
</script>

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
                    <h3 class="mb-0">Form Purchase Order</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body p-5">

                    <p>
                      <span>No. <input class="form-control form-control-sm" type="text" id="no_surat" value="{{$template_pengurangan->no_surat}}" required autocomplete="off" style="width: 250px;display: inline;"></span>
                      
                      <span class="float-right">Jakarta, {{strftime("%d %B %Y", strtotime($currentDateTime))}}</span>
                    </p>
                    <br>
                    <p>
                      Kepada,
                      <br>
                          @foreach($vendors as $vendor)
                              @if($template_pengurangan->nama_vendor == $vendor->NamaVendor)
                                <?php $vendor_kode = $vendor->KodeVendor ?>
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
                      <b>Up. Yth. {{$vendor_pejabat}} – {{$template_pengurangan->jabatan_vendor}}
                      </b>
                    </p>
                    <p>
                      Perihal : Pengehentian Sewa <b>{{$template_pengurangan->sewa}}</b>
                    </p>
                    <p>
                      Dengan hormat,
                    </p>
                    
                      @include('PO.form_pks_addendum')

                    <p>

                        


                      Menunjuk 
                      <input type="text" class="form-control form-control-sm" list="pks" value="{{$template_pengurangan->pks}}" id="pks" placeholder="PKS / Addendum PKS" required autocomplete="off" style="width: 180px;display: inline;">
                      <!-- <datalist id="pks">
                        @foreach($jabatans as $jabatan)
                          <option>{{$jabatan->jabatan}}</option>
                        @endforeach
                      </datalist> -->
                      No. 
                      <input type="text" class="form-control form-control-sm" list="no_pks" id="no_pks" value="{{$template_pengurangan->no_pks}}" placeholder="nomor PKS / Addendum PKS" required autocomplete="off" style="width: 180px;display: inline;">
                      <!-- <datalist id="no_pks">
                        @foreach($jabatans as $jabatan)
                          <option>{{$jabatan->jabatan}}</option>
                        @endforeach
                      </datalist> --> 
                      tanggal 
                      <input class="form-control form-control-sm date" type="text" name="tgl_pks" id="tgl_pks" value="{{$template_pengurangan->tgl_pks}}" placeholder="tanggal PKS / Addendum PKS" required style="width: 180px;display: inline;">
                      , dengan ini kami sampaikan penghentian sewa pengemudi sebanyak <b><span id="count_driver">{{$template_pengurangan->jml_driver}} ({{terbilang($template_pengurangan->jml_driver)}})</span></b> orang, dengan data sebagai berikut : 
                    </p>
                    <br>
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover text-center " id="myTable" style="width: 100%">
                      <thead class="">
                        <tr>
                          <th scope="col" ><b>No</b></th>
                          <th scope="col" class=""><b>Nama Cabang / Unit Kerja</b></th>
                          <th scope="col" class=""><b>Kode Cabang / RCC</b></th>
                          <th scope="col" class="" style="min-width: 250px"><b>Tgl. Efektif</b></th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php $i = 0; ?>
                         @foreach($table_template_pengurangans as $table_template_pengurangan)
                         @foreach($poss as $po)
                         @if($po->id == $table_template_pengurangan->po_id && $template_pengurangan->id == $table_template_pengurangan->template_id)
                         <?php $i++; ?>
                         <form action="{{url('/backend/po/update/edit_pengurangan/proses')}}" method="post" role="form">
                           {{ csrf_field() }}


                           <input type="hidden" name="po_id[]" value="{{$po->id}}">
                           <input type="hidden" id="no_surat_hasil{{$i}}" name="no_surat" value="{{$template_pengurangan->no_surat}}">
                           <input type="hidden"                           name="tgl_surat" value="Jakarta, {{ strftime('%d %B %Y', strtotime($currentDateTime))}}">
                           <input type="hidden"                           name="nama_vendor" value="{{$vendor_nama}}">
                           <input type="hidden"                           name="pic_vendor" value="{{$vendor_pic}}">
                           <input type="hidden"                           name="alamat_vendor" value="{{$vendor_alamat}}">
                           <input type="hidden" id="jabatan_vendor_hasil{{$i}}" name="jabatan_vendor" value="{{$template_pengurangan->jabatan_vendor}}">
                           <!-- <input type="hidden"                           name="sewa" value="{{$po_sewa}}"> -->
                           <input type="hidden" id="pks_hasil{{$i}}"      name="pks" value="{{$template_pengurangan->pks}}">
                           <input type="hidden" id="no_pks_hasil{{$i}}"   name="no_pks" value="{{$template_pengurangan->no_pks}}">
                           <input type="hidden" id="tgl_pks_hasil{{$i}}"  name="tgl_pks" value="{{$template_pengurangan->tgl_pks}}">
                           <input type="hidden"                           name="jml_mobil" value="{{$count_mobil}}">
                           <input type="hidden"                           name="jml_driver" value="{{$count_driver}}">
                           <input type="hidden" id="nama_pb1_hasil{{$i}}"       name="nama_pb1" value="{{$template_pengurangan->nama_pb1}}">
                           <input type="hidden" id="jabatan_pb1_hasil{{$i}}"    name="jabatan_pb1" value="{{$template_pengurangan->jabatan_pb1}}">
                           <input type="hidden" id="unitkerja_pb1_hasil{{$i}}"  name="unitkerja_pb1" value="{{$template_pengurangan->unitkerja_pb1}}">
                           <input type="hidden" id="nama_pb2_hasil{{$i}}"       name="nama_pb2" value="{{$template_pengurangan->nama_pb2}}">
                           <input type="hidden" id="jabatan_pb2_hasil{{$i}}"    name="jabatan_pb2" value="{{$template_pengurangan->jabatan_pb2}}">
                           <input type="hidden" id="unitkerja_pb2_hasil{{$i}}"  name="unitkerja_pb2" value="{{$template_pengurangan->unitkerja_pb2}}">
                           <input type="hidden" id="vendor_id" value="{{$vendor_id}}">

                           <input type="hidden" name="nopol" value="{{$po->Nopol}}">
                           <input type="hidden" name="template_pengurangan_id" value="{{$template_pengurangan->id}}">
                           @foreach($cabangs as $cabang)
                              @if($cabang->id == $po->Cabang_id)
                                <input type="hidden" name="status_cabang[]" value="{{$cabang->StatusCabang}}">
                                <input type="hidden" name="nama_cabang[]" value="{{$cabang->NamaCabang}}">
                                <input type="hidden" name="kode_cabang[]" value="{{$cabang->KodeCabang}}">
                              @endif
                           @endforeach

                           @foreach($mobils as $mobil)
                              @if($mobil->id == $po->Mobil_id)
                                <input type="hidden" name="mobil_id[]" value="{{$mobil->id}}">
                              @endif
                           @endforeach


                           <tr>
                             @if($po->id == $po_id->id)
                             <td class="bg-success text-white">{{$i}}</td>
                             @else
                             <td>{{$i}}</td>
                             @endif

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
                               <input type="text" class="form-control" name="nopo_pengurangan[]" value="{{$po->Nopo_pengurangan}}" id="example3cols2Input" placeholder="" required>
                             </td>
 -->

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                             <td>
                               <input class="form-control date" type="text" placeholder="mm / dd / yyyy" name="tgl_cutoff[]" value="{{$table_template_pengurangan->tgl_efektif}}" id="example-date-input" autocomplete="off">
                             </td>


                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                            
                               <input type="hidden" name="sewa[]" id="sewa{{$i}}" value="{{$po->Sewa}}">
                               
                             
                             <!-- @if($po->Sewa_sementara == 'Mobil+Driver')
                               <?php $count_driver++; ?>
                               <?php $count_mobil++; ?>
                             @elseif($po->Sewa_sementara == 'Mobil')
                               <?php $count_mobil++; ?>
                             @elseif($po->Sewa_sementara == 'Driver')
                               <?php $count_driver++; ?>
                             @endif -->
                           </tr>

                           @if($po->Tgl_cutoff == '')
                               <input type="hidden" name="sewa_lama[]" value="{{$po->Sewa}}">
                               <input type="hidden" name="nopo_lama[]" value="{{$po->NoPo}}">
                               @else
                                 @if($po->Sewa == 'Mobil+Driver')
                                   @if($po->Pengurangan == 'Driver')
                                     <input type="hidden" name="sewa_sementara[]" value="Mobil">
                                     <input type="hidden" name="sewa_lama[]" value="Mobil">
                                   @elseif($po->Pengurangan == 'Mobil')
                                     <input type="hidden" name="sewa_sementara[]" value="Driver">
                                     <input type="hidden" name="sewa_lama[]" value="Driver">
                                   @else
                                     <input type="hidden" name="sewa_sementara[]" value="null">
                                     <input type="hidden" name="sewa_lama[]" value="null">
                                   @endif
                                 @elseif($po->Sewa == 'Mobil')
                                   @if($po->Pengurangan == 'Mobil')
                                     <input type="hidden" name="sewa_sementara[]" value="null">
                                     <input type="hidden" name="sewa_lama[]" value="null">
                                   @endif
                                 @elseif($po->Sewa == 'Driver')
                                   @if($po->Pengurangan == 'Driver')
                                     <input type="hidden" name="sewa_sementara[]" value="null">
                                     <input type="hidden" name="sewa_lama[]" value="null">
                                   @endif
                                 @endif
                                 <input type="hidden" name="nopo_lama[]" value="{{$po->Nopo_pengurangan}}">
                               @endif
        

                         <?php $jumlah_baris_table += $i ?>
                         @endif
                         @endforeach
                         @endforeach
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
                            <option value="{{ $pejabat->id }}" {{ $pejabat->nama == $template_pengurangan->nama_pb1 ? 'selected' : '' }}>{{$pejabat->nama}} - {{$pejabat->jabatan_id}} - {{$pejabat->unitkerja_id}}</option>
                          @endif
                        @endforeach
                      </select>
                      &nbsp | &nbsp
                      <select class="form-control form-control-sm"  id="pb2" style="width: 300px;display: inline;">
                        <option>Pilih Pejabat 2</option>
                        @foreach($pejabats as $pejabat)
                          @if($pejabat->active != '1')  
                            <option value="{{ $pejabat->id }}" {{ $pejabat->nama == $template_pengurangan->nama_pb2 ? 'selected' : '' }}>{{$pejabat->nama}} - {{$pejabat->jabatan_id}} - {{$pejabat->unitkerja_id}}</option>
                          @endif
                        @endforeach
                      </select>

                      <div><b>PT BANK CENTRAL ASIA, Tbk.</b></div>     
                    
                      <span id="unitkerja_pb1">{{$template_pengurangan->unitkerja_pb1}}</span> &nbsp <span id="unitkerja_pb2">{{$template_pengurangan->unitkerja_pb2}}</span>

                    </p>
                    <br><br><br><br>
                    <div class="row">
                      <div class="col-md-3">
                        <b><span id="nama_pb1">{{$template_pengurangan->nama_pb1}}</span></b> <br>
                        <span id="jabatan_pb1">{{$template_pengurangan->jabatan_pb1}}</span>
                      </div>
                      <div class="col-md-9">
                        <b><span id="nama_pb2">{{$template_pengurangan->nama_pb2}}</span></b> <br>
                        <span id="jabatan_pb2">{{$template_pengurangan->jabatan_pb2}}</span>
                      </div>
                    </div>










                    <!-- ============================================================ -->
                    <!-- Form groups used in grid -->
                    <!-- <div class="row">
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
                                      <input type="text" class="form-control" name="nopo_pengurangan" value="" id="example3cols2Input" placeholder="" required>
                                      
                                    </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group" id="contoh_tambahan">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Jenis Sewa :</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" value="{{$po->Sewa_sementara}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled="">
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group pull-right float-right">
                                  <label class="form-control-label ml-5 mt-3" for="example3cols1Input">Kurangi :</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <select class="form-control" id="sewa" name="sewa">
                                    @if($po->Sewa_sementara == "Mobil+Driver")
                                      <option value="Mobil+Driver">Mobil+Driver</option>
                                      
                                      <option value="Driver">Driver</option>
                                    @elseif($po->Sewa_sementara == "Driver")
                                      <option value="Driver">Driver</option>
                                    @elseif($po->Sewa_sementara == "Mobil")
                                      <option value="Mobil">Mobil</option>
                                    @endif
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cut Off</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <input class="form-control date" type="text" placeholder="mm / dd / yyyy" name="tgl_cutoff" id="example-date-input">
                                </div>
                              </div>

                            </div>
                            
                          </div> -->
                          <!-- <div class="col-md-6" > -->

                            

                          <!-- </div>
                        </div>
                      </div>
                    </div> -->

                    
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                      <div class="form-group float-right pull-right">
                        <a href="{{url('backend/po/table/3')}}" type="button" class="btn btn-default">Back</a>
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






