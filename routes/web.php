<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_dashboard'])->name('home');

// ______________________________________ DASHBOARD _________________________________________
Route::get('/backend/dashboard',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_dashboard']);
Route::post('/backend/dashboard', 'PengadaanmobilController@filter_dashboard2');
Route::get('/backend/dashboard/date/{date}', 'PengadaanmobilController@date_dashboard');
Route::get('/backend/dashboard/po/view_po/{id}', 'PengadaanmobilController@view_dashboard');
Route::get('/backend/dashboard/po/view_po/vendor/{id}', 'PengadaanmobilController@view_vendor_dashboard');
Route::get('/backend/dashboard/po/view_po/cabang/{id}', 'PengadaanmobilController@view_cabang_dashboard');
Route::get('/backend/dashboard/po/view_po/mobil/{id}', 'PengadaanmobilController@view_mobil_dashboard');

// ______________________________________ PO _________________________________________________
Route::get('/backend/po',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_po']);
Route::get('/backend/po/table',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_po_table']);
Route::get('/backend/po/table/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_po_table_kategori']);
Route::post('/backend/po/create', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_po']);
Route::post('/backend/po/create/multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_po_multiple']);
Route::get('/backend/po/show/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_po']);
Route::get('/backend/po/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_po']);
Route::get('/backend/po/delete_all_excel', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_po_all_excel']);
Route::get('/backend/po/delete/driver_eksisting/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_delete_driver_eksisting']);

Route::get('/backend/po/form_add',['middleware' => 'auth','uses' => 'PengadaanmobilController@form_add_po']);
Route::get('/backend/po/form_add_multiple',['middleware' => 'auth','uses' => 'PengadaanmobilController@form_add_multiple_po']);

Route::get('/backend/po/penambahan',['middleware' => 'auth','uses' => 'PengadaanmobilController@penambahan_po']);
Route::get('/backend/po/form_penambahan',['middleware' => 'auth','uses' => 'PengadaanmobilController@form_penambahan_po']);

Route::get('/backend/po/perpanjang/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@perpanjang']);
Route::post('/backend/po/perpanjang/proses/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@perpanjang_proses']);

