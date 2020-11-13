<?php 
$page = "Relokasi"; 
$name = "relokasi"; 
?>
@extends('sidebar')

@section('content')

<?php 
date_default_timezone_set('Asia/Jakarta');
$currentDateTime = date('Y-m-d H:i:s');
$currentDate = date('m/d/Y');
?>


<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-5 col-5 text-right">
              
              <!-- <a href="/backend/po/form_add" class="btn btn-success float-right pull-right" ><i class="fas fa-plus"></i> Add <?php echo $page ?></a> -->
                <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                  <!-- <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true" style="font-size: 11px">Single Relokasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false" style="font-size: 11px">Multiple Relokasi</a>
                  </li> -->
                  <li class="nav-item text-right">
                    <a href="{{url('/backend/po/table')}}" type="button" class="btn btn-default">Back</a>
                  </li>
                </ul>
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
      @include('PO.tampungan.tampungan_relokasi')
      

      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card pb-4 pt--8">
              <div class="card-header border-0">
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-file"></li> &nbspList of PO </h3>
              </div>
              <div class="tab-content" id="myTabContent">


                <div class="tab-pane fade show active " id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  <form action="{{url('/backend/po/form_relokasi')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="table-responsive">
                      <!-- <p><label><input type="checkbox" class="checkAll" id="checkAll"/> Check all</label></p> -->
                      <table class="table  align-items-center table-flush table-hover text-center  yajra-datatable"style="width: 100%">
                        <thead class="">
                          <tr>
                            <th scope="col" rowspan="2" style="min-width: 5%"><b>No</b></th>
                            <th scope="col" rowspan="2" style="min-width: 5%"><b>ID</b></th>
                            <th scope="col" colspan="3" style="min-width: 25%" class="bg-info text-white"><b>Cabang</b></th>             
                            <th scope="col" rowspan="2" style="min-width: 10%"><b>Sewa</b></th>   
                            <th scope="col" rowspan="2" style="min-width: 20%"><b>No.Pol</b></th>  
                            <th scope="col" class="bg-primary text-white" rowspan="2" style="min-width: 10%"><b>Vendor</b></th>
                            <th scope="col" rowspan="2" style="min-width: 10%"><b>Action</b></th>
                          </tr>
                          <tr>
                            <th scope="col" class="bg-info text-white"><b>No PO</b></th>
                            <th scope="col" class="bg-info text-white"><b>Cabang</b></th>
                            <th scope="col" class="bg-info text-white"><b>Kota</b></th>
                          </tr>
                        </thead>
                        <!-- <thead>
                            <tr>
                                <th><input type="text" class="form-control form-control-sm" placeholder="No" style="min-width:10px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="ID" style="min-width:10px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="No Po" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="cabang" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="kota" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="sewa" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm nopol" placeholder="No.polisi" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="Vendor" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" disabled style="min-width:100px" /></th>
                            </tr>
                        </thead> -->
                        <tbody>
                            
                        </tbody>
                      </table>
                      <?php $i = 1; ?>
                      @foreach(App\tpo::all()->sortBy('id') as $po)
                          @if($po->status == '1')
                            <div class="delete_checkbox{{$po->id}}"></div> 
                            <?php $i = $po->id; ?>                    
                          @endif
                      @endforeach
                    </div>
                  </form>
                </div>
              </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
    </div>



<script>

      $(function () {
        
        var table = $('.yajra-datatable').DataTable({
           // "lengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            processing: true,
            serverSide: true,
            printable: true,
            "ordering": false,
            language: {
                   paginate: {
                   next: '<i class="fas fa-angle-right">',
                   previous: '<i class="fas fa-angle-left">'  
                    }
                 },
            ajax: {

              url: "{{ route('json_po_relokasi') }}",

            },

            columns:[
                {data:'DT_RowIndex', name:'DT_RowIndex', searchable:false},
                {data:'id', name:'id', searchable:false},
                {data:'NoPo', name:'NoPo'},
                {data:'Cabang_id',  name:'cabang.NamaCabang'},
                {data:'Kota', name:'cabang.Kota'},
                {data:'Sewa', name:'Sewa'},
                {data:'Nopol',  name:'Nopol'},
                {data:'Vendor_Driver',  name:'vendor.KodeVendor'},
                {data:'select',  name:'select'},
                // {
                //   name: null,
                //         data: null,
                //         sortable: false,
                //         searchable: false,
                //         render: function (data, row) {
                //             var actions = '';
                //             // actions += '<div class="custom-control custom-checkbox yoi"><input type="checkbox" name="relokasi[]" class="custom-control-input" id="customCheck:id" value="'+data.id+'"><label class="custom-control-label" for="customCheck:id"></label></div>';
                //             actions += '<a class="btn btn-info btn-sm" href="/pengadaanmobil/backend/po/relokasi/tampungan/'+data.id+'"><i class="fas fa-file-upload"></i> &nbspSelect</a>'
                //             return actions.replace(/:id/g, data.DT_RowIndex)
                //         }
                // }


            ],

        });

        

        $('.yajra-datatable thead td').each( function () {
            var title = $('.yajra-datatable thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control form-control-sm" placeholder=" '+title+'" style="min-width:100px" />' );
            // $(this).html( '<input type="text" placeholder="" style="width:100%" />' );
        } );

        // Apply the filter
        $(".yajra-datatable thead input[type='text']").on( 'keyup', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        });

        $(".yajra-datatable thead select").on( 'change', function () {
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
                .search( this.value )
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });


        
      });

</script>

@include('PO.add');

@endsection






