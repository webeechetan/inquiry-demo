@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://webeesocial.com/wp-content/uploads/2020/12/logo-tm-compressed.png" class="logo" alt="Webeesocial">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
