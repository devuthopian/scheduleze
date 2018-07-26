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
      
      @yield('page_scripts')
      <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5b5862efdf040c3e9e0bf224/default';
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