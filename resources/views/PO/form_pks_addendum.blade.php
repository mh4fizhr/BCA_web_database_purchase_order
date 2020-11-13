<div class="row">
  <div class="col-md-8">
    <span>PKS & Addendum</span>
    <p>
      <select class="form-control select2" id="pilih_addendum" style="display: block;">
        <option value=""> -- Pilih PKS / addendum -- </option>
        @foreach($addendums as $addendum)
          @if($addendum->active != '1' && $addendum->vendor == $vendor_kode)  
            
              <option value="{{$addendum->id}}">{{$addendum->no_addendum}} - {{$addendum->nama_kontrak_addendum}} - {{$addendum->tgl_addendum}}</option>

          @endif
        @endforeach
      </select>
    </p>
  </div>
  <!-- <div class="col-md-4">
    <span>PKS & addendum</span>
    <p>
      <select class="form-control form-control-sm select2" id="pilih_pks" style="display: block;">
        <option value="">Pilih pks</option>
        @foreach($pkss as $pks)
          @if($pks->active != '1' && $pks->vendor == $vendor_nama)  
            
              <option value="{{$pks->id}}">PKS : {{$pks->no_pks}} - {{$pks->nama_kontrak_pks}} - {{$pks->tgl_pks}}</option>

          @endif
        @endforeach
      </select>
    </p>
  </div> -->
</div>