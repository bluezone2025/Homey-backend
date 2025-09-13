<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfoRequest;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    private $infoType;



    public function __construct()
    {
        $this->middleware('haveRole:info.index')->only('index');
        $this->middleware('haveRole:info.create')->only(['create' , 'store']);
        $this->middleware('haveRole:info.update')->only('update');
        $this->middleware('haveRole:info.destroy')->only('destroy');


        $infoTypeNames = ['about', 'TermsAndConditions', 'privacyPolicy', 'question', 'howToUse'];

        $url = \request()->segments();

        $this->infoType = $url[1] === 'sort'?  $url[2]  : $url[1];


        if (!in_array($this->infoType , $infoTypeNames)) {

            abort(404);
        }

    }

    public function index(){

        $info = Info::where('type' , $this->infoType)
            ->orderBy('sort', 'desc')
            ->get(['id' ,'name' , 'description_ar' , 'description_en']);

        return view('admin.pages.info.index')->with([
            'info' => $info,
            'infoType' => $this->infoType,
        ]);
    }


    public function create(){

        return view('admin.pages.info.create')->with([
            'infoType' => $this->infoType,
        ]);
    }

    public function store(InfoRequest $request)
    {

        Info::create($this->columnsDB($request));

        return back()->with('success' , __('form.response.create info'));

    }


    public function edit($id){

        $info = Info::where('type', $this->infoType)->findOrFail($id);

        return view('admin.pages.info.edit')->with([
            'info' => $info,
            'infoType' => $this->infoType,
        ]);
    }


    public function update(InfoRequest $request , $id){

        Info::where('id' , $id)
            ->where('type' , $this->infoType)
            ->update($this->columnsDB($request));

        return back()->with('success' , __('form.response.update info'));

    }

    public function destroy($id){

        Info::where('id' , $id)
            ->where('type' , $this->infoType)
            ->delete();

        return 'success';

    }


    public function sortShow(){

        $info = Info::where('type' , $this->infoType)->orderBy('sort', 'desc')->get();

        return view('admin.pages.info.sort')->with([
            'info' => $info,
            'infoType' => $this->infoType,
        ]);

    }


    public function sortSave(){

        $this->sortInfoData(\request('infos'));

        return back();
    }

    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request){

        return [

            'name'           => $request->name,
            'description_ar'  => $request->description_ar,
            'description_en'  => $request->description_en,
            'type'            => $this->infoType,
        ];
    }



    private function sortInfoData($info){

        $sortNumber = 1;

        foreach (array_reverse($info) as $data_id):

            Info::where('id' , $data_id)->update([
                'sort' => $sortNumber
            ]);

            $sortNumber++;
        endforeach;
    }
}
