<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    const COUNT_ROWS = 20;


    public function getStudents(){

        $students = Student::where('is_active',1)->latest()
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($students);
    }





    private function responseSuccess($products){

        $productsCount = $products->count();

        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'data'        => $products->items() ,
        ]);
    }

}
