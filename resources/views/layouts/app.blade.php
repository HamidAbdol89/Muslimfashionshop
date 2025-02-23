@if(Route::is('login') || Route::is('register'))
    <!-- Include login/register layout here -->
@else
    @include('layouts.master')
@endif
