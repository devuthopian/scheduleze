<link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('dist/grapesjs-preset-webpage.min.css') }}">
<script src="{{ URL::asset('js/editor.js') }}"></script>
<script src="{{ URL::asset('js/filestack-0.1.10.js') }}"></script>
<script src="https://unpkg.com/grapesjs"></script>
<script src="{{ URL::asset('dist/grapesjs-preset-webpage.min.js') }}"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
<div class="panel-main">
    @php $value = session('id'); @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div id="gjs" style="height:0px; overflow:hidden">
                    <div class="panel">
                        <h1 class="welcome">Welcome to</h1>
                        <div class="big-title">
                            <svg class="logo" viewBox="0 0 100 100">
                            <path d="M40 5l-12.9 7.4 -12.9 7.4c-1.4 0.8-2.7 2.3-3.7 3.9 -0.9 1.6-1.5 3.5-1.5 5.1v14.9 14.9c0 1.7 0.6 3.5 1.5 5.1 0.9 1.6 2.2 3.1 3.7 3.9l12.9 7.4 12.9 7.4c1.4 0.8 3.3 1.2 5.2 1.2 1.9 0 3.8-0.4 5.2-1.2l12.9-7.4 12.9-7.4c1.4-0.8 2.7-2.2 3.7-3.9 0.9-1.6 1.5-3.5 1.5-5.1v-14.9 -12.7c0-4.6-3.8-6-6.8-4.2l-28 16.2"/>
                            </svg>
                            <span>GrapesJS</span>
                        </div>
                        <div class="description">
                            This is a demo content from index.html. For the development, you shouldn't edit this file, instead you can copy and rename it to _index.html, on next server start the new file will be served, and it will be ignored by git.
                        </div>
                    </div>
                    <style>
                        .gjs-cv-canvas {
                            top: 0;
                            width: 100%;
                            height: 100%;
                        }
                        .panel {
                            width: 90%;
                            max-width: 700px;
                            border-radius: 3px;
                            padding: 30px 20px;
                            margin: 150px auto 0px;
                            background-color: #d983a6;
                            box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.25);
                            color:rgba(255,255,255,0.75);
                            font: caption;
                            font-weight: 100;
                        }

                        .welcome {
                            text-align: center;
                            font-weight: 100;
                            margin: 0px;
                        }

                        .logo {
                            width: 70px;
                            height: 70px;
                            vertical-align: middle;
                        }

                        .logo path {
                            pointer-events: none;
                            fill: none;
                            stroke-linecap: round;
                            stroke-width: 7;
                            stroke: #fff
                        }

                        .big-title {
                            text-align: center;
                            font-size: 3.5rem;
                            margin: 15px 0;
                        }

                        .description {
                            text-align: justify;
                            font-size: 1rem;
                            line-height: 1.5rem;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="button" style="text-align:center;">
    <button id="btnSave"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
</div>
<script type="text/javascript">
    //grapejs editor
    var editor = grapesjs.init({
        height: '100%',
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        fromElement: true,
        plugins: ['gjs-preset-webpage'],
        pluginsOpts: {
            'gjs-preset-webpage': {
                btnLabel: 'EXPORT',
                preHtml: '<!doctype><html><head><link rel="stylesheet" href="./css/style.css"></head><body>'
            }
        },
        storageManager: {
            type: 'remote',
            stepsBeforeSave: 0,
            autosave: false,         // Store data automatically
            urlStore: '{{ url("/store-template/$value") }}',
            autoload: true,         // Autoload stored data on init
            urlLoad: '{{ url("/load-template/$value") }}',
            // For custom parameters/headers on requests
            headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
            beforeSend: function() {
                console.log('before send');
            },
            contentTypeJson: true,
        },
        assetManager: {
            // Upload endpoint, set `false` to disable upload, default `false`
            upload: '{{ url("/template/images/$value") }}',

            // The name used in POST to pass uploaded files, default: `'files'`
            uploadName: 'files',

            // Custom headers to pass with the upload request
            headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
        },
    });

    editor.on('storage:end:store', (resultObject) => {
        if (resultObject.message) {
          alert(resultObject.message);
        }
        if(resultObject.sharelink){
            var nos = resultObject.sharelink;
            prompt("To Copy preview link: Ctrl+C", 'http://127.0.0.1:8000/template/'+nos);
        }
    });

    editor.on('storage:end:load', (resultObject) => {
        if (resultObject.url) {
            //$('#hash').val(resultObject.url);
        }
    });

    //editor.getSelected().addStyle({'background-image': `url(${url})`});

    $('#btnSave').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        editor.store(res => console.log('Store callback'));

        //editor.runCommand('gjs-export-zip');
    });
    
</script>
<style type="text/css">
#btnSave {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 18px;
    padding: 10px 30px;
    margin: 10px 0px 0px;
    border:0px;
    display:inline-block;
    background-color: #eee;
    background:#D682A4;
    border-radius:20px;
    color: #ffffff;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    &:hover {
        background:#333333;
        border-color: #999;
    }
    &:active {
    }
}
</style>