// ______________________________PENGURANGAN____ _____________________________
Route::get('/backend/po/pengurangan',['middleware' => 'auth','uses' => 'PenguranganController@pengurangan_po']);
Route::get('/backend/po/pengurangan_damira',['middleware' => 'auth','uses' => 'PenguranganController@pengurangan_po_damira']);
Route::get('/backend/po/form_pengurangan/{id}',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_po']);
Route::get('/backend/po/form_pengurangan_damira/{id}',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_po_damira']);
Route::post('/backend/po/form_pengurangan_multiple',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_multiple_po']);
Route::post('/backend/po/edit_pengurangan/multiple/{id}', ['middleware' => 'auth','uses' => 'PenguranganController@po_edit_pengurangan_multiple']);
Route::post('/backend/po/form_pengurangan_damira_multiple',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_damira_multiple_po']);
Route::get('/backend/po/update/edit_pengurangan/{id}/{single_id}', ['middleware' => 'auth','uses' => 'PenguranganController@form_update_pengurangan_multiple_po']);
Route::post('/backend/po/update/edit_pengurangan/proses', ['middleware' => 'auth','uses' => 'PenguranganController@form_update_pengurangan_po_proses']);
Route::get('/backend/po/form_pengurangan_multiple',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_refresh']);
Route::get('/backend/po/delete/edit_pengurangan/{id}/{template_id}/{table_template_id}', ['middleware' => 'auth','uses' => 'PenguranganController@form_delete_pengurangan_multiple_po']);
Route::get('/backend/po/form_pengurangan_damira_multiple',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_refresh']);
Route::get('/backend/po/pengurangan/approve/{id}/{single_id}', ['middleware' => 'auth','uses' => 'PenguranganController@approve_pengurangan']);

Route::get('/backend/po/form_pengurangan_button',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_multiple_po_button']);
Route::get('/backend/po/form_pengurangan_driver_button',['middleware' => 'auth','uses' => 'PenguranganController@form_pengurangan_driver_multiple_po_button']);
Route::get('/backend/po/pengurangan/tampungan/{id}', ['middleware' => 'auth','uses' => 'PenguranganController@tampungan_pengurangan']);
Route::get('/backend/po/pengurangan/tampungan/delete/{id}', ['middleware' => 'auth','uses' => 'PenguranganController@delete_tampungan_pengurangan']);
Route::get('/backend/po/pengurangan_driver/tampungan/{id}', ['middleware' => 'auth','uses' => 'PenguranganController@tampungan_pengurangan_driver']);
Route::get('/backend/po/pengurangan_driver/tampungan/delete/{id}', ['middleware' => 'auth','uses' => 'PenguranganController@delete_tampungan_pengurangan_driver']);

Route::get('/backend/po/pengurangan/pembatalan/{po_id}/{template_id}/{table_template_id}', ['middleware' => 'auth','uses' => 'PenguranganController@form_pembatalan_pengurangan']);

// ______________________________RELOKASI_________________________________
Route::get('/backend/po/relokasi',['middleware' => 'auth','uses' => 'RelokasiController@relokasi_po']);
Route::get('/backend/po/form_relokasi/{id}',['middleware' => 'auth','uses' => 'RelokasiController@form_relokasi_po']);
Route::post('/backend/po/edit_relokasi/{id}', ['middleware' => 'auth','uses' => 'RelokasiController@po_edit_relokasi']);
Route::post('/backend/po/form_relokasi',['middleware' => 'auth','uses' => 'RelokasiController@form_relokasi_multiple_po']);
Route::get('/backend/po/form_relokasi_button',['middleware' => 'auth','uses' => 'RelokasiController@form_relokasi_multiple_po_button']);
Route::get('/backend/po/form_relokasi',['middleware' => 'auth','uses' => 'RelokasiController@form_relokasi_refresh']);
Route::post('/backend/po/edit_relokasi/multiple/{id}', ['middleware' => 'auth','uses' => 'RelokasiController@po_edit_relokasi_multiple']);
Route::get('/backend/po/update/edit_relokasi/{id}/{single_id}', ['middleware' => 'auth','uses' => 'RelokasiController@form_update_relokasi_multiple_po']);
Route::get('/backend/po/delete/edit_relokasi/{id}/{template_id}/{table_template_id}', ['middleware' => 'auth','uses' => 'RelokasiController@form_delete_relokasi_multiple_po']);

Route::get('/backend/po/relokasi/pembatalan/{po_id}/{template_id}/{table_template_id}', ['middleware' => 'auth','uses' => 'RelokasiController@form_pembatalan_relokasi']);

Route::post('/backend/po/update/edit_relokasi/proses', ['middleware' => 'auth','uses' => 'RelokasiController@form_update_relokasi_po_proses']);
Route::get('/backend/po/relokasi/approve/{id}/{single_id}', ['middleware' => 'auth','uses' => 'RelokasiController@approve_relokasi']);
Route::get('/backend/po/relokasi/tampungan/{id}', ['middleware' => 'auth','uses' => 'RelokasiController@tampungan_relokasi']);
Route::get('/backend/po/relokasi/tampungan/delete/{id}', ['middleware' => 'auth','uses' => 'RelokasiController@delete_tampungan_relokasi']);


// ______________________________PERUBAHAN____ _____________________________
Route::get('/backend/po/perubahan',['middleware' => 'auth','uses' => 'PerubahanController@perubahan_po']);
Route::get('/backend/po/form_perubahan/{id}',['middleware' => 'auth','uses' => 'PerubahanController@form_perubahan_po']);
Route::post('/backend/po/form_perubahan_multiple',['middleware' => 'auth','uses' => 'PerubahanController@form_perubahan_multiple_po']);
Route::post('/backend/po/edit_perubahan/multiple/{id}', ['middleware' => 'auth','uses' => 'PerubahanController@po_edit_perubahan_multiple']);
// Route::post('/backend/po/form_pengurangan_damira_multiple',['middleware' => 'auth','uses' => 'PerubahanController@form_pengurangan_damira_multiple_po']);
Route::get('/backend/po/form_perubahan_multiple',['middleware' => 'auth','uses' => 'PerubahanController@form_perubahan_refresh']);
// Route::get('/backend/po/form_pengurangan_damira_multiple',['middleware' => 'auth','uses' => 'PerubahanController@form_pengurangan_refresh']);
Route::get('/backend/po/update/edit_perubahan/{id}/{single_id}', ['middleware' => 'auth','uses' => 'PerubahanController@form_update_perubahan_multiple_po']);
Route::get('/backend/po/delete/edit_perubahan/{id}/{template_id}/{table_template_id}', ['middleware' => 'auth','uses' => 'PerubahanController@form_delete_perubahan_multiple_po']);
Route::post('/backend/po/update/edit_perubahan/proses', ['middleware' => 'auth','uses' => 'PerubahanController@form_update_perubahan_po_proses']);
Route::get('/backend/po/perubahan/approve/{id}/{single_id}', ['middleware' => 'auth','uses' => 'PerubahanController@approve_perubahan']);
Route::get('/backend/po/perubahan/tampungan/{id}', ['middleware' => 'auth','uses' => 'PerubahanController@tampungan_perubahan']);
Route::get('/backend/po/perubahan/tampungan/delete/{id}', ['middleware' => 'auth','uses' => 'PerubahanController@delete_tampungan_perubahan']);
Route::get('/backend/po/form_perubahan_button',['middleware' => 'auth','uses' => 'PerubahanController@form_perubahan_multiple_po_button']);


Route::post('/backend/po/tgl/update/{id}', 'PengadaanmobilController@update_tgl_po');

Route::post('/backend/po/status/{id}', 'PengadaanmobilController@update_po_status');
Route::post('/backend/po/status_multiple', 'PengadaanmobilController@update_po_status_multiple');
Route::post('/backend/po/pengada/status_multiple', 'PengadaanmobilController@update_po_pengada_status_multiple');
Route::post('/backend/po/database_confirm', 'PengadaanmobilController@database_confirm');
Route::post('/backend/po/database_confirm/batalkan', 'PengadaanmobilController@database_confirm_batalkan');

Route::post('/backend/po/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_edit_pengurangan']);
Route::get('/backend/po/edit_pengada/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_edit_pengada']);
Route::post('/backend/po/edit_pengada/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_edit_pengada_proses']);
Route::get('/backend/po/edit_dashboard/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_edit_dashboard']);
Route::post('/backend/po/edit_dashboard/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_edit_dashboard_proses']);
Route::get('/backend/po/completing/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_completing']);
Route::post('/backend/po/completing/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_completing_proses']);

Route::get('/backend/po/show/pdf/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_po_pdf']);

Route::post('/backend/po/import_excel', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_import_excel']);
Route::post('/backend/po/database_excel', ['middleware' => 'auth','uses' => 'ImportController@database_import']);

Route::post('/backend/po/nopol/vendor_multiple_add', 'PengadaanmobilController@vendor_multiple_add')->name('vendor_multiple_add.check');

Route::get('/backend/po/perubahan/pembatalan/{po_id}/{template_id}/{table_template_id}', ['middleware' => 'auth','uses' => 'PerubahanController@form_pembatalan_perubahan']);


// ______________________________________ PO EDIT ____________________________________________________
Route::get('/backend/po/nopol/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_nopol']);
Route::post('/backend/po/nopol/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_nopol_proses']);
Route::get('/backend/po/type/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_type']);
Route::post('/backend/po/type/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_type_proses']);
Route::get('/backend/po/tgl/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_tgl']);
Route::post('/backend/po/tgl/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_tgl_proses']);




// ______________________________________ PO-FILTER _________________________________________________
Route::get('/backend/po/filter/status/active',['middleware' => 'auth','uses' => 'PengadaanmobilController@po_filter_active']);
Route::get('/backend/po/filter/status/notactive',['middleware' => 'auth','uses' => 'PengadaanmobilController@po_filter_notactive']);


// ______________________________________ SERVICE _________________________________________________
Route::get('/backend/po/service/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_service']);
Route::get('/backend/po/service/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_service']);
Route::post('/backend/po/service/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_service_proses']);
Route::post('/backend/po/service/add/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@add_service']);
Route::post('/backend/po/service/tgl_service', ['middleware' => 'auth','uses' => 'PengadaanmobilController@add_tgl_service']);
Route::get('/backend/po/service/filter/{tpo}/{periode}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_service_filter']);

