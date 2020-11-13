
@yield('section')

      <!-- Footer -->
      <!-- <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer> -->
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <!-- <script src="{{asset('dist/argon/vendor/jquery/dist/jquery.min.js')}}"></script> -->
<!--   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->
  <script src="{{asset('dist/argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{asset('dist/argon/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('dist/argon/js/argon.js?v=1.2.0')}}"></script>
  <script src="{{asset('dist/bootstrap4-editable/js/bootstrap-editable.js')}}"></script>
  <!-- Plugin Js -->
  <script src="{{asset('dist/argon/vendor/bootstrap-notify/bootstrap-notify.min.js')}}"></script>


  <script src="{{asset('dist/argon/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
<!--   <script src="{{asset('dist/dropzone/dist/min/dropzone.min.js')}}"></script> -->


  <script src="{{asset('dist/argon/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('dist/sweetalert/dist/sweetalert2.min.js')}}"></script>
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  @include('sweet::alert')

  <script src="{{asset('dist/js/autoNumeric/autoNumeric.js')}}"></script>

  <!--   <script src="{{asset('dist/argon/vendor/jquery/dist/jquery.min.js')}}"></script> -->









  
<script>
  $(function () {

    $(".view_po").click(function(evt){

          var nopolID = $(this).attr("id");

          if(nopolID) {

              $.ajax({

                  url: '/pengadaanmobil/backend/dashboard/po/view_po/'+nopolID,

                  type: "GET",

                  dataType: "json",

                  success:function(data) {

                      $('#harga_driver_ajax_empty').empty();

                      $.each(data, function(key, value) {

                        $('#view_nopo').empty();
                        $('#view_nopo').append(value.NoPo);

                        $('#view_sewa').empty();
                        $('#view_sewa').append(value.Sewa);

                        $('#view_cp').empty();
                        $('#view_cp').append(value.CP);

                        $('#view_nopol').empty();
                        $('#view_nopol').append(value.Nopol);

                        var mobil_id = value.Mobil_id;
                        if(mobil_id) {
                            $.ajax({
                                url: '/pengadaanmobil/backend/dashboard/po/view_po/mobil/'+mobil_id,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $.each(data, function(key, value) {

                                      $('#view_mobil').empty();
                                      $('#view_mobil').append(value.MerekMobil+" "+value.Type+" - "+value.Tahun);
                        
                                    });
                                }
                            });
                        }

                        var vendor_id = value.Vendor_Driver;
                        if(vendor_id) {
                            $.ajax({
                                url: '/pengadaanmobil/backend/dashboard/po/view_po/vendor/'+vendor_id,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $.each(data, function(key, value) {

                                      $('#view_vendor').empty();
                                      $('#view_vendor').append(value.KodeVendor+" ("+value.NamaVendor+")");
                        
                                    });
                                }
                            });
                        }

                        var cabang_id = value.Cabang_id;
                        if(cabang_id) {
                            $.ajax({
                                url: '/pengadaanmobil/backend/dashboard/po/view_po/cabang/'+cabang_id,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $.each(data, function(key, value) {

                                      $('#view_cabang').empty();
                                      $('#view_cabang').append(value.KodeCabang+" - "+value.NamaCabang+" - "+value.InisialCabang+" - "+value.CabangUtama+" - "+value.StatusCabang+" - "+value.Kota+" - "+value.KWL);
                        
                                    });
                                }
                            });
                        }

                        var driver_id = value.Driver_id;
                        if(driver_id) {
                            $.ajax({
                                url: '/pengadaanmobil/backend/dashboard/po/view_po/driver/'+driver_id,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $.each(data, function(key, value) {

                                      $('#view_driver').empty();
                                      $('#view_driver').append(value.nik+" - "+value.NamaDriver);
                        
                                    });
                                }
                            });
                        }

                        // const dateTime = value.MulaiSewa;
                        // const parts = dateTime.split(/[- T]/);
                        // const mulaisewa = `${parts[1]}/${parts[2]}/${parts[0]} `;

                        $('#view_mulaisewa').empty();
                        if (value.MulaiSewa != null) {
                        var date    = new Date(value.MulaiSewa),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            mulaisewa = day + '-' + month + '-' + yr;
                            $('#view_mulaisewa').append(mulaisewa);

                            if (value.MulaiSewa2 != null) {
                            var date    = new Date(value.MulaiSewa2),
                                yr      = date.getFullYear(),
                                month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                mulaisewa2 = day + '-' + month + '-' + yr;
                                $('#view_mulaisewa').append(' | '+mulaisewa2);
                            }

                        }
                        

                        $('#view_tgl_bastk').empty();
                        if (value.Tgl_bastk != null) {
                        var date    = new Date(value.Tgl_bastk),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            Tgl_bastk = day + '-' + month + '-' + yr;
                            $('#view_tgl_bastk').append(Tgl_bastk);
                        }

                        $('#view_tgl_bastd').empty();
                        if (value.Tgl_bastd != null) {
                          var date    = new Date(value.Tgl_bastd),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            Tgl_bastd = day + '-' + month + '-' + yr;
                            $('#view_tgl_bastd').append(Tgl_bastd);
                        }


                        $('#view_tgl_relokasi').empty();
                        if (value.Tgl_relokasi != null) {
                          var date    = new Date(value.Tgl_relokasi),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            Tgl_relokasi = day + '-' + month + '-' + yr;
                            $('#view_tgl_relokasi').append(Tgl_relokasi);
                        }

                        $('#view_tgl_cutoff').empty();
                        if (value.Tgl_cutoff != null) {
                          var date    = new Date(value.Tgl_cutoff),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            Tgl_cutoff = day + '-' + month + '-' + yr;
                            $('#view_tgl_cutoff').append(Tgl_cutoff);
                        }


                        $('#view_selesaisewa').empty();
                        if (value.SelesaiSewa != null) {
                        var date    = new Date(value.SelesaiSewa),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            selesaisewa = day + '-' + month + '-' + yr;
                            $('#view_selesaisewa').append(selesaisewa);
                        }

                        $('#view_selesaisewa').empty();
                        $('#view_selesaisewa').append(selesaisewa);

                        $('#view_userpengguna').empty();
                        $('#view_userpengguna').append(value.UserPengguna);

                        $('#view_noregister').empty();
                        $('#view_noregister').append(value.NoRegister);

                        $('#view_HSM').empty();
                        var x1 = value.HargaSewaMobil;
                        var hasil1 = x1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        $('#view_HSM').append("Rp "+hasil1);

                        $('#view_HSD').empty();
                        var x2 = value.HargaSewaDriver2019;
                        var hasil2 = x2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        $('#view_HSD').append("Rp "+hasil2);

                        $('#view_HSMD').empty();
                        var x3 = parseInt(x1) + parseInt(x2);
                        var hasil3 = x3.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        $('#view_HSMD').append("Rp "+hasil3);
                        
                        
                        // const dateTime1 = value.SelesaiSewa;
                        // const parts1 = dateTime1.split(/[- T]/);
                        // const selesaisewa = `${parts1[1]}/${parts1[2]}/${parts1[0]} `;


                        // if (value.CP == 'D') {
                        //   $('#CPD').val('D').change();
                        // }else{
                        //   $('#CPD').val('CP').change();
                        //   $('#CP').val(value.CP).change();
                        // }

                        // $('#vendor').val(value.Vendor_Driver).change();

                        // $('#cabang').val(value.Cabang_id).change();

                        // $('#type').val(value.Mobil_id).change();

                        // // $('#mulaisewa').val(mulaisewa);

                        // $('#selesaisewa').val(selesaisewa);

                        // var hasil = value.HargaSewaMobil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                        // $('#harga_mobil_disabled').val(hasil);

                        // $('#harga_driver').val(value.HargaSewaDriver2019);

                        // $('#bbm').val(value.bbm);

                        // $('#jenis_bbm').val(value.jenis_bbm).change();

                        // // $('#nopo').val(value.NoPo);

                        // $('#id_po').val(value.id);


                      });


                  }

              });

          }
    });

     // var baris = <?php  $i ?> + 1;
     var baris = 1500;
     // alert(baris);
     
         var names = <?php echo json_encode($page); ?>;
         var name = names.toLowerCase();
     

    for (i = 0; i < baris; i++) {
      $('#customCheck'+i).change(function(){
          if($(this).prop('checked')){
            $('.delete_checkbox'+$(this).val()).append('<input type="hidden" id="no_pks_hasil'+$(this).val()+'"  name="'+name+'[]" value="'+$(this).val()+'" >');
          }
          else{
            $('.delete_checkbox'+$(this).val()).empty();
          }
      });
    } 
    
    $(".checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      for (i = 0; i < baris; i++) {
              if($(this).prop('checked')){
                $('.delete_checkbox'+$('#customCheck'+i).val()).empty();
                $('.delete_checkbox'+$('#customCheck'+i).val()).append('<input type="hidden" id="no_pks_hasil'+$('#customCheck'+i).val()+'"  name="'+name+'[]" value="'+$('#customCheck'+i).val()+'" >');
              }
              else{
                $('.delete_checkbox'+$('#customCheck'+i).val()).empty();
              }
        }
    });

    $(".check").click(function () {
        $("input:checkbox").prop('checked',true);
        for (i = 0; i < baris; i++) {
            $('.delete_checkbox'+$('#customCheck'+i).val()).empty();
            $('.delete_checkbox'+$('#customCheck'+i).val()).append('<input type="hidden" id="no_pks_hasil'+$('#customCheck'+i).val()+'"  name="'+name+'[]" value="'+$('#customCheck'+i).val()+'" >');
          }
    });

    $(".uncheck").click(function () {
        $("input:checkbox").prop('checked',false);
        for (i = 0; i < baris; i++) {
            $('.delete_checkbox'+$('#customCheck'+i).val()).empty();
          }
    });

    // $(".checkAll").change(function () {
    //     $("input:checkbox").prop('checked', $(this).prop("checked"));
    // });

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~



    // Initialization
    $('.date').datepicker(
      { dateFormat: 'mm-dd-yy' }
      ).val();

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    
      

    // //Datemask dd/mm/yyyy
    // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    // //Datemask2 mm/dd/yyyy
    // $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    // //Money Euro
    // $('[data-mask]').inputmask()

    // //Date range picker
    // $('#reservation').daterangepicker()
    // //Date range picker with time picker
    // $('#reservationtime').daterangepicker({
    //   timePicker: true,
    //   timePickerIncrement: 30,
    //   locale: {
    //     format: 'MM/DD/YYYY hh:mm A'
    //   }
    // })
    // //Date range as a button
    // $('#daterange-btn').daterangepicker(
    //   {
    //     ranges   : {
    //       'Today'       : [moment(), moment()],
    //       'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //       'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    //       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //       'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    //       'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     },
    //     startDate: moment().subtract(29, 'days'),
    //     endDate  : moment()
    //   },
    //   function (start, end) {
    //     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //   }
    // )

    // //Timepicker
    // $('#timepicker').datetimepicker({
    //   format: 'LT'
    // })
    
    // //Bootstrap Duallistbox
    // $('.duallistbox').bootstrapDualListbox()

    // //Colorpicker
    // $('.my-colorpicker1').colorpicker()
    // //color picker with addon
    // $('.my-colorpicker2').colorpicker()

    // $('.my-colorpicker2').on('colorpickerChange', function(event) {
    //   $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    // });

    // $("input[data-bootstrap-switch]").each(function(){
    //   $(this).bootstrapSwitch('state', $(this).prop('checked'));
    // });

    $('[data-toggle="tooltip"]').tooltip();



  });

    // $(document).ready(function() {
    //     $('.tglpo').editable({
    //     });
    //     $('.po_tgl').editable({
    //         format: 'dd-MM-yyyy',    
    //         viewformat: 'dd-MM-yyyy',    
    //         datepicker: {
    //                 weekStart: 1
    //            }
    //         });
    //     $('.driver').editable({
    //     });
    //     $('.mobil').editable({
    //     });
    //     $('.pkwt').editable({
    //     });
    //     $('.driver_pkwt').editable({
    //         format: 'dd-MM-yyyy',    
    //         viewformat: 'dd-MM-yyyy',    
    //         datepicker: {
    //                 weekStart: 1
    //            }
    //         });
    //     $('.service').editable({
    //     });
    //     $('.mcu').editable({
    //     });
    //     $('.ump').editable({
    //     });
    //     $('.user').editable({
    //     });
    //     $('.kota').editable({
    //     });
    //     $('.jkk').editable({
    //     });
    //     $('.user_status').editable({
    //       value: 'pengadaan',    
    //       source: [
    //             {value: 'pengadaan', text: 'pengadaan'},
    //             {value: 'penyedia', text: 'penyedia'},
    //             {value: 'admin', text: 'admin'}
    //          ]
    //     });
    // });

    $(document).ready(function() {
      
        // $('.mydatatable').DataTable({
        //   "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // // scrollY:        '100%',
        // // scrollCollapse: true,
        // // responsive: true,
        //  order: false,
        //  columnDefs: [{
        //      targets: "_all",
        //      orderable: false
        //  }],
        //     language: {
        //        paginate: {
        //        next: '<i class="fas fa-angle-right">',
        //        previous: '<i class="fas fa-angle-left">'  
        //         }
        //      }
        // });

        $('.mydatatable thead td').each( function () {
            var title = $('.mydatatable thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="'+title+'" style="min-width:100px" />' );
            // $(this).html( '<input type="text" placeholder="" style="width:100%" />' );
        } );
        
        // DataTable
        var table = $('.mydatatable').DataTable( {
              // "lengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "All"]],
                "lengthMenu": [[10, 25, 50, 75,100,150,300,500,1000], [10, 25, 50, 75,100,150,300,500, 1000]],
            // scrollY:        '100%',
            // scrollCollapse: true,
            // responsive: true,
            // select: true,
             // order: false,
             columnDefs: [{
                 targets: -1,
                 orderable: false
             }],
                language: {
                   paginate: {
                   next: '<i class="fas fa-angle-right">',
                   previous: '<i class="fas fa-angle-left">'  
                    }
                 }
        } );
          
        // Apply the filter
        $(".mydatatable thead input[type='text']").on( 'keyup', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        });

        $(".mydatatable thead select").on( 'change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                // .search( this.value )
                .search( this.value ? '^'+this.value+'$' : '', true, false)
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });

        $("#status_active").on( 'change', function () {
            table
                .column( 12 )
                .search( this.value ? '^'+this.value+'$' : '', true, false)
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });

        $(".vendor").on( 'change', function () {
            table
                .column( 1 )
                .search( this.value ? '^'+this.value+'$' : '', true, false)
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });

        $("#all_nopo").on( 'change', function () {
            table
                .column( 1 )
                .search( this.value ? '^'+this.value+'$' : '', true, false)
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });


        // $("#checkAll").change(function () {
        //     table
        //         .draw();
        // });

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // $(".checkAll").change(function () {
        //     $("input:checkbox").prop('checked', $(this).prop("checked"));
        // });

        // $(".checkAll").change(function () {
        //     var rows = table.rows({ 'search': 'applied' }).nodes();
        //    if($('input:checked', rows).length == rows.length){
        //      $('input[type="checkbox"]', rows).prop('checked', false);
        //     }else{
        //      $(".checkAll").prop('checked', true);
        //      $('input[type="checkbox"]', rows).prop('checked', true);
        //    }

        //    for (i = 1; i < rows.length; i++) {
        //          if($(this).prop('checked')){
        //           $('.delete_checkbox'+$('#customCheck'+i).val()).empty();
        //            $('.delete_checkbox'+$('#customCheck'+i).val()).append('<input type="text" id="no_pks_hasil'+$('#customCheck'+i).val()+'"  name="cabang[]" value="'+$('#customCheck'+i).val()+'" >');
        //          }
        //          else{
        //            $('.delete_checkbox'+$('#customCheck'+i).val()).empty();
        //          }
        //    }


        //   // $("body").on("change","input",function() {

        //   //     var rows = table.rows({ 'search': 'applied' }).nodes();

        //   // });

        // });


        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


        $('.date_min, .date_max').change( function() {
                table.draw();
        });

        // $('.status').change( function() {
        //         table.draw();
        // });
   
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = Date.parse( $('.date_min').val(), 10 );
                var max = Date.parse( $('.date_max').val(), 10 );
                var age = Date.parse( data[13] ) || 0; // use data for the age column
         
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }
        );

        // $.fn.dataTable.ext.search.push(
        //     function( settings, data, dataIndex ) {
        //         var status = $('.status').val();
        //         var filter = data[12] || 0; // use data for the age column
         
        //         if ( status == filter)
        //         {
        //             return true;
        //         }
        //         return false;
        //     }
        // );

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


        $('.myTable').DataTable({
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
               paginate: {
               next: '<i class="fas fa-angle-right">',
               previous: '<i class="fas fa-angle-left">'  
                }
             }
        });

      });
      
    
