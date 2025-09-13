<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserSearch;
use App\Models\Setting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use function Symfony\Component\Translation\t;

class SearchProductController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth.guard:web-api')->only('get_my_search');

      if(request()->header('auth-token')){
        $this->middleware('auth.guard:web-api');
      }
    }

    public function get_my_search()
    {

        $texts = auth()->user()
            ->texts_search()->select('id','text')->orderBy('created_at', 'desc')->simplePaginate(20);

        return response([
            'status' => $texts ? Response_Success : Response_Fail,
            'texts' => $texts,
        ]);
    }

    public function search(Request $request)
    {

      $v=['text' => ['required']];

        $validator = Validator::make($request->all(), $v);
        if ($validator->errors()->count() > 0 ) {

            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->first(),
            ]);
        }
      if(request()->header('auth-token')){
        $old_search=UserSearch::where('text',$request->text)->first();
        if(!$old_search){
          UserSearch::create([
            'user_id'=>auth()->id(),
            'text'=>$request->text
          ]);
        }
      }

    $data['product']=Product::where('name_en','LIKE','%'.$request->text.'%')
                              ->orwhere('name_ar','LIKE','%'.$request->text.'%')->orderBy('id','desc');


    $data['product']=  $data['product']->simplePaginate(100);
    $data['categories']=Category::where('name_en','LIKE','%'.$request->text.'%')
                              ->orwhere('name_ar','LIKE','%'.$request->text.'%')->get();
    if ($request->has('gender')){
        $data['brands']=
            Student::where(function($query) use ($request) {
                $query->where('name_ar', 'LIKE', '%' . $request->text . '%')
                    ->where('gender', $request->get('gender'));
            })->orWhere(function($query) use ($request) {
                    $query->where('name_en', 'LIKE', '%' . $request->text . '%')
                        ->where('gender', $request->get('gender'));
            })->get();
    }else{
        $data['brands']=Student::where('name_ar','LIKE','%'.$request->text.'%')->orwhere('name_en','LIKE','%'.$request->text.'%')->get();
    }


        return response([
            'status' => Response_Success ,
            'orders' => $data,
        ]);
    }


}
