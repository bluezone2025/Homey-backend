<?php


namespace App\Http\Traits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait ApiResponses
{
    public $paginateNumber = 30;


    public function apiResponse($data = null , $error = null ,$code =200){

        if ($error != null)
        {
            $array = [
                'value' => in_array($code, $this->successCode()) ? true : false,
                'msg' => $error,
            ];
        }
        else
        {
            $array = [
                'value' => in_array($code, $this->successCode()) ? true : false,
                'data' => $data,
            ];
        }
        return response($array , $code);
    }

    public function successCode(){
        return [
            200 , 201 , 202
        ];
    }

    public function createdResponse($data){
        return $this->apiResponse($data, null, 200);
    }

    public function deleteResponse(){
        return $this->apiResponse(true, null, 200);
    }

    public function notFoundResponse(){
        return $this->apiResponse(null, __('messages.not_found'), 404);
    }

    public function unKnowError(){
        return $this->apiResponse(null, 'Un know error', 520);
    }

    public function apiValidation($request, $array){

        $validate = Validator::make($request->all() , $array);

        $errors = [];

        if($validate->fails()){
            foreach($validate->getMessageBag()->toArray() as $key=>$messages) {
                $errors[$key] = $messages[0];
                $this->apiResponse(null, $errors[$key], 422);
                //break;
            }

            return $this->apiResponse(null, $errors, 422);
        }

    }

    /**
     * Collection Paginate
     *
     * @param $items
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function CollectionPaginate($items, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $this->paginateNumber), $items->count(), $this->paginateNumber, $page, $options);
    }


}