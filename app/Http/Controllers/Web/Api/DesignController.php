<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\DesignRating;
use App\Models\DesignImage;
use App\Models\Design;
use Illuminate\Http\Request;

class DesignController extends Controller
{

  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct() {

      $this->middleware('auth.guard:web-api')->only(['saveRating','editRating','deleteRating']);
  }

    public function index(){
        $designs = Design::where('status' , 1)
            ->simplePaginate(15);
        return response([

            'status' => count($designs) > 0 ? Response_Success : Response_Fail,
            'data' => $designs

        ]);
    }
    public function show($id){
        $design = Design::whereId( $id)->where('status' , 1)
            ->get();
        return response([

            'status' => count($design) > 0 ? Response_Success : Response_Fail,
            'data' => $design

        ]);
    }
    public function getRatings($id){
        $ratings = DesignRating::where('design_id',$id)->where('status' , 1)->with('user')->simplePaginate(20);

        return response([

            'status' => count($ratings) > 0 ? Response_Success : Response_Fail,
            'data' => $ratings

        ]);
    }
    public function request(Request $request)
    {

          $validator = \Validator::make($request->all(), [
            'user_name' => 'required|string|between:2,100',
            'phone' => 'required|string|max:20',
            'design_name' => 'required|string|between:2,300',
            'note' => 'required|string',
            'email' => 'required|string|email|max:100',
            'image' => 'array',
            'image.*' => 'required|image|max:10000',
          ]);

          if($validator->fails()){
              return response([
                  'status'  => Response_Fail,
                  'message' => $validator->errors()->all(),
              ]);
          }
          $requestDesign=Design::create([
            'user_name' => $request->user_name ,
            'phone' => $request->phone ,
            'design_name' => $request->design_name ,
            'note' => $request->note ,
            'email' => $request->email ,
          ]);

          if($request->hasFile('image')){

            foreach ($request->File('image') as $k =>  $img) {

                $imgName = $requestDesign->id.'_'.$k.'_'.time().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('assets/images/designs') , $imgName);

                DesignImage::create([
                    'src'=>'public/assets/images/designs/'.$imgName,
                  	'design_id'=>$requestDesign->id
                ]);
            }
          }
        return response([

            'status' =>  Response_Success ,
            'message'=>__('request success'),
            'data' => $requestDesign
        ]);
    }
    public function saveRating(Request $request)
    {

          $validator = \Validator::make($request->all(), [
            'design_id'      => ['required' , 'integer' , 'exists:designs,id'],
            'rating'      => ['required' , 'integer' , 'in:1,2,3,4,5'],
            'comment'     => ['nullable' , 'string' , 'max:255'],
          ]);

          if($validator->fails()){
              return response([
                  'status'  => Response_Fail,
                  'message' => $validator->errors()->all(),
              ]);
          }
          $oldDesign=DesignRating::where('design_id',$request->design_id)->where('user_id',auth()->id())->first();
          if($oldDesign){
            return response([
                'status'  => Response_Fail,
                'message' => __('api.errors.cantRate'),
            ]);
          }
          $requestDesign=DesignRating::create([
            'rating' => $request->rating ,
            'comment' => $request->comment ,
            'design_id' => $request->design_id ,
            'status'=>1,
            'user_id' => auth()->id() ,
          ]);


        return response([

            'status' =>  Response_Success ,
            'message'=>__('request success'),
            'data' => $requestDesign
        ]);
    }
    public function editRating(Request $request)
    {

          $validator = \Validator::make($request->all(), [
            'rating_id'      => ['required' , 'integer' , 'exists:design_ratings,id'],
            'rating'      => ['required' , 'integer' , 'in:1,2,3,4,5'],
            'comment'     => ['nullable' , 'string' , 'max:255'],
          ]);

          if($validator->fails()){
              return response([
                  'status'  => Response_Fail,
                  'message' => $validator->errors()->all(),
              ]);
          }

          $requestDesign=DesignRating::whereId($request->rating_id)->where('user_id',auth()->id())->first();
          if(!$requestDesign){
            return response([
                'status'  => Response_Fail,
                'message'=>__('api.errors.commentNotFound'),
            ]);
          }

          $requestDesign->update([
            'rating' => $request->rating ,
            'comment' => $request->comment ,
          ]);


        return response([

            'status' =>  Response_Success ,
            'message'=>__('api.success.edited'),
            'data' => $requestDesign
        ]);
    }
    public function deleteRating(Request $request)
    {

          $validator = \Validator::make($request->all(), [
            'rating_id'      => ['required' , 'integer' , 'exists:design_ratings,id'],
          ]);

          if($validator->fails()){
              return response([
                  'status'  => Response_Fail,
                  'message' => $validator->errors()->all(),
              ]);
          }
          $requestDesign=DesignRating::whereId($request->rating_id)->where('user_id',auth()->id())->first();
          if(!$requestDesign){
            return response([
                'status'  => Response_Fail,
                'message'=>__('api.errors.commentNotFound'),
            ]);
          }
          $requestDesign->delete();
        return response([

            'status' =>  Response_Success ,
            'message'=>__('api.success.deleted'),
        ]);
    }

}
