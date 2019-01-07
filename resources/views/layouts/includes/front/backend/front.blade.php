<!doctype html>
<html lang="en">
  <head>
    <!-- Head -->
    @include('layouts.includes.front.backend.head')
  </head>
  
  <body>

    @if(Session::has('status'))
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <strong>{!!Session::get('status')!!}</strong> 
        </div>
    @endif
    @php 
        $strchr = substr(strrchr(url()->current(),"/"),1);
    @endphp

    @include('layouts.includes.front.backend.header')

    @yield('content')


    @include('layouts.includes.front.backend.footer')


    @include('layouts.includes.front.footer_scripts')

    @yield('page_scripts')

    @php $value = session('key'); @endphp
 
    <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
    <input name="animation" type="hidden">
  </body>
</html>