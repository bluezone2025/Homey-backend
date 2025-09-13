<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Http\Requests\Student\CountriesStudentRequest;
use App\Models\countries_student;
use App\Models\Currency;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;
use Illuminate\Http\Request;

class CountriesStudentController extends Controller
{
    use MDT_Method_Action , MDT_Query , MDT_UploadImag;

    public function index()
    {
        $student_id = auth('student')->user()->getAuthIdentifier();
        $is_trash  = \request()->segment(2) === 'trash';
        $currencies = Currency::get(['id' , "name"])
            ->pluck("name" , 'id')->all();

        return  $this->MDT_Query_method(// Start Query
            countries_student::class ,
            'student/pages/countries/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'    => ['currencies' => $currencies,'is_trash' => $is_trash],
                'condition' => ['where' , 'student_id' , '=' , $student_id],
            ]

        ); // end query
    }

    public function create()
    {
        $currencies  = Currency::latest('id')->get(['id' , "name"]);

        return  view('student.pages.countries.create')->with([
            'currencies' => $currencies,
        ]);;
    }

    public function store(Request $request)
    {
//        $pagesUpdate =  request()->route()->methods[0] === 'POST';
        $request->validate([
            'name_ar'    => ['required' , 'string' , 'max:50'],
            'name_en'    => ['required' , 'string' , 'max:50'],
            'code_phone' => ['required' , 'string' , 'max:50'],
            'flag'       => ['required', 'image'  , 'mimes:jpeg,jpg,png', 'max:10000'],
            'slug'       => ['nullable' , 'string' , 'max:50'],
            'count_number_phone' => ['required' , 'integer'],

        ]);

//        dd($this->columnsDB($request));



        countries_student::create($this->columnsDB($request));

        return  back()->with('success' ,  __('form.response.create country'));



    }

    public function show(countries_student $countries_student)
    {
        //
    }

    public function edit(countries_student $countries_student)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar'    => ['required' , 'string' , 'max:50'],
            'name_en'    => ['required' , 'string' , 'max:50'],
            'code_phone' => ['required' , 'string' , 'max:50'],
            'flag'       => ['required', 'image'  , 'mimes:jpeg,jpg,png', 'max:10000'],
            'slug'       => ['nullable' , 'string' , 'max:50'],
            'count_number_phone' => ['required' , 'integer'],

        ]);

        $country = countries_student::withTrashed()->findOrFail($id);

        $country->update($this->columnsDB($request , $country));

        return response([
            'status' => 'success' ,
            'message' =>  __('form.response.update country'),
            'url' => ['flag' => asset("assets/images/flags/$country->flag")]
        ]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(countries_student::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(countries_student::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(countries_student::class , $id);
    }
    public function columnsDB($request , $country=null){

        $student_id = auth('student')->user()->getAuthIdentifier();
        $flag = $this->MDT_saveImage($request->flag , $request->name_en , 'assets/images/flags');

        if ($request->flag && $country) {

            $this->MDT_deleteImage($country->flag , 'assets/images/flags');
        }

        return [
            'student_id' => $student_id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'slug' => strlen($request->slug) > 0 ? \Str::slug($request->slug)  : \Str::slug($request->name_en),
            'code_phone' => $request->code_phone,
            'count_number_phone' => $request->count_number_phone,
            'currency_id' => $request->currency_id,
            "flag" =>  $flag ?? $country->flag,
        ];
    }
}
