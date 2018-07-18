<!doctype html>
<html lang="en">
  <head>
    <!-- Head -->
    @include('layouts.includes.front.head')
  </head>
  
  <body>

      @include('layouts.includes.front.header')

      @yield('content')
      
      @include('layouts.includes.front.footer')

      @include('layouts.includes.front.footer_scripts')
      
  </body>
</html>