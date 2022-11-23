<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\LabCentre;
use Illuminate\Http\Request;
use App\Models\TestReportConfig;
use App\Http\Controllers\Controller;

class TestReportController extends Controller
{
    protected $section=[
        'header'=>'header',
        'footer'=>'footer',
        'body'=>'body',
    ];
    protected $cols=[1,2,3,4,5,6,7,8,9,10,11,12];
    protected $no_of_pages=[1,2,3,4,5];
    protected $pages=[
        'A4'=>[210,297],
        'A3'=>[297,420],
        'A2'=>[420,594],
        'A1'=>[594,841],
        'A0'=>[841,1189],
    ];
    protected $fonts=[
        'Arial',
        'Times New Roman',
        'Courier New',
        'Verdana',
        'Tahoma',
        'Trebuchet MS',
        'Georgia',
        'Palatino Linotype',
        'Garamond',
        'Bookman Old Style',
        'Comic Sans MS',
        'Impact',
        'Lucida Console',
        'Lucida Sans Unicode',
        'MS Sans Serif',
        'MS Serif',
        'Symbol',
        'Webdings',
        'Wingdings',
        'Wingdings 2',
        'Wingdings 3',
    ];
    protected $fontSizes=[
        8,9,10,11,12,14,16,18,20,22,24,26,28,36,48,72,
    ];
    protected $fontStyles=[
        'normal',
        'bold',
        'italic',
        'underline',
    ];
    protected $aligns=[
        'left',
        'center',
        'right',
    ];
    protected $valigns=[
        'top',
        'middle',
        'bottom',
    ];
    protected $borderStyles=[
        'solid',
        'dashed',
        'dotted',
        'double',
        'groove',
        'ridge',
        'inset',
        'outset',
        'none',
    ];
    protected $borderWidths=[
        0,1,2,3,4,5,6,7,8,9,10,
    ];
    protected $borderColors=[
        'black',
        'red',
        'green',
        'blue',
        'yellow',
        'magenta',
        'cyan',
        'white',
    ];
    protected $backgroundColors=[
        'black',
        'red',
        'green',
        'blue',
        'yellow',
        'magenta',
        'cyan',
        'white',
    ];
    protected $textColors=[
        'black',
        'red',
        'green',
        'blue',
        'yellow',
        'magenta',
        'cyan',
        'white',
    ];

    protected $components = [

        'content'=>'content',

        'section'=>'section',
        'table'=>'table',
        'div'=>'div',
        'span'=>'span',
        'p'=>'p',
        'input'=>'input',
        'test'=>'test',
        'label'=>'label',
        'textarea' => 'textarea',
        'select' => 'select',
    ];

    public function config($id)
    {
        $user=auth()->user();
        $data['lab_center'] = LabCentre::where('id',$user->lab_centre_id)->first();
        $data['test'] = Test::find($id);
        // dd($data['test']);
        $data['tests'] = Test::where('is_package', 0)->get();
        $data['test_report_configs'] = TestReportConfig::where('test_id', $id)->get();
        $data['components'] = $this->components;
        return view('admin.test_report.config', $data);
    }
}
