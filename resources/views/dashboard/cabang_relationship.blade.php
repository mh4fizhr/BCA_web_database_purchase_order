@if(empty($po->Cabang_relokasi))

  <td>
    
    {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
  </td>
  <td> 
    
    {{$po->cabang->Kota}}
  </td>

@else

  @if($po->Efisien_relokasi <= $currentDateTime)

    <td>
      
      {{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}
    </td>
    <td> 
      
      {{$po->cabang_relokasi->Kota}}
    </td>

  @else

    <td>
      
      {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
    </td>
    <td> 
      
      {{$po->cabang->Kota}}
    </td>

    @endif
  
@endif