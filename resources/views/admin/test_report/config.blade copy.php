@extends('layouts.main')
@section('content')


    <style>
        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgb(42 73 110 / 50%);
            border: 0.5cm solid #f1f2f9;
            position: relative;
        }
page *{
    border:1px dotted #ccc!important;
    content: "_name_";
    width: 100%;
}
        page header {

            position: absolute;
            width: 100%;
            top: 0;
        }

        page footer {
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        page body {
            padding: 2cm;
        }
page div
{ width: 100%;

}
        @media print {

            body,
            page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Test Report Configuration</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">Test Report Configuration</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                <div class="header-panel">
                    {{-- <a href="{{ route('admin.test.create') }}" class="load-popup  btn btn-rounded btn-primary py-1">
                        <span class="iconify" data-icon="mdi:thermometer-plus" data-width="15" data-height="15">
                        </span> ADD TEST</a> --}}

                </div>
                <div id="editor" class="position-relative">some text</div>
                <div class="statusBar"></div>
                {{-- <div class="row panel-config mb-2 d-none">


                    <div class="col-12">
                        <div class="row">
                            <div class="col-8">
                                <div id="searchPanel" class="searchPanel">
                                    <page size="A4">
                                        <header>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h3>Test Report</h3>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3>Test Report</h3>
                                                    </div>
                                                </div>
                                            </div>

                                        </header>

                                        <footer>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>Test Report</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3>Test Report</h3>
                                                </div>
                                            </div>
                                        </footer>
                                    </page>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">

                                    <div class="col-4">
                                        <label for="component">Component</label>
                                        <select class="form-control" name="component" id="component">
                                            @foreach ($components as $component)
                                                <option value="{{ $component }}">{{ $component }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-4">
                                        <label for="test_id">Test</label>
                                        <select class="form-control" name="test_id" id="test_id">
                                            @foreach ($tests as $test)
                                                <option value="{{ $test->id }}">{{ $test->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>





                                </div>

                            </div>
                        </div>

                    </div>


                </div> --}}

        </section>
    </div>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/theme-twilight.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/mode-javascript.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/mode-html.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/mode-css.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/mode-php.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/keybinding-vscode.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/ext-statusbar.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('skydash/vendors/ace-builds/src-min/ext-textarea.js')}}" type="text/javascript" charset="utf-8"></script>
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
        editor.setOptions({
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true
        });
        var ExtStatusbar = ace.require("ace/ext/statusbar").StatusBar;
        var statusBar = new ExtStatusbar(editor, document.getElementById("statusBar"));
        var ExtTextarea = ace.require("ace/ext/textarea").TextArea;
        var textarea = new ExtTextarea(editor);


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
        });
    </script>
@endsection
