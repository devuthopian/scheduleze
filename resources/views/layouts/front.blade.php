<!doctype html>
<html lang="en">
  <head>
    <!-- Head -->
    @include('layouts.includes.front.head')
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

    @include('layouts.includes.front.header')

    @yield('content')

    @if($strchr != 'backend')
        @include('layouts.includes.front.footer')
    @else
        @include('layouts.includes.front.backend.footer')
    @endif

    @include('layouts.includes.front.footer_scripts')

    @yield('page_scripts')

    @php $value = session('key'); @endphp

    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5c24645a82491369ba9f9606/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
   
    <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
    <input name="animation" type="hidden">
  </body>
</html>