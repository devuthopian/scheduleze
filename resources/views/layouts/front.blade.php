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

    @php $value = session('key'); @endphp

    <script type="text/javascript">
        //Start of Tawk.to Script
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5b5862efdf040c3e9e0bf224/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();

        
        //grapejs editor
        var editor = grapesjs.init({
            height: '100%',
            showOffsets: 1,
            noticeOnUnload: 0,
            
            container: '#gjs',
            fromElement: true,

            plugins: ['gjs-preset-webpage'],
            pluginsOpts: {
                'gjs-preset-webpage': {}
            },
            storageManager: {
                type: 'remote',
                stepsBeforeSave: 0,
                urlStore: '/store-template/{{$value}}',
                urlLoad: '/load-template/{{$value}}',
                // For custom parameters/headers on requests
                /*params: { _token:  },*/
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                 beforeSend: function() {
                    console.log('before send');
                  },
                autosave: true,         // Store data automatically
                autoload: true,         // Autoload stored data on init
                contentTypeJson: true,
            }
        });

        editor.store(res => console.log('Store callback'));
    </script>
   
    <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
    <input name="animation" type="hidden">
  </body>
</html>