<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('IDU-LOGO2-02.png')}}" class="logo" alt="IDUNI Logo">
@else
<img src="{{asset('IDU-LOGO2-02.png')}}" class="logo" alt="{{ $slot }}">

@endif
</a>
</td>
</tr>
