$name = "cabang"; 

<!-- 1111111111111111111111111111111111111111111111111111111111 -->

@include('button_delete.index')

<!-- 1111111111111111111111111111111111111111111111111111111111 -->

~~~~~~~~~~~~ hilangkan name="cabang[]" ~~~~~~~~~~~~~~~~~

<!-- 1111111111111111111111111111111111111111111111111111111111 -->

<?php $i = 1; ?>
@foreach(App\Kota::all()->sortBy('id') as $kota)
    @if($kota->active != '1')
      <div class="delete_checkbox{{$kota->id}}"></div> 
      <?php $i = $kota->id; ?>                    
    @endif
@endforeach

<!-- 1111111111111111111111111111111111111111111111111111111111 -->

<?php $i = 1; ?>
@foreach(App\Kota::all()->sortBy('id') as $kota)
    @if($kota->active == '1')
      <div class="delete_checkbox{{$kota->id}}"></div> 
      <?php $i = $kota->id; ?>                    
    @endif
@endforeach

<!-- 1111111111111111111111111111111111111111111111111111111111 -->

id="customCheck1{{$i}}"


