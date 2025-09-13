<?php

namespace App\Http\Controllers\Student\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    const COUNT_ROWS = 20;

    public function homeStudents(){

        $gender = \request()->get('gender',null);

        $studentsQuery = Student::where('is_active', 1);

        if ($gender !== null) {
            $studentsQuery->where('gender', $gender);
        }

        $students = $studentsQuery->orderByRaw('ISNULL(row_no), row_no ASC')
            ->take(6)
            ->get();

        /*$students = Student::where('is_active' , 1)
            #->inRandomOrder()
            ->orderByRaw('ISNULL(row_no), row_no ASC')
            ->take(6)
            ->get();*/

        $ads = Ad::whereIn('position' , [9, 10])->get();

        return  response([
            'status'      => Response_Success,
            'data'        => [
                'students' => $students,
                'ads' => $ads,
            ],
        ]);

    }

    public function getStudents(){

        $gender = \request()->get('gender',null);
        $studentsQuery = Student::where('is_active' , 1);
        if ($gender !== null) {
            $studentsQuery->where('gender', $gender);
        }
        $students = $studentsQuery->orderByRaw('ISNULL(row_no), row_no ASC')->simplePaginate(self::COUNT_ROWS);

        return  response([
            'status'      => Response_Success,
            'count_brands'=>$students->count(),
            'data'         => $students->items(),

        ]);
        // return $this->responseSuccess($students);
    }

    public function getStudent($id){

        $students = Student::where('is_active' , 1)
            ->where('id',$id)->first();


        $products = Product::latest()
            //->inStock()
            ->where('in_sale','!=' , 1)
            ->customSelect(['is_recommended' , 'is_best'])
            ->whereRelation('students' , 'student_id' , '=' , $students->id)
            ->simplePaginate(self::COUNT_ROWS);


        $offers = Product::latest()
            //->inStock()
            ->customSelect(['is_recommended' , 'is_best'])
            ->whereRelation('students' , 'student_id' , '=' , $students->id)
            //->where('end_sale' , ">=" , Carbon::now()->format('Y-m-d'))
            ->where('in_sale' , 1)
            ->simplePaginate(self::COUNT_ROWS);

        return  response([
            'status'      => Response_Success,
            'brand'         => $students,
            'products'         => $products,
            'offers'         => $offers,
        ]);

    }



    public function getProducts(){
         $student = Student::whereId(\request('student_id'))
            ->first();
         $student->url = asset('/') . 'blogs/?id=' . $student->id;
        $products = Product::/*inStock()*/
            #->where('in_sale','!=' , 1)
            customSelect(['is_recommended' , 'is_best'])
            ->whereRelation('students' , 'student_id' , '=' , \request('student_id'));
            //->simplePaginate(self::COUNT_ROWS);

        $products = $this->ProductSort($products);

        $offers = [];/*Product::inStock()
            ->customSelect(['is_recommended' , 'is_best'])
            ->whereRelation('students' , 'student_id' , '=' , \request('student_id'))
            //->where('end_sale' , ">=" , Carbon::now()->format('Y-m-d'))
            ->where('in_sale' , 1);

        $offers = $this->ProductSort($offers);*/
        return $this->responseSuccess(['brand'=>$student,'offers'=>$offers,'products'=>$products]);

    }

    private function ProductSort($products){
        $sort=request()->sort ? :'random';//highestPrice,lowestPrice,bestSeller
        //dd($sort);
        switch ($sort) {
            case 'highestPrice':
                $products=$products
                    ->orderBy('regular_price','DESC')->simplePaginate(self::COUNT_ROWS);

                break;
            case 'lowestPrice':
                $products=$products
                    ->orderBy('regular_price','asc')->simplePaginate(self::COUNT_ROWS);

                break;
            case 'bestSeller':
                $products=$products
                    ->orderBy('id','desc')->simplePaginate(self::COUNT_ROWS);

                break;
            default:
                $products=$products->orderBy('id','desc')
                    ->simplePaginate(self::COUNT_ROWS);
                break;
        }
        return $products;
    }


    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ............  Methods Clean Code ............ ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    private function responseSuccess($items){
        $productsCount = 0;
        $productsCount_offer = 0;
        $items_pr=[];
        $items_of=[];
    if($items['products'] != null){
              $productsCount = $items['products']->count();
             $items_pr= $items['products']->items();

    }
    if($items['offers'] != null){
              $productsCount_offer = $items['offers']->count();
                           $items_of= $items['offers']->items();


    }

        return  response([
            'status'      => $productsCount > 0 || $productsCount_offer > 0 || !empty($items['brand'])  ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'countItems_offer'  => $productsCount_offer ,
            'data'        => [
              'brand'=>$items['brand'],
              'offers'=> $items_of,
              'products'=>$items_pr,
            ],
        ]);
    }

}
