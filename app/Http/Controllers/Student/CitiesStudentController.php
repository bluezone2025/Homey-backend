<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\countries_student;
use App\Models\Country;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;

use App\Models\cities_student;
use Illuminate\Http\Request;

class CitiesStudentController extends Controller
{
    use MDT_Method_Action , MDT_Query , MDT_UploadImag;
    public function __construct()
    {
        $this->lang = app()->getLocale();

    }
    public function index()
    {
        //
        $student_id = auth('student')->user()->getAuthIdentifier();
        $cities_student  = cities_student::where('student_id',$student_id)->get();
        $cities_student_ids  = cities_student::where('student_id',$student_id)->pluck('area_id');

        $areas_no_edit = Area::whereNotIn('id',$cities_student_ids)->get();

        return view('student.pages.areas.index',compact('cities_student','areas_no_edit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student_id = auth('student')->user()->getAuthIdentifier();

        $countries  = countries_student::where('student_id',$student_id)->get(['id' , "name_$this->lang"]);

        return  view('student.pages.areas.create')->with([

            'countries' => $countries,
            'lang' => $this->lang
        ]);
    }

    public function edit($id)
    {
        $area = Area::find($id);

        $student_id = auth('student')->user()->getAuthIdentifier();


        return  view('student.pages.areas.create')->with([

            'lang' => $this->lang,
            'area' => $area
        ]);
    }

    public function store(Request $request)
    {
        $student_id = auth('student')->user()->getAuthIdentifier();

        $request->validate([
            'name_ar'        => [ 'required' , 'string' , 'max:100'],
            'name_en'        => [ 'required' , 'string' , 'max:100'],
            'slug'           => [ 'nullable' , 'string' , 'max:100'],
            'shipping_price' => [ 'required' , 'numeric'],
            'shipping_time' => [ 'required' , 'numeric'],
            'country_id'     => [ 'required' , 'integer'],

        ]);

        cities_student::create([
            'student_id' => $student_id,
            'name_ar'        => $request->name_ar,
            'name_en'        => $request->name_en,
            'slug'           => strlen($request->slug) ? $request->slug : \Str::slug($request->name_ar),
            'shipping_price' => $request->shipping_price,
            'shipping_time' => $request->shipping_time,
            'country_id'     => $request->country_id,
        ]);



        return  back()->with('success' ,__('form.response.create area'));
    }


    public function update(Request $request, $id)
    {
        $student_id = auth('student')->user()->getAuthIdentifier();
        $request->validate([
            'shipping_price' => [ 'required' , 'numeric'],
            'shipping_time' => [ 'required' , 'numeric'],
        ]);
        // check student has this area or not
        $area = cities_student::where('student_id',$student_id)->where('area_id',$id)->first();
        if ($area){
             $area->update([
                    'shipping_price'    => $request->shipping_price,
                    'shipping_time'     => $request->shipping_time,
                ]);
        }else{

            cities_student::create([
                'shipping_price'    => $request->shipping_price,
                'shipping_time'     => $request->shipping_time,
                'area_id'           => $id,
                'student_id'        => $student_id,
            ]);
        }

        return redirect()->route('student.areas.index')->with(['status' => 'success' , 'message' => __('form.response.update area')]);

        //return response(['status' => 'success' , 'message' => __('form.response.update area')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(cities_student::class , $id);
    }


    public function restore($id)
    {

        return $this->MDT_restore(cities_student::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(cities_student::class , $id);
    }
}