// ______________________________________ SALON __________________________________________________
Route::post('/backend/po/salon/add/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@add_salon']);
Route::get('/backend/po/salon/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_salon']);
Route::get('/backend/po/salon/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_salon']);
Route::post('/backend/po/salon/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_salon_proses']);
Route::get('/backend/po/salon/filter/{tpo}/{periode}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_salon_filter']);

// ______________________________________ MCU _________________________________________________
Route::get('/backend/po/mcu/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_mcu']);
Route::post('/backend/po/mcu/add/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@add_mcu']);
Route::get('/backend/po/mcu/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_mcu']);
Route::post('/backend/po/mcu/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_mcu_proses']);
Route::get('/backend/po/mcu/filter/{tpo}/{periode}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_mcu_filter']);

// ______________________________________ USER PENGGUNA _________________________________________________
Route::get('/backend/po/userpengguna/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_userpengguna']);
Route::post('/backend/po/userpengguna/edit/proses', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_userpengguna_proses']);

// ______________________________________ CABANG _________________________________________________
Route::get('/backend/cabang',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_cabang']);
Route::get('/backend/cabang/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_cabang_status']);
Route::post('/backend/cabang/create', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_cabang']);
Route::post('/backend/cabang/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@cabang_edit_proses']);
Route::get('/backend/cabang/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@cabang_edit']);
Route::get('/backend/cabang/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_cabang']);
Route::post('/backend/cabang/delete_multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_cabang_multiple']);
Route::post('/backend/cabang/check', ['middleware' => 'auth','uses' =>'PengadaanmobilController@check_cabang_all'])->name('cabang_available.check');


//_______________________________________ DRIVER _________________________________________________
Route::get('/backend/driver',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_driver']);
Route::get('/backend/driver/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_driver_status']);
Route::post('/backend/driver/create', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_driver']);
Route::get('/backend/driver/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_driver']);
Route::get('/backend/driver/connect/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@connect_driver']);
Route::post('/backend/driver/connect/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_connect_driver']);
Route::post('/backend/driver/restore/proses', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_restore_driver']);
Route::post('/backend/driver/restore/proses2', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_restore_driver2']);
Route::get('/backend/driver/history/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@history_driver']);
Route::get('/backend/driver/history/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@history_driver_delete']);

Route::get('/backend/driver/edit/cutoff/{po_id}/{driver_id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_cutoff_driver']);
Route::post('/backend/driver/edit/cutoff/proses', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_cutoff_driver_proses']);

Route::post('/backend/po/delete/driver', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_delete_driver']);
Route::post('/backend/po/delete/driver/proses', ['middleware' => 'auth','uses' => 'PengadaanmobilController@po_delete_driver_proses']);

Route::post('/backend/driver/delete_multiple', ['middleware' => 'auth','uses' => 'UmpController@destroy_driver_multiple']);
Route::get('/backend/driver/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@driver_edit']);
Route::post('/backend/driver/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@driver_edit_proses']);


//_______________________________________ PKWT ____________________________________________
Route::get('/backend/driver/pkwt/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_pkwt']);
Route::get('/backend/driver/pkwt/{id}/{status}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@show_pkwt_status']);
Route::post('/backend/driver/pkwt/create/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@create_pkwt']);
Route::get('/backend/pkwt/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_pkwt']);
Route::get('/backend/driver/pkwt1/edit/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_pkwt']);
Route::post('/backend/driver/pkwt/edit/proses/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_pkwt_proses']);

//_______________________________________ MOBIL __________________________________________________
Route::get('/backend/mobil',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_mobil']);
Route::get('/backend/mobil/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_mobil_status']);
Route::post('/backend/mobil/create', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_mobil']);
Route::get('/backend/mobil/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_mobil']);
Route::post('/backend/mobil/delete_multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_mobil_multiple']);
Route::get('/backend/mobil/edit/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_mobil']);
Route::post('/backend/mobil/edit/proses/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_proses_mobil']);
Route::get('/backend/mobil2/cetak_mobil',['middleware' => 'auth','uses' => 'PengadaanmobilController@cetak_mobil']);

Route::get('/backend/mobil2/tahun',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_tahun']);
Route::get('/backend/mobil/tahun/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_tahun_status']);
Route::post('/backend/mobil/tahun/add',['middleware' => 'auth','uses' => 'PengadaanmobilController@store_tahun']);
Route::get('/backend/mobil/tahun/delete/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_tahun']);
Route::get('/backend/mobil/tahun/edit/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_tahun']);
Route::post('/backend/mobil/tahun/edit/proses/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_proses_tahun']);
Route::post('/backend/mobil/tahun/delete_multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_tahun_multiple']);

Route::get('/backend/bbm',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_bbm']);
Route::get('/backend/bbm/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_bbm_status']);
Route::post('/backend/bbm/add',['middleware' => 'auth','uses' => 'PengadaanmobilController@store_bbm']);
Route::get('/backend/bbm/delete/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_bbm']);
Route::get('/backend/bbm/edit/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_bbm']);
Route::post('/backend/bbm/edit/proses/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_proses_bbm']);
Route::post('/backend/bbm/delete_multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_bbm_multiple']);


//_______________________________________ CP __________________________________________________
Route::get('/backend/cp',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_cp']);
Route::get('/backend/cp/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_cp_status']);
Route::post('/backend/cp/add',['middleware' => 'auth','uses' => 'PengadaanmobilController@store_cp']);
Route::get('/backend/cp/delete/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_cp']);
Route::get('/backend/cp/edit/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_cp']);
Route::post('/backend/cp/edit/proses/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_proses_cp']);
Route::post('/backend/cp/delete_multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_cp_multiple']);

