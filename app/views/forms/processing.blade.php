@foreach ($in_progress as $running)
    <tr>
      <td>{{ $running[0] }}
      </td>
      <td>
            @if (1)
              --- 
            @endif
        </td>
      <td class="onlydesktop">{{ date('d-m-Y H:i:s') }}</td>
      <td class="onlydesktop">

              ---
        </td>
      <td class="onlydesktop">
              <span id="percent[]">1<span>%
        </td>
      <td>
              {{ "Download" }}
         
        </td>
    </tr>
 @endforeach

 <script type="text/javascript">
 
 </script>