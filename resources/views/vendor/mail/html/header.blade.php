<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://bsmru.ac.bd/assets/img/logo-light.png" class="logo" >
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