//_______________________________________ VENDOR __________________________________________________
Route::get('/backend/vendor',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_vendor']);
Route::get('/backend/vendor/{status}',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_vendor_status']);
Route::post('/backend/vendor/create', ['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_vendor']);
Route::get('/backend/vendor/delete/{id}', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_vendor']);
Route::get('/backend/ump/vendor/edit/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_vendor']);
Route::post('/backend/ump/vendor/edit/proses/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@edit_proses_vendor']);
Route::post('/backend/ump/vendor/delete_multiple', ['middleware' => 'auth','uses' => 'PengadaanmobilController@destroy_vendor_multiple']);


// //________________________________________ UMP ___________________________________________________
// Route::get('/backend/ump',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_ump']);
// Route::post('/backend/ump/create',['middleware' => 'auth','uses' => 'PengadaanmobilController@proses_tambah_ump']);



//________________________________________ UMP ___________________________________________________
Route::get('/backend/ump/kota',['middleware' => 'auth','uses' => 'UmpController@index_kota']);
Route::get('/backend/ump/kota/{status}',['middleware' => 'auth','uses' => 'UmpController@index_kota_status']);
Route::post('/backend/ump/kota/add',['middleware' => 'auth','uses' => 'UmpController@store_kota']);
Route::get('/backend/ump/kota/delete/{id}',['middleware' => 'auth','uses' => 'UmpController@destroy_kota']);
Route::get('/backend/ump/kota/edit/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_kota']);
Route::post('/backend/ump/kota/edit/proses/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_proses_kota']);
Route::post('/backend/ump/kota/delete_multiple', ['middleware' => 'auth','uses' => 'UmpController@destroy_kota_multiple']);

Route::get('/backend/ump/tahun',['middleware' => 'auth','uses' => 'UmpController@index_tahun']);
Route::get('/backend/ump/tahun/{status}',['middleware' => 'auth','uses' => 'UmpController@index_tahun_status']);
Route::post('/backend/ump/tahun/add',['middleware' => 'auth','uses' => 'UmpController@store_tahun']);
Route::get('/backend/ump/tahun/delete/{id}',['middleware' => 'auth','uses' => 'UmpController@destroy_tahun']);
Route::get('/backend/ump/tahun/edit/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_tahun']);
Route::post('/backend/ump/tahun/edit/proses/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_proses_tahun']);
Route::post('/backend/ump/tahun/delete_multiple', ['middleware' => 'auth','uses' => 'UmpController@destroy_tahun_multiple']);

Route::get('/backend/ump/jkk',['middleware' => 'auth','uses' => 'UmpController@index_jkk']);
Route::get('/backend/ump/jkk/{status}',['middleware' => 'auth','uses' => 'UmpController@index_jkk_status']);
Route::post('/backend/ump/jkk/add',['middleware' => 'auth','uses' => 'UmpController@store_jkk']);
Route::get('/backend/ump/jkk/delete/{id}',['middleware' => 'auth','uses' => 'UmpController@destroy_jkk']);
Route::get('/backend/ump/jkk/edit/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_jkk']);
Route::post('/backend/ump/jkk/edit/proses/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_proses_jkk']);
Route::post('/backend/ump/jkk/delete_multiple', ['middleware' => 'auth','uses' => 'UmpController@destroy_jkk_multiple']);


Route::get('/backend/ump/harga_ump',['middleware' => 'auth','uses' => 'UmpController@index_harga_ump']);
Route::post('/backend/ump/harga_ump/add',['middleware' => 'auth','uses' => 'UmpController@store_harga_ump']);
Route::get('/backend/ump/harga_ump/delete/{id}',['middleware' => 'auth','uses' => 'UmpController@destroy_harga_ump']);
Route::get('/backend/ump/harga_ump/edit/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_harga_ump']);
Route::post('/backend/ump/harga_ump/edit/proses/{id}',['middleware' => 'auth','uses' => 'UmpController@edit_proses_harga_ump']);
Route::post('/backend/ump/harga_ump/delete_multiple', ['middleware' => 'auth','uses' => 'UmpController@destroy_harga_ump_multiple']);

Route::get('/backend/ump/harga_ump/tahun/{id}',['middleware' => 'auth','uses' => 'UmpController@tahun_harga_ump']);
Route::post('/backend/ump/harga_ump/activate',['middleware' => 'auth','uses' => 'UmpController@activate_harga_ump']);
Route::get('/backend/ump/harga_ump/all',['middleware' => 'auth','uses' => 'UmpController@all_harga_ump']);
Route::get('/backend/ump/harga_ump/deactive',['middleware' => 'auth','uses' => 'UmpController@deactive_harga_ump']);


//________________________________________ PEJABAT ___________________________________________________
Route::get('/backend/pejabat/jabatan',['middleware' => 'auth','uses' => 'PejabatController@index_jabatan']);
Route::get('/backend/pejabat/jabatan/{status}',['middleware' => 'auth','uses' => 'PejabatController@index_jabatan_status']);
Route::post('/backend/pejabat/jabatan/add',['middleware' => 'auth','uses' => 'PejabatController@store_jabatan']);
Route::get('/backend/pejabat/jabatan/delete/{id}',['middleware' => 'auth','uses' => 'PejabatController@destroy_jabatan']);
Route::get('/backend/pejabat/jabatan/edit/{id}',['middleware' => 'auth','uses' => 'PejabatController@edit_jabatan']);
Route::post('/backend/pejabat/jabatan/edit/proses/{id}',['middleware' => 'auth','uses' => 'PejabatController@edit_proses_jabatan']);
Route::post('/backend/pejabat/jabatan/delete_multiple', ['middleware' => 'auth','uses' => 'PejabatController@destroy_jabatan_multiple']);
Route::post('/jabatan_available/check', 'PejabatController@check_jabatan')->name('jabatan_available.check');

Route::get('/backend/pejabat/unitkerja',['middleware' => 'auth','uses' => 'PejabatController@index_unitkerja']);
Route::get('/backend/pejabat/unitkerja/{status}',['middleware' => 'auth','uses' => 'PejabatController@index_unitkerja_status']);
Route::post('/backend/pejabat/unitkerja/add',['middleware' => 'auth','uses' => 'PejabatController@store_unitkerja']);
Route::get('/backend/pejabat/unitkerja/delete/{id}',['middleware' => 'auth','uses' => 'PejabatController@destroy_unitkerja']);
Route::get('/backend/pejabat/unitkerja/edit/{id}',['middleware' => 'auth','uses' => 'PejabatController@edit_unitkerja']);
Route::post('/backend/pejabat/unitkerja/edit/proses/{id}',['middleware' => 'auth','uses' => 'PejabatController@edit_proses_unitkerja']);
Route::post('/backend/pejabat/unitkerja/delete_multiple', ['middleware' => 'auth','uses' => 'PejabatController@destroy_unitkerja_multiple']);
Route::post('/unitkerja_available/check', 'PejabatController@check_unitkerja')->name('unitkerja_available.check');

Route::get('/backend/pejabat',['middleware' => 'auth','uses' => 'PejabatController@index_pejabat']);
Route::get('/backend/pejabat/{status}',['middleware' => 'auth','uses' => 'PejabatController@index_pejabat_status']);
Route::post('/backend/pejabat/add',['middleware' => 'auth','uses' => 'PejabatController@store_pejabat']);
Route::get('/backend/pejabat/delete/{id}',['middleware' => 'auth','uses' => 'PejabatController@destroy_pejabat']);
Route::get('/backend/pejabat/edit/{id}',['middleware' => 'auth','uses' => 'PejabatController@edit_pejabat']);
Route::post('/backend/pejabat/edit/proses/{id}',['middleware' => 'auth','uses' => 'PejabatController@edit_proses_pejabat']);
Route::post('/backend/pejabat/delete_multiple', ['middleware' => 'auth','uses' => 'PejabatController@destroy_pejabat_multiple']);
Route::post('/pejabat_available/check', 'PejabatController@check_pejabat')->name('pejabat_available.check');

Route::post('/backend/pejabat/ajax',['middleware' => 'auth','uses' => 'PejabatController@pb_ajax'])->name('pb_ajax');
Route::post('/backend/pks/ajax',['middleware' => 'auth','uses' => 'PksController@pks_ajax'])->name('pks_ajax');
Route::post('/backend/pks/addendum/ajax',['middleware' => 'auth','uses' => 'PksController@pks_addendum_ajax'])->name('pks_addendum_ajax');

//_______________________________________ SURAT ____________________________________________
Route::get('/backend/surat/relokasi',['middleware' => 'auth','uses' => 'WordController@index_relokasi']);
Route::get('/backend/surat/relokasi/status/{status}',['middleware' => 'auth','uses' => 'WordController@index_relokasi_status']);
Route::post('/backend/surat/relokasi/status',['middleware' => 'auth','uses' => 'WordController@status_relokasi']);
Route::get('/backend/surat/relokasi/{id}',['middleware' => 'auth','uses' => 'WordController@download_relokasi']);
Route::get('/backend/surat/relokasi/view/{id}',['middleware' => 'auth','uses' => 'WordController@view_relokasi']);

Route::get('/backend/surat/pengurangan',['middleware' => 'auth','uses' => 'WordController@index_pengurangan']);
Route::get('/backend/surat/pengurangan/status/{status}',['middleware' => 'auth','uses' => 'WordController@index_pengurangan_status']);
Route::post('/backend/surat/pengurangan/status',['middleware' => 'auth','uses' => 'WordController@status_pengurangan']);
Route::get('/backend/surat/pengurangan/{id}',['middleware' => 'auth','uses' => 'WordController@download_pengurangan']);
Route::get('/backend/surat/pengurangan/view/{id}',['middleware' => 'auth','uses' => 'WordController@view_pengurangan']);

Route::get('/backend/surat/perubahan',['middleware' => 'auth','uses' => 'WordController@index_perubahan']);
Route::get('/backend/surat/perubahan/status/{status}',['middleware' => 'auth','uses' => 'WordController@index_perubahan_status']);
Route::post('/backend/surat/perubahan/status',['middleware' => 'auth','uses' => 'WordController@status_perubahan']);
Route::get('/backend/surat/perubahan/{id}',['middleware' => 'auth','uses' => 'WordController@download_perubahan']);
Route::get('/backend/surat/perubahan/view/{id}',['middleware' => 'auth','uses' => 'WordController@view_perubahan']);

//________________________________________ PKS ___________________________________________________
Route::get('/backend/pks',['middleware' => 'auth','uses' => 'PksController@index_pks']);
Route::get('/backend/pks/create',['middleware' => 'auth','uses' => 'PksController@create_pks']);
Route::get('/backend/pks/{status}',['middleware' => 'auth','uses' => 'PksController@index_pks_status']);
Route::post('/backend/pks/add',['middleware' => 'auth','uses' => 'PksController@store_pks']);
Route::get('/backend/pks/delete/{id}',['middleware' => 'auth','uses' => 'PksController@destroy_pks']);
Route::get('/backend/pks/edit/{id}',['middleware' => 'auth','uses' => 'PksController@edit_pks']);
Route::post('/backend/pks/edit/proses/{id}',['middleware' => 'auth','uses' => 'PksController@edit_proses_pks']);
Route::post('/backend/pks/delete_multiple', ['middleware' => 'auth','uses' => 'PksController@destroy_pks_multiple']);
Route::post('/pks_available/check', 'PksController@check_pks')->name('pks_available.check');
Route::post('/pks_vendor/check', 'PksController@check_pks_vendor')->name('vendor_addendum.check');
Route::get('/backend/pks/download/{pks}',['middleware' => 'auth','uses' => 'PksController@pks_download']);
Route::get('/backend/pks/index_pks_addendum/{pks}',['middleware' => 'auth','uses' => 'PksController@index_pks_addendum']);


Route::get('/backend/addendum',['middleware' => 'auth','uses' => 'PksController@index_addendum']);
Route::get('/backend/addendum/{status}',['middleware' => 'auth','uses' => 'PksController@index_addendum_status']);
Route::post('/backend/addendum/add',['middleware' => 'auth','uses' => 'PksController@store_addendum']);
Route::get('/backend/addendum/delete/{id}',['middleware' => 'auth','uses' => 'PksController@destroy_addendum']);
Route::get('/backend/addendum/edit/{id}',['middleware' => 'auth','uses' => 'PksController@edit_addendum']);
Route::post('/backend/addendum/edit/proses/{id}',['middleware' => 'auth','uses' => 'PksController@edit_proses_addendum']);
Route::post('/backend/addendum/delete_multiple', ['middleware' => 'auth','uses' => 'PksController@destroy_addendum_multiple']);
Route::post('/backend/addendum_id/edit/{id}',['middleware' => 'auth','uses' => 'PksController@edit_addendum_all']);
Route::get('/backend/addendum_id/delete/{id}/{pks_id}',['middleware' => 'auth','uses' => 'PksController@delete_addendum_all']);
Route::post('/addendum_available/check', 'PksController@check_pks')->name('addendum_available.check');
Route::post('/addendum_vendor/check', 'PksController@check_addendum_vendor')->name('vendor_pks.check');
Route::post('/addendum_id/check', 'PksController@check_pilih_pks')->name('pilih_pks.check');

