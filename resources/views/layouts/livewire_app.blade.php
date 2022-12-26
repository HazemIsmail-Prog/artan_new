<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body>
        @include('includes.sidebar')
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            @include('includes.topbar')
            <div class="body flex-grow-1 px-3">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @include('includes.scripts')
    </body>
</html>