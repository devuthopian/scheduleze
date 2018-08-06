<link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('dist/grapesjs-preset-webpage.min.css') }}">
<script src="{{ URL::asset('js/editor.js') }}"></script>
<script src="{{ URL::asset('js/filestack-0.1.10.js') }}"></script>
<script src="https://unpkg.com/grapesjs"></script>
<script src="{{ URL::asset('dist/grapesjs-preset-webpage.min.js') }}"></script>
<script src="{{ URL::asset('dist/grapesjs-lory-slider.min.js') }}"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
@include('layouts.includes.front.header')
<div class="panel-main">
    @php $value = session('id'); @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div id="gjs" style="height:0px; overflow:hidden">
                        <!-- <h1 class="welcome">Welcome to</h1>
                        <div class="big-title">
                            <svg class="logo" viewBox="0 0 100 100">
                            <path d="M40 5l-12.9 7.4 -12.9 7.4c-1.4 0.8-2.7 2.3-3.7 3.9 -0.9 1.6-1.5 3.5-1.5 5.1v14.9 14.9c0 1.7 0.6 3.5 1.5 5.1 0.9 1.6 2.2 3.1 3.7 3.9l12.9 7.4 12.9 7.4c1.4 0.8 3.3 1.2 5.2 1.2 1.9 0 3.8-0.4 5.2-1.2l12.9-7.4 12.9-7.4c1.4-0.8 2.7-2.2 3.7-3.9 0.9-1.6 1.5-3.5 1.5-5.1v-14.9 -12.7c0-4.6-3.8-6-6.8-4.2l-28 16.2"/>
                            </svg>
                            <span>GrapesJS</span>
                        </div> -->
                        <div class="description">
                            This is demo represemtation for your div, you can it with your suitable choice.
                        </div>
                    </div>
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
        plugins: [/*'gjs-plugin-forms',*/'gjs-preset-webpage'],
        pluginsOpts: {
            /*'gjs-plugin-forms': {
                labelForm: 'Appointment Form'
            },*/
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
            var url = window.location.href;
            var afterWith = url.substr(0, url.lastIndexOf("/") + 1);            
            prompt("To Copy preview link: Ctrl+C", afterWith+''+nos);
        }
    });

    editor.StyleManager.addProperty('Decorations', {
        name: 'Gradient',
        property: 'background-image',
        type: 'gradient',
        defaults: 'none'
    });

    editor.on('storage:end:load', (resultObject) => {
        if (resultObject.url) {
            console.log(resultObject.gjs-html);
        }
    });

    //editor.getSelected().addStyle({'background-image': `url(${url})`});

    $('#btnSave').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        editor.store(res => console.log('Store callback'));

        //editor.runCommand('gjs-export-zip');
    });

/*
    // Get DomComponents module
    var comps = editor.DomComponents;

    // Get the model and the view from the default Component type
    var defaultType = comps.getType('default');
    var defaultModel = defaultType.model;
    var defaultView = defaultType.view;

    var inputTypes = [
      {value: 'text', name: 'Text'},
      {value: 'email', name: 'Email'},
      {value: 'password', name: 'Password'},
      {value: 'number', name: 'Number'},
      {value: 'date', name: 'Date'},
    ];

    // The `input` will be the Component type ID
    comps.addType('input', {
      // Define the Model
      model: defaultModel.extend({
        // Extend default properties
        defaults: Object.assign({}, defaultModel.prototype.defaults, {
          // Can be dropped only inside `form` elements
          draggable: 'form, form *',
          // Can't drop other elements inside it
          droppable: false,
          // Traits (Settings)
          traits: ['name', 'placeholder', {
              // Change the type of the input (text, password, email, etc.)
              type: 'select',
              label: 'Type',
              name: 'type',
              options: inputTypes,
            },{
              // Can make it required for the form
              type: 'checkbox',
              label: 'Required',
              name: 'required',
          }],
        }),
      },
      // The second argument of .extend are static methods and we'll put inside our
      // isComponent() method. As you're putting a new Component type on top of the stack,
      // not declaring isComponent() might probably break stuff, especially if you extend
      // the default one.
      {
        isComponent: function(el) {
          if(el.tagName == 'INPUT'){
            return {type: 'input'};
          }
        },
      }),

      // Define the View
      view: defaultType.view,
    });

    var blockManager = editor.BlockManager;

    // 'my-first-block' is the ID of the block
    blockManager.get('form').set({
        label: '<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path class="gjs-block-svg-path" d="M22,5.5 C22,5.2 21.5,5 20.75,5 L3.25,5 C2.5,5 2,5.2 2,5.5 L2,8.5 C2,8.8 2.5,9 3.25,9 L20.75,9 C21.5,9 22,8.8 22,8.5 L22,5.5 Z M21,8 L3,8 L3,6 L21,6 L21,8 Z" fill-rule="nonzero"></path> <path class="gjs-block-svg-path" d="M22,10.5 C22,10.2 21.5,10 20.75,10 L3.25,10 C2.5,10 2,10.2 2,10.5 L2,13.5 C2,13.8 2.5,14 3.25,14 L20.75,14 C21.5,14 22,13.8 22,13.5 L22,10.5 Z M21,13 L3,13 L3,11 L21,11 L21,13 Z" fill-rule="nonzero"></path> <rect class="gjs-block-svg-path" x="2" y="15" width="10" height="3" rx="0.5"></rect> </svg><div class="gjs-block-label">Appointment Form</div>',
        content: '<form class="form" data-gjs-type="form" data-highlightable="1" action="{{ url("/template/store/$value") }}" method="post">@csrf<div class="form-group gjs-comp-selected" data-gjs-type="default" data-highlightable="1"><label class="label" data-gjs-type="label" data-highlightable="1">Name</label><input type="text" name="txtName" class="input" data-gjs-type="input" placeholder="Type here your name" data-highlightable="1"></div><div class="form-group" data-gjs-type="default" data-highlightable="1"><label class="label" data-gjs-type="label" data-highlightable="1">Email</label><input class="input" data-gjs-type="input" type="email" name="txtEmail" placeholder="Type here your email" data-highlightable="1"></div><div class="form-group" data-gjs-type="default" data-highlightable="1"><label class="label" data-gjs-type="label" for="Appointment date" data-highlightable="1">Appointment Date</label><input class="input" data-gjs-type="input" type="text" id="timepicker-actions" required="true" name="txtAppointmentDate" data-highlightable="1"></div><div class="form-group" data-gjs-type="default" data-highlightable="1"><label class="label" data-gjs-type="label" data-highlightable="1">Gender</label><input class="checkbox" data-gjs-type="checkbox" type="radio" name="txtGender" value="M" data-highlightable="1"><label class="checkbox-label" data-gjs-type="label" data-highlightable="1">M</label><input class="checkbox" data-gjs-type="checkbox" type="radio" name="txtGender" value="F" data-highlightable="1"><label class="checkbox-label" data-gjs-type="label" data-highlightable="1">F</label></div><div class="form-group" data-gjs-type="default" data-highlightable="1"><label class="label" data-gjs-type="label" data-highlightable="1">Message</label><textarea class="textarea" name="textareaMessage" data-gjs-type="textarea" data-highlightable="1"></textarea></div><div class="form-group" data-gjs-type="default" data-highlightable="1"><button class="button" data-gjs-type="button" type="submit" data-highlightable="1">Send</button></div></form>'
    });*/
    
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
}
</style>