Route::get('/backend/addendum/ajax/{id}',['middleware' => 'auth','uses' => 'PksController@addendum_ajax']);
Route::get('/backend/all_addendum/ajax/{id}',['middleware' => 'auth','uses' => 'PksController@all_addendum_ajax']);

//_______________________________________ USER ___________________________________________________
Route::get('/backend/user',['middleware' => 'auth','uses' => 'PengadaanmobilController@index_user']);

//______________________________________ PROFILE _________________________________________________
Route::get('/backend/profile', function () {
    return view('profile/index');
});


//_______________________________________ REPORT ___________________________________________________
Route::get('/backend/report/all',['middleware' => 'auth','uses' => 'ReportController@all']);

Route::get('/backend/report/mcu',['middleware' => 'auth','uses' => 'ReportController@index_mcu']);
Route::get('/backend/report/mcu/{periode}', ['middleware' => 'auth','uses' => 'ReportController@index_mcu_filter']);
Route::get('/backend/report/mcu/edit/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_mcu']);
Route::post('/backend/report/mcu/edit/proses/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_proses_mcu']);
Route::get('/backend/report/mcu/delete/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_mcu']);

Route::get('/backend/report/service',['middleware' => 'auth','uses' => 'ReportController@index_service']);
Route::get('/backend/report/service/{periode}', ['middleware' => 'auth','uses' => 'ReportController@index_service_filter']);
Route::get('/backend/report/service/edit/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_service']);
Route::post('/backend/report/service/edit/proses/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_proses_service']);
Route::get('/backend/report/service/delete/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_service']);
Route::get('/backend/report/service/delete_report/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_service_report']);

Route::get('/backend/report/salon',['middleware' => 'auth','uses' => 'ReportController@index_salon']);
Route::get('/backend/report/salon/{periode}', ['middleware' => 'auth','uses' => 'ReportController@index_salon_filter']);
Route::get('/backend/report/salon/edit/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_salon']);
Route::post('/backend/report/salon/edit/proses/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_proses_salon']);
Route::get('/backend/report/salon/delete/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_salon']);
Route::get('/backend/report/salon/delete_report/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_salon_report']);

Route::get('/backend/report/driver',['middleware' => 'auth','uses' => 'ReportController@index_driver']);
Route::get('/backend/report/driver/{namadriver}', ['middleware' => 'auth','uses' => 'ReportController@index_driver_filter']);
Route::get('/backend/report/driver/edit/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_driver']);
Route::post('/backend/report/driver/edit/proses/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_proses_driver']);
Route::get('/backend/report/driver/delete/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_driver']);
Route::get('/backend/report/driver/delete_report/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_driver_report']);

Route::get('/backend/report/pkwt',['middleware' => 'auth','uses' => 'ReportController@index_pkwt']);
Route::get('/backend/report/pkwt/{namadriver}', ['middleware' => 'auth','uses' => 'ReportController@index_pkwt_filter']);
Route::get('/backend/report/pkwt/edit/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_pkwt']);
Route::post('/backend/report/pkwt/edit/proses/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_proses_pkwt']);
Route::get('/backend/report/pkwt/delete/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_pkwt']);
Route::get('/backend/report/pkwt/delete_report/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_pkwt_report']);

Route::get('/backend/report/database',['middleware' => 'auth','uses' => 'ReportController@index_database']);
Route::get('/backend/report/database/{namadatabase}', ['middleware' => 'auth','uses' => 'ReportController@index_database_filter']);
Route::get('/backend/report/database/edit/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_database']);
Route::post('/backend/report/database/edit/proses/{id}',['middleware' => 'auth','uses' => 'ReportController@edit_proses_database']);
Route::get('/backend/report/database/delete/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_database']);
Route::get('/backend/report/database/delete_report/{id}', ['middleware' => 'auth','uses' => 'ReportController@destroy_database_report']);



Route::post('/backend/po/import_excel/salon', ['middleware' => 'auth','uses' => 'ReportController@import_excel_salon']);
Route::post('/backend/po/import_excel/mcu', ['middleware' => 'auth','uses' => 'ReportController@import_excel_mcu']);
Route::post('/backend/po/import_excel/service', ['middleware' => 'auth','uses' => 'ReportController@import_excel_service']);
Route::post('/backend/po/import_excel/pkwt', ['middleware' => 'auth','uses' => 'ReportController@import_excel_pkwt']);



//_______________________________________ AJAX __________________________________________________
Route::get('/backend/kota',['middleware' => 'auth','uses' => 'PengadaanmobilController@kota']);
Route::get('/backend/kota/ajax/{id}/{vendor_id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@kota_ajax']);
Route::post('/backend/kota/ajax',['middleware' => 'auth','uses' => 'PengadaanmobilController@kota_ajax_noid'])->name('kota_ajax');
Route::get('/backend/connect_po/ajax/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@connect_po_ajax']);
Route::get('/backend/nopol/ajax/{id}',['middleware' => 'auth','uses' => 'PengadaanmobilController@nopol_ajax']);
Route::post('/backend/nopol/filter/ajax',['middleware' => 'auth','uses' => 'PengadaanmobilController@nopol_filter_ajax']);

//_______________________________________ CHECK __________________________________________________
Route::post('/kota_available/check', 'UmpController@check_kota')->name('kota_available.check');
Route::post('/cp_available/check', 'PengadaanmobilController@check_cp')->name('cp_available.check');
Route::post('/jkk_available/check', 'UmpController@check_jkk')->name('jkk_available.check');
Route::post('/tahun_available/check', 'UmpController@check_tahun')->name('tahun_available.check');
Route::post('/tahun_mobil_available/check', 'PengadaanmobilController@check_tahun_mobil')->name('tahun_mobil_available.check');
Route::post('/bbm_available/check', 'PengadaanmobilController@check_bbm')->name('bbm_available.check');
Route::post('/vendor_available/check', 'PengadaanmobilController@check_vendor')->name('vendor_available.check');
Route::post('/harga_ump_available/check', 'UmpController@check_harga_ump')->name('harga_ump_available.check');
Route::post('/mobil_available/check', 'PengadaanmobilController@check_mobil')->name('mobil_available.check');