</script>

<script type="text/javascript">

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    // $('#vendor').on('change', function(e) {

    //           e.preventDefault();

    //           var kota = $('#cabang').val();

    //           var vendor = $(this).val();

    //           $.ajax({

    //                type:'POST',

    //                url:'{{ route('kota_ajax') }}',

    //                dataType:"json",

    //                data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

    //                success:function(data){

    //                   $('#harga_driver_ajax_empty').empty();

    //                     $.each(data, function(key, value) {


    //                       $('#harga_driver').val(value.Harga_include);


    //                     });

    //                }

    //           });

    //     });

    $('#cabang').on('change', function(e) {

                    e.preventDefault();

                    var kota = $(this).val();

                    var vendor = $('#vendor').val();

                    $.ajax({

                         type:'POST',

                         url:'{{ route('kota_ajax') }}',

                         dataType:"json",

                         data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

                         success:function(data){

                            $('#harga_driver_ajax_empty').empty();

                              $('#harga_driver_hidden').val('0');
                                $('#harga_driver').val('0');
                                $('#harga_driver_eksclude_disabled').val('0');

                              $.each(data, function(key, value) {

                                // $('#harga_driver').val(value.Harga_include);

                                $('#harga_driver_hidden').val(value.Harga_include);
                                var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                $('#harga_driver').val(hasil);
                                
                                var hasil_eksclude = value.Harga_eksclude.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                $('#harga_driver_eksclude_disabled').val(hasil_eksclude);


                              });

                         }

                    });

              });

    $('#vendor').on('change', function(e) {

                    e.preventDefault();

                    var kota = $('#cabang').val();

                    var vendor = $(this).val();

                    $.ajax({

                         type:'POST',

                         url:'{{ route('kota_ajax') }}',

                         dataType:"json",

                         data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

                         success:function(data){

                            $('#harga_driver_ajax_empty').empty();

                              $('#harga_driver_hidden').val('0');
                                $('#harga_driver').val('0');
                                $('#harga_driver_eksclude_disabled').val('0');

                              $.each(data, function(key, value) {

                                // $('#harga_driver').val(value.Harga_include);

                                $('#harga_driver_hidden').val(value.Harga_include);
                                var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                $('#harga_driver').val(hasil);
                                
                                var hasil_eksclude = value.Harga_eksclude.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                $('#harga_driver_eksclude_disabled').val(hasil_eksclude);


                              });

                         }

                    });

              });





</script>



<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    $(document).ready(function() {
      
      
        // $('#cabang').on('change', function() {

        //   var stateID = $(this).val();

        //   $('#vendor').on('change', function() {

        //     var vendorID = $(this).val();

        //     if(stateID) {

        //         $.ajax({

        //             url: '/backend/kota/ajax/'+stateID+'/'+vendorID,

        //             type: "GET",

        //             dataType: "json",

        //             success:function(data) {


        //                 $('#harga_driver_ajax_empty').empty();

        //                 $.each(data, function(key, value) {


        //                   $('#harga_driver').val(value.Harga_include);


        //                 });


        //             }

        //         });

        //     }else{

        //         $('#harga_driver_ajax').empty();

        //     }

        //   });

        // });



        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        

          


    });
</script>


</body>


</html>

