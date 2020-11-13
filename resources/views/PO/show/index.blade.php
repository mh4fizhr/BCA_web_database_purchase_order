<!DOCTYPE html>
<?php
    $currentDateTime = date('Y-m-d H:i:s');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="{{asset('dist/argon/css/argon.css?v=1.2.0')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/dist/showpdf/style.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{asset('dist/argon/img/BCA-logo.png')}}">
      </div>
      <h1>PURCHASE ORDER</h1>
      












      <div class="row">
        <div class="col-md-4">
          <div id="project">

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>No PO</span>
              </div>
              <div class="col-md-7">
                <span>: {{$po->Nopo_permanent}}</span>
              </div>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>Jenis Sewa</span>
              </div>
              <div class="col-md-7"><span class="text-left">: 
                @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                 {{$po->Sewa_sementara}}
                @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara == 'null')
                  {{$po->Sewa}} ( Cutoff )
                @else
                  {{$po->Sewa}}
                @endif
                </span>
              </div>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>Merek & Type</span>
              </div>
              <div class="col-md-7"><span class="text-left">:
                @if(!isset($po->Mobil_id))

                  Tanpa Unit 
                
                @else

                @foreach($mobils as $mobil)
                  @if($po->Mobil_id == $mobil->id)
                    {{$mobil->MerekMobil}} {{$mobil->Type}} 

                    
                    <?php $tanggal_sekarang = date('m/d/Y');?>
                    
                    <?php $tgl_efektif = '' ?>
                    @foreach($historymobils2 as $historymobil)
                      @if($po->Mobil_id == $historymobil->mobil_id)
                        <?php $tgl_efektif = $historymobil->tgl_efektif ?> <!-- date('d-M-Y', strtotime($historymobil->tgl_efektif)) -->
                      @endif
                    @endforeach
                    @if($tgl_efektif == '')
                    @elseif($tgl_efektif >= $tanggal_sekarang)
                       Efektif : {{date('d-M-Y', strtotime($tgl_efektif))}}
                    @else
                    @endif
                  @endif
                @endforeach
                
                @endif
              </span>
              </div>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>Nopol</span>
              </div>
              <div class="col-md-7">
                <span class="text-left">:
                @if($po->Nopol == 'null' || $po->Nopol == '')
                  Tanpa Unit
                @else
                  {{$po->Nopol}}
                @endif
              </span>
              </div>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>Driver</span>
              </div>
              <div class="col-md-7"><span class="text-left">:
                @if($po->Driver_id == '')
                    <?php $driver_po = '-' ?>
                @else
                  @foreach($drivers as $driver)
                    @if($po->Driver_id == $driver->id)
                      <?php $driver_po = $driver->NamaDriver ?>
                    @endif
                  @endforeach
                @endif
                {{$driver_po}}
              </span>
              </div>
            </div>
            
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>CP/D</span>
              </div>
              <div class="col-md-7"><span class="text-left">:
                @if($po->CP == 'D')
                D - Dedicated
                @else
                {{$po->CP}}
                @endif
              </span>
              </div>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="row">
              <div class="col-md-5">
                <span>Tahun</span>
              </div>
              <div class="col-md-7"><span class="text-left">:
                @foreach($mobils as $mobil)
                  @if($po->Mobil_id == $mobil->id)
                    {{ date('Y', strtotime($mobil->updated_at))}}
                  @endif
                @endforeach 
                </span>
              </div>
            </div>

          
          </div>
        </div>

        <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

        <div class="col-md-4"></div>

        <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

        <div class="col-md-4">

          <div id="project" class="row">
            <div class="col-md-6">
              <span>Cabang</span>
            </div>
            <div class="col-md-6">: 
              @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')

                  @foreach($cabangs as $cabang)
                    @if($po->Cabang_relokasi == $cabang->id)
                    <span class="text-left" data-toggle="tooltip" data-placement="top" title="Click to detail">
                      {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                    </span>
                    @endif
                  @endforeach

                @else

                  @foreach($cabangs as $cabang)
                    @if($po->Cabang_id == $cabang->id)
                    <span class="text-left" data-toggle="tooltip" data-placement="top" title="Click to detail">
                      {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                    </span>
                    @endif
                  @endforeach

                @endif
            </div>
          </div>

          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

          <div id="project" class="row">
            <div class="col-md-6">
              <span>kota</span>
            </div>
            <div class="col-md-6">: 
              @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')

                  @foreach($cabangs as $cabang)
                    @if($po->Cabang_relokasi == $cabang->id)
                    <span class="text-left" data-toggle="tooltip" data-placement="top" title="Click to detail">
                      {{$cabang->Kota}}
                    </span>

                    <?php $kota_ump = $cabang->Kota ?>

                    @endif
                  @endforeach

                @else

                  @foreach($cabangs as $cabang)
                    @if($po->Cabang_id == $cabang->id)
                    <span class="text-left" data-toggle="tooltip" data-placement="top" title="Click to detail">
                      {{$cabang->Kota}}
                    </span>

                    <?php $kota_ump = $cabang->Kota ?>

                    @endif
                  @endforeach

                @endif
            </div>
          </div>

          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->    

          <div id="project" class="row">
            <div class="col-md-6">
              <span>vendor</span>
            </div>
            <div class="col-md-6">: <span class="text-left">
              @foreach($vendors as $vendor)
                @if($po->Vendor_Driver == $vendor->id)
                  {{$vendor->NamaVendor}}
                  <?php $vendor_ump = $vendor->NamaVendor; ?>
                @endif
              @endforeach
              </span>
            </div>
          </div>

          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

          <div id="project" class="row">
            <div class="col-md-6">
              <span>status</span>
            </div>
            <div class="col-md-6">: 
              @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '')
                  @if($po->Sewa_sementara == 'null' || $po->SelesaiSewa <= $currentDateTime)
                    <span class="badge badge-sm text-left badge-danger">Not Active</span>
                  @else
                    <span class="badge badge-sm text-left badge-success">Active</span>
                  @endif
                @elseif($po->SelesaiSewa <= $currentDateTime)
                  <span class="badge badge-sm text-left badge-danger">Not Active</span>
                @else
                  <span class="badge badge-sm text-left badge-success">Active</span>
                @endif
            </div>
          </div>

          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

          <div id="project" class="row">
            <div class="col-md-6">
              <span>no register</span>
            </div>
            <div class="col-md-6">: 
              <span class="text-left">{{$po->NoRegister}}</span>
            </div>
          </div>
        </div>
      </div>
      
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="">Mulai Sewa</th>
            <th class="">Tgl bastk</th>
            <th>Tgl bastd</th>
            <th>Tgl relokasi Y</th>
            <th>Tgl cut off</th>
            <th>Selesai sewa</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              @if($po->MulaiSewa != '')
                {{ date('d-M-Y', strtotime($po->MulaiSewa))}}
              @else
              @endif
            </td>
            <td>
              @if($po->Tgl_bastk != '')
                {{ date('d-M-Y', strtotime($po->Tgl_bastk))}}
              @else
                
              @endif
            </td>
            <td class="">
              @if($po->Tgl_bastd != '')
                {{ date('d-M-Y', strtotime($po->Tgl_bastd))}}
              @else
                
              @endif
            </td>
            <td class="">
              @if($po->Efisien_relokasi != '')
                {{ date('d-M-Y', strtotime($po->Efisien_relokasi))}}
              @else
                
              @endif
            </td>
            <td class="">
              @if($po->Tgl_cutoff != '')
                {{ date('d-M-Y', strtotime($po->Tgl_cutoff))}}
              @else
                
              @endif
            </td>
            <td>
              @if($po->SelesaiSewa != '')
                {{ date('d-M-Y', strtotime($po->SelesaiSewa))}}
              @else
                
              @endif
            </td>
          </tr>
          
          
        </tbody>
      </table>





      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
          <table>
            <thead>
              <tr>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-left">Harga sewa mobil</td>
                <td class="total text-left">
                  @if($po->Sewa_sementara == 'Mobil+Driver' || $po->Sewa_sementara == 'Mobil')
                    @if($po->Efisien_relokasi <= $currentDateTime)
                      @currency($po->Hargasewamobil_pengurangan)</a>
                      <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                    @else
                      @currency($po->HargaSewaMobil)</a>
                      <?php $harga_mobil = $po->HargaSewaMobil ?>
                    @endif
                  @elseif($po->Sewa_sementara == 'null' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                    @if($po->Efisien_relokasi <= $currentDateTime)
                      @currency($po->Hargasewamobil_pengurangan)</a>
                      <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                    @else
                      @currency($po->HargaSewaMobil)</a>
                      <?php $harga_mobil = $po->HargaSewaMobil ?>
                    @endif
                  @elseif($po->Sewa_sementara == 'Driver' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                    @if($po->Efisien_relokasi <= $currentDateTime)
                      @currency($po->Hargasewamobil_pengurangan)</a>
                      <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                    @else
                      @currency($po->HargaSewaMobil)</a>
                      <?php $harga_mobil = $po->HargaSewaMobil ?>
                    @endif
                  @else
                    @if($po->Efisien_relokasi <= $currentDateTime)
                      @currency($po->Hargasewamobil_pengurangan)</a>
                      <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                    @else
                      @currency($po->HargaSewaMobil)</a>
                      <?php $harga_mobil = $po->HargaSewaMobil ?>
                    @endif
                    <span class="text-danger">(CUT OFF)</span>
                  @endif
                </td>
              </tr>
              <tr>
                <td class="text-left">Harga Sewa Driver (include)</td>
                <td class="total text-left">
                  @if($po->Sewa_sementara == 'Mobil+Driver' || $po->Sewa_sementara == 'Driver')
                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '')
                      @currency($po->Hargasewadriver_relokasi)</a>
                      <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                    @else
                      @currency($po->HargaSewaDriver2019)</a>
                      <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                    @endif
                  @elseif($po->Sewa_sementara == 'null' && $po->Sewa == 'Mobil' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                    @currency(0)
                    <?php $harga_driver = 0;  ?>
                  @elseif($po->Sewa_sementara == 'null' && $po->Sewa == 'Driver' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                      @currency($po->Hargasewadriver_relokasi)</a>
                      <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                    @else
                      @currency($po->HargaSewaDriver2019)</a>
                      <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                    @endif
                  @elseif($po->Sewa_sementara == 'null' && $po->Sewa == 'Mobil+Driver' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                      @currency($po->Hargasewadriver_relokasi)</a>
                      <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                    @else
                      @currency($po->HargaSewaDriver2019)</a>
                      <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                    @endif
                  @elseif($po->Sewa_sementara == 'Mobil' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                      @currency($po->Hargasewadriver_relokasi)</a>
                      <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                    @else
                      @currency($po->HargaSewaDriver2019)</a>
                      <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                    @endif
                  @else
                    
                    
                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                      @currency($po->Hargasewadriver_relokasi)</a>
                      <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                    @else
                      @currency($po->HargaSewaDriver2019)</a>
                      <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                    @endif
                    <span class="text-danger">(CUT OFF)</span>
                  @endif
                </td>
              </tr>

              <tr>
                <td class="text-left">Harga Sewa Driver (ekslude)</td>
                <td class="total text-left">
                  @if($po->Sewa_sementara == 'Mobil+Driver' || $po->Sewa_sementara == 'Driver')
                    @foreach($harga_umps as $harga_ump)
                      @if($harga_ump->Kota_id == $kota_ump && $harga_ump->Vendor_id == $vendor_ump && $harga_ump->activated == 1)
                        @currency($harga_ump->Harga_eksclude)
                      @endif
                    @endforeach
                  @elseif($harga_driver == 0)
                    @currency(0)
                  @else
                    @foreach($harga_umps as $harga_ump)
                      @if($harga_ump->Kota_id == $kota_ump && $harga_ump->Vendor_id == $vendor_ump && $harga_ump->activated == 1)
                        @currency($harga_ump->Harga_eksclude) <span class="text-danger">(CUT OFF)</span>
                      @endif
                    @endforeach
                  @endif
                </td>
              </tr>

              <tr style="background-color: #ffff00">
                <td class="text-left">Harga Sewa Mobil + Driver (include)</td>
                <td class="total text-left">
                  <?php $hsmd = $harga_mobil + $harga_driver ?>
                  @currency($hsmd)
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      


      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        <a href="javascript:history.back()" class="btn btn-primary float-right">Back</a>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>