Route::post('/tahun_available/service/check', 'PengadaanmobilController@check_tahun_service')->name('service.check');
Route::post('/tahun_available/salon/check', 'PengadaanmobilController@check_tahun_salon')->name('salon.check');
Route::post('/tahun_available/mcu_service/check', 'PengadaanmobilController@check_tahun_mcu_service')->name('mcu_service.check');

Route::post('/po_multiple_nopol/check', 'PengadaanmobilController@check_po_multiple_nopol')->name('po_multiple_nopol.check');

Route::post('/cabang/check', 'PengadaanmobilController@check_cabang')->name('cabut_available.check');



//________________________________________ SERVERSIDE _________________________________________
Route::get('/server_side/po/json','ServersideController@json_po')->name('json_po');
Route::get('/server_side/po/json/relokasi','ServersideController@json_po_relokasi')->name('json_po_relokasi');
Route::get('/server_side/po/json/pengurangan','ServersideController@json_po_pengurangan')->name('json_po_pengurangan');
Route::get('/server_side/po/json/pengurangan_driver','ServersideController@json_po_pengurangan_driver')->name('json_po_pengurangan_driver');
Route::get('/server_side/po/json/perubahan','ServersideController@json_po_perubahan')->name('json_po_perubahan');

Route::get('/server_side/cabang','ServersideController@index');
Route::get('/server_side/cabang_active/json','ServersideController@json_cabang_active')->name('json_cabang_active');
Route::get('/server_side/cabang_notactive/json','ServersideController@json_cabang_notactive')->name('json_cabang_notactive');


//________________________________________ Export _________________________________________
Route::get('/backend/export/cabang',['middleware' => 'auth','uses' => 'ExportController@cabang']);
Route::get('/backend/export/service',['middleware' => 'auth','uses' => 'ExportController@service']);
Route::get('/backend/export/salon',['middleware' => 'auth','uses' => 'ExportController@salon']);
Route::get('/backend/export/mcu',['middleware' => 'auth','uses' => 'ExportController@mcu']);
Route::get('/backend/export/driver',['middleware' => 'auth','uses' => 'ExportController@driver']);
Route::get('/backend/export/database',['middleware' => 'auth','uses' => 'ExportController@database']);
Route::get('/backend/export/pkwt',['middleware' => 'auth','uses' => 'ExportController@pkwt']);

//________________________________________ Import _________________________________________
Route::post('/backend/cabang/import_excel', ['middleware' => 'auth','uses' => 'ImportController@cabang_import']);
Route::post('/backend/mobil/import_excel', ['middleware' => 'auth','uses' => 'ImportController@mobil_import']);
Route::post('/backend/vendor/import_excel', ['middleware' => 'auth','uses' => 'ImportController@vendor_import']);
Route::post('/backend/hargaump/import_excel', ['middleware' => 'auth','uses' => 'ImportController@hargaump_import']);
Route::post('/backend/jkk/import_excel', ['middleware' => 'auth','uses' => 'ImportController@jkk_import']);
Route::post('/backend/kota/import_excel', ['middleware' => 'auth','uses' => 'ImportController@kota_import']);
Route::post('/backend/driver/import_excel', ['middleware' => 'auth','uses' => 'ImportController@driver_import']);


//_______________________________________ BACKUPRESTORE _______________________________________
Route::get('/backend/backup',['middleware' => 'auth','uses' => 'BackupController@index_backup']);
Route::get('/backend/backup/export/po',['middleware' => 'auth','uses' => 'BackupController@export_po']);
Route::get('/backend/backup/export/cabang',['middleware' => 'auth','uses' => 'BackupController@export_cabang']);
Route::get('/backend/backup/export/mobil',['middleware' => 'auth','uses' => 'BackupController@export_mobil']);


//________________________________________ WORD _____________________________________
Route::get('/backend/word/relokasi',['middleware' => 'auth','uses' => 'WordController@index_relokasi']);




//________________________________________ ADMIN _____________________________________
Route::get('/backend/admin/po',['middleware' => 'auth','uses' => 'AdminController@index_po']);
Route::post('/backend/admin/po/delete',['middleware' => 'auth','uses' => 'AdminController@delete_po']);

Route::get('/backend/admin/cabang',['middleware' => 'auth','uses' => 'AdminController@index_cabang']);
Route::get('/backend/admin/cabang/{status}',['middleware' => 'auth','uses' => 'AdminController@index_cabang_status']);
Route::post('/backend/admin/cabang/delete',['middleware' => 'auth','uses' => 'AdminController@delete_cabang']);

Route::get('/backend/admin/cp',['middleware' => 'auth','uses' => 'AdminController@index_cp']);
Route::get('/backend/admin/cp/{status}',['middleware' => 'auth','uses' => 'AdminController@index_cp_status']);
Route::post('/backend/admin/cp/delete',['middleware' => 'auth','uses' => 'AdminController@delete_cp']);

Route::get('/backend/admin/driver',['middleware' => 'auth','uses' => 'AdminController@index_driver']);
Route::get('/backend/admin/driver/{status}',['middleware' => 'auth','uses' => 'AdminController@index_driver_status']);
Route::post('/backend/admin/driver/delete',['middleware' => 'auth','uses' => 'AdminController@delete_driver']);

Route::get('/backend/admin/pkwt',['middleware' => 'auth','uses' => 'AdminController@index_pkwt']);
Route::post('/backend/admin/pkwt/delete',['middleware' => 'auth','uses' => 'AdminController@delete_pkwt']);

Route::get('/backend/admin/mobil',['middleware' => 'auth','uses' => 'AdminController@index_mobil']);
Route::get('/backend/admin/mobil/{status}',['middleware' => 'auth','uses' => 'AdminController@index_mobil_status']);
Route::post('/backend/admin/mobil/delete',['middleware' => 'auth','uses' => 'AdminController@delete_mobil']);

Route::get('/backend/admin/tahun_mobil',['middleware' => 'auth','uses' => 'AdminController@index_tahun_mobil']);
Route::post('/backend/admin/tahun_mobil/delete',['middleware' => 'auth','uses' => 'AdminController@delete_tahun_mobil']);

