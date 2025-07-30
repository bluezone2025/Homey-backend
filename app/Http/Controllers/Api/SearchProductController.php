<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Product;
use App\Category;
use App\Models\UserSearch;
use App\Setting;
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
            ->texts_search()->select('id','text')->orderBy('created_at', 'desc')->simplePaginate(10);

        return response([
            'status' => $texts ? Response_Success : Response_Fail,
            'texts' => $texts,
        ]);
    }
    
    
    public function delete_my_search(Request $request)
    {
        if($request->text_id >= 1){
            UserSearch::where('id',$request->text_id)->delete();
            
        }else{
            UserSearch::where('user_id',auth()->user()->id)->delete();
        }
        
        return response([
            'status' => Response_Success ,
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

    $data['product']=Product::where('title_en','LIKE','%'.$request->text.'%')
                              ->orwhere('title_ar','LIKE','%'.$request->text.'%')->where('appearance', 1)->simplePaginate(15);


    // $data['categories']=Category::where('name_en','LIKE','%'.$request->text.'%')
    //                           ->orwhere('name_ar','LIKE','%'.$request->text.'%')->get();

        return response([
            'status' => Response_Success ,
            'data' => $data,
        ]);
    }


}
