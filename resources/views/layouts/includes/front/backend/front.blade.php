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
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 400,
                tooltip: false
            });
        });
    </script>
 
    <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
    <input name="animation" type="hidden">
  </body>
</html>