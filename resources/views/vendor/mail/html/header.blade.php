@props(['url']) 
<tr> 
    <td class="header"> 
        <a href="{{ $url }}" style="display:inline-block;"> 
            <img src="{{ asset('public/img/logo.png') }}" class="logo" /> 
            <br /> 
            {{ $slot }} 
        </a> 
    </td> 
</tr> 