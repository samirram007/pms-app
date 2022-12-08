@extends('layouts.main')
@section('content')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href={{ asset('css/report.css') }} rel="stylesheet" />
    <style>
        #editor {
            position: relative;
            width: calc(100% - 30px);
            height: 80vh;
        }

        .pe-auto {
            cursor: pointer;
            padding-bottom: 1rem;

        }
        .ace_editor div, .ace_editor span { font-size: 16px !important; }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Test Report Preparation</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">Test Report Preparation</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                {{-- <div class="header-panel">
                    <a href="{{ route('admin.test.create') }}" class="load-popup  btn btn-rounded btn-primary py-1">
                        <span class="iconify" data-icon="mdi:thermometer-plus" data-width="15" data-height="15">
                        </span> ADD TEST</a>
                    <div class="p-4">
                        <button class="btn btn-primary" onclick="loadcode()">Load</button>
                        <button class="btn btn-primary" onclick="savecode()">Save</button>
                    </div>

                </div> --}}

                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Pills</h4>
                        <p class="card-description">Basic nav pills</p> --}}
                        <ul class="nav nav-pills nav-pills-success pe-auto ">
                            <li class=" nav-item  ">
                                <div id="load_tab" class="nav-link d-none   border border-info text-primary "
                                    onclick="resetcode()">Reset</div>
                                <div id="" class="nav-link   border border-info text-primary "
                                    onclick="resetcode()">Reset</div>
                            </li>
                            <li class=" nav-item ">
                                <div id="save_tab" class="nav-link border border-info text-primary" onclick="savecode()">
                                    Save</div>
                            </li>
                            <li class=" nav-item d-none">
                                <div id="home_tab" class="nav-link   d-none">CODE</div>
                            </li>
                            <li class="nav-item ">
                                <div id="html_tab" class="nav-link active">Prepare</div>
                            </li>
                            <li class="nav-item d-none">
                                <div id="preview_tab" class="nav-link ">PDF VIEW</div>
                            </li>
                            <li class="nav-item d-none">
                                <div  onclick="{{route('employee.test_queue.getpdf',$test_queue->id)}}" class="nav-link ">Print</div>
                            </li>
                            <li class="nav-item ">
                                <a  class="nav-link"  href="{{ route('employee.test_queue.getpdf',$test_queue->id) }}" >PDF</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane d-none  fade">
                                <div id="editor">
                                    {{ __(
                                        '
                                                                                                                    <page size="A4">
                                                                                                                        <header>
                                                                                                                            ' .
                                            $config_header .
                                            '
                                                                                                                        </header>
                                                                                                                        This is Hello World
                                                                                                                        <footer>
                                                                                                                            ' .
                                            $test->name .
                                            '
                                                                                                                        </footer>
                                                                                                                    </page>',
                                    ) }}
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane active">
                                <div id="preview" class="position-relative">
                                    @if($test_queue->code==null || $test_queue->code=='')
                                    {!!$test_report_configs->first()->html!!}
                                    @else
                                    {!!$test_queue->code!!}
                                    @endif
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div id="pdf_view" class="position-relative">some text</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- tab container --}}


            </div>


        </section>



    </div>
    {{-- #home click trigger --}}
    <div id="config_header_load" class="sr-only">
        {!! $config_header !!}
    </div>
    <script>
        $(document).ready(function() {
            var h=$('#config_header_load').html();
              //  console.log(h);
                $("#config_header").html(h);
                $(".config_header").html(h);
            $('#preview_tab').click();
            $('#home_tab').on('click', function() {
                //console.log('I am Clicked');
                if(!$('#home_tab').hasClass('active')){
                    $('#home_tab').addClass('active');
                }
                if($('#html_tab').hasClass('active')){
                    $('#html_tab').removeClass('active');
                }

                if($('#preview_tab').hasClass('active')){
                    $('#preview_tab').removeClass('active');
                }

                if( !$('#home').hasClass('active')){
                    $('#home').addClass('active');
                    $('#menu1').removeClass('fade');
                }
                if( $('#menu1').hasClass('active')){
                    $('#menu1').removeClass('active');
                    $('#menu1').addClass('fade');
                }
                if( $('#menu2').hasClass('active')){
                    $('#menu2').removeClass('active');
                    $('#menu2').addClass('fade');
                }


            });

            $('#html_tab').on('click', function() {

                if($('#home_tab').hasClass('active')){
                    $('#home_tab').removeClass('active');
                }
                if(!$('#html_tab').hasClass('active')){
                   // console.log($('#config_header').html());


                    $('#html_tab').addClass('active');
                }

                if($('#preview_tab').hasClass('active')){
                    $('#preview_tab').removeClass('active');
                }

                if( $('#home').hasClass('active')){
                    $('#home').removeClass('active');
                    $('#menu1').addClass('fade');
                }
                if( !$('#menu1').hasClass('active')){
                    $('#menu1').addClass('active');
                    $('#menu1').removeClass('fade');
                }
                if( $('#menu2').hasClass('active')){
                    $('#menu2').removeClass('active');
                    $('#menu2').addClass('fade');
                }
                runcode();
            });
            $('#preview_tab').on('click', function() {

                if($('#home_tab').hasClass('active')){
                    $('#home_tab').removeClass('active');
                }
                if($('#html_tab').hasClass('active')){
                    $('#html_tab').removeClass('active');
                }

                if(!$('#preview_tab').hasClass('active')){
                    $('#preview_tab').addClass('active');
                }
                if( $('#home').hasClass('active')){
                    $('#home').removeClass('active');
                    $('#menu1').addClass('fade');
                }
                if( $('#menu1').hasClass('active')){
                    $('#menu1').removeClass('active');
                    $('#menu1').addClass('fade');
                }
                if( !$('#menu2').hasClass('active')){
                    $('#menu2').addClass('active');
                    $('#menu2').removeClass('fade');
                }

                runpdf();
            });

        });
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.1.1/jspdf.umd.min.js"​></script> --}}
    {{-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/ace.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/theme-vibrant_ink.min.js" integrity="sha512-hriDlT8XFivOyx1nh9GenjGiWRBRz0O2GEY8XsXS3VDfjctyVXnDa09uskccVy5ve881WgseErBNk+J/19V1UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/theme-twilight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/mode-javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/mode-php_laravel_blade.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/snippets/php_laravel_blade.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/mode-html.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/mode-css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/mode-php.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/mode-autohotkey.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/keybinding-vscode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/ext-statusbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/ext-textarea.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/ext-language_tools.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.6/ext-searchbox.js"></script>

    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/twilight");
        var JavaScriptMode = ace.require("ace/mode/javascript").Mode;
        editor.session.setMode(new JavaScriptMode());
        var HtmlMode = ace.require("ace/mode/html").Mode;
        editor.session.setMode(new HtmlMode());
        var CssMode = ace.require("ace/mode/css").Mode;
        editor.session.setMode(new CssMode());
        var PhpMode = ace.require("ace/mode/php").Mode;
        editor.session.setMode(new PhpMode());
        var AutohotkeyMode = ace.require("ace/mode/autohotkey").Mode;
        editor.session.setMode(new AutohotkeyMode());
        var PhpLaravelBladeMode = ace.require("ace/mode/php_laravel_blade").Mode;
        editor.session.setMode(new PhpLaravelBladeMode());



        editor.setOptions({
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true,
            fontSize: "14pt",
            fontFamily: "monospace",
        });
        editor.setKeyboardHandler("ace/keyboard/vscode");
          editor.resize();
        var SearchBox = ace.require("ace/ext/searchbox");
        // editor.session.addDynamicMarker(new SearchBox(editor), true);
    </script>
    <script>
        function runcode() {
            var code = editor.getValue();
            var preview = document.getElementById('preview');
            preview.innerHTML = code;
            editor.setValue(code);
            editor.setValue("text2", -1); // set value and move cursor to the start of the text
            editor.session.setValue(code); // set value and reset undo history
            editor.getValue(); // or session.getValue
        }
        // function runpdf() {
        //     var code = editor.getValue();
        //     var preview = document.getElementById('pdf_view');
        //     preview.innerHTML = code;
        //     editor.setValue(code);
        //     editor.setValue("text2", -1); // set value and move cursor to the start of the text
        //     editor.session.setValue(code); // set value and reset undo history
        //     editor.getValue(); // or session.getValue
        // }
        function savecode() {
            var code = editor.getValue();
            var test_queue_id = {{ $test_queue->id }};
            if($('#menu1').hasClass('active')){
                code = $('#preview').html();

            }
            //  console.log(code);
            //  console.log(test_id);

            $.ajax({
                type: "POST",
                url: "{{ route('employee.test_prepare.savecode') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,
                    "test_queue_id": test_queue_id,
                },
                success: function(response) {
                    // toastr('success','code updated');
                    toastr.info('code updated');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function loadcode() {
            var test_id = {{ $test->id }};
            $.ajax({
                type: "GET",
                url: "{{ route('loadcode') }}",
                data: {
                    "test_id": test_id,
                },
                success: function(response) {
                    // console.log(response.html);
                    editor.setValue(response.html, -1);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        function resetcode() {
            var test_queue_id = {{ $test_queue->id  }};
            $.ajax({
                type: "GET",
                url: "{{ route('employee.test_queue.resetcode') }}",
                data: {
                    "test_queue_id": test_queue_id,
                },
                success: function(response) {
                    // console.log(response.html);
                    window.location.reload();
                    //editor.setValue(response.html, -1);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
    <script>

        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                lengthChange: false,
                select: true,
                searching: [
                    "Name",
                    "Price",
                    "Description"
                ],
                aling: "center",
                highlight: true,
            });


            loadcode();
            //ctrl + s when editor is focused


        });
        var isCtrl = false;
        window.addEventListener('load', function() {
           window.addEventListener('keydown', function(e) {
                if (e.keyCode == 17) {
                    e.preventDefault();
                    isCtrl = true;
                }
                if (e.keyCode == 83 && isCtrl) {
                    e.preventDefault();
                    // your save logic goes here
                    console.log('save');
                    savecode();
                    isCtrl = false;

                    // document.getElementById('status').innerHTML = 'saved';
                }
            });


        });



    </script>
@endsection