Route::get('/backend/admin/bbm',['middleware' => 'auth','uses' => 'AdminController@index_bbm']);
Route::get('/backend/admin/bbm/{status}',['middleware' => 'auth','uses' => 'AdminController@index_bbm_status']);
Route::post('/backend/admin/bbm/delete',['middleware' => 'auth','uses' => 'AdminController@delete_bbm']);

Route::get('/backend/admin/pejabat',['middleware' => 'auth','uses' => 'AdminController@index_pejabat']);
Route::get('/backend/admin/pejabat/{status}',['middleware' => 'auth','uses' => 'AdminController@index_pejabat_status']);
Route::post('/backend/admin/pejabat/delete',['middleware' => 'auth','uses' => 'AdminController@delete_pejabat']);

Route::get('/backend/admin/jabatan',['middleware' => 'auth','uses' => 'AdminController@index_jabatan']);
Route::get('/backend/admin/jabatan/{status}',['middleware' => 'auth','uses' => 'AdminController@index_jabatan_status']);
Route::post('/backend/admin/jabatan/delete',['middleware' => 'auth','uses' => 'AdminController@delete_jabatan']);

Route::get('/backend/admin/unitkerja',['middleware' => 'auth','uses' => 'AdminController@index_unitkerja']);
Route::get('/backend/admin/unitkerja/{status}',['middleware' => 'auth','uses' => 'AdminController@index_unitkerja_status']);
Route::post('/backend/admin/unitkerja/delete',['middleware' => 'auth','uses' => 'AdminController@delete_unitkerja']);

Route::get('/backend/admin/pks',['middleware' => 'auth','uses' => 'AdminController@index_pks']);
Route::get('/backend/admin/pks/{status}',['middleware' => 'auth','uses' => 'AdminController@index_pks_status']);
Route::post('/backend/admin/pks/delete',['middleware' => 'auth','uses' => 'AdminController@delete_pks']);

Route::get('/backend/admin/addendum',['middleware' => 'auth','uses' => 'AdminController@index_addendum']);
Route::get('/backend/admin/addendum/{status}',['middleware' => 'auth','uses' => 'AdminController@index_addendum_status']);
Route::post('/backend/admin/addendum/delete',['middleware' => 'auth','uses' => 'AdminController@delete_addendum']);

Route::get('/backend/admin/harga_ump',['middleware' => 'auth','uses' => 'AdminController@index_harga_ump']);
Route::post('/backend/admin/harga_ump/delete',['middleware' => 'auth','uses' => 'AdminController@delete_harga_ump']);

Route::get('/backend/admin/jkk',['middleware' => 'auth','uses' => 'AdminController@index_jkk']);
Route::post('/backend/admin/jkk/delete',['middleware' => 'auth','uses' => 'AdminController@delete_jkk']);

Route::get('/backend/admin/kota',['middleware' => 'auth','uses' => 'AdminController@index_kota']);
Route::post('/backend/admin/kota/delete',['middleware' => 'auth','uses' => 'AdminController@delete_kota']);

Route::get('/backend/admin/tahun',['middleware' => 'auth','uses' => 'AdminController@index_tahun']);
Route::post('/backend/admin/tahun/delete',['middleware' => 'auth','uses' => 'AdminController@delete_tahun']);

Route::get('/backend/admin/vendor',['middleware' => 'auth','uses' => 'AdminController@index_vendor']);
Route::post('/backend/admin/vendor/delete',['middleware' => 'auth','uses' => 'AdminController@delete_vendor']);

Route::get('/backend/admin/surat/relokasi',['middleware' => 'auth','uses' => 'AdminController@index_relokasi']);
Route::get('/backend/admin/surat/relokasi/{status}',['middleware' => 'auth','uses' => 'AdminController@index_relokasi_status']);
Route::post('/backend/admin/surat/relokasi/delete',['middleware' => 'auth','uses' => 'AdminController@delete_relokasi']);

Route::get('/backend/admin/surat/pengurangan',['middleware' => 'auth','uses' => 'AdminController@index_pengurangan']);
Route::get('/backend/admin/surat/pengurangan/{status}',['middleware' => 'auth','uses' => 'AdminController@index_pengurangan_status']);
Route::post('/backend/admin/surat/pengurangan/delete',['middleware' => 'auth','uses' => 'AdminController@delete_pengurangan']);

Route::get('/backend/admin/surat/perubahan',['middleware' => 'auth','uses' => 'AdminController@index_perubahan']);
Route::get('/backend/admin/surat/perubahan/{status}',['middleware' => 'auth','uses' => 'AdminController@index_perubahan_status']);
Route::post('/backend/admin/surat/perubahan/delete',['middleware' => 'auth','uses' => 'AdminController@delete_perubahan']);

Route::get('/backend/admin/report_database',['middleware' => 'auth','uses' => 'AdminController@index_report_database']);
Route::post('/backend/admin/report_database/delete',['middleware' => 'auth','uses' => 'AdminController@delete_report_database']);

Route::get('/backend/admin/report_service',['middleware' => 'auth','uses' => 'AdminController@index_report_service']);
Route::post('/backend/admin/report_service/delete',['middleware' => 'auth','uses' => 'AdminController@delete_report_service']);

Route::get('/backend/admin/report_salon',['middleware' => 'auth','uses' => 'AdminController@index_report_salon']);
Route::post('/backend/admin/report_salon/delete',['middleware' => 'auth','uses' => 'AdminController@delete_report_salon']);

Route::get('/backend/admin/report_mcu',['middleware' => 'auth','uses' => 'AdminController@index_report_mcu']);
Route::post('/backend/admin/report_mcu/delete',['middleware' => 'auth','uses' => 'AdminController@delete_report_mcu']);

Route::get('/backend/admin/report_driver',['middleware' => 'auth','uses' => 'AdminController@index_report_driver']);
Route::post('/backend/admin/report_driver/delete',['middleware' => 'auth','uses' => 'AdminController@delete_report_driver']);

Route::get('/backend/admin/user',['middleware' => 'auth','uses' => 'AdminController@index_user']);
Route::post('/backend/admin/user/add',['middleware' => 'auth','uses' => 'AdminController@add_user']);
Route::post('/backend/admin/user/delete',['middleware' => 'auth','uses' => 'AdminController@delete_user']);
Route::post('/backend/user/myprofile',['middleware' => 'auth','uses' => 'PengadaanmobilController@myprofile']);




