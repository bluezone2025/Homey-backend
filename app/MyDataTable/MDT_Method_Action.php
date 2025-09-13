<?php


namespace App\MyDataTable;


use App\Models\Product;
use App\Models\Student;
use Illuminate\Support\Facades\File;

trait MDT_Method_Action
{


    function MDT_delete($model , $id){

        //dd($id,\request('tdSelected'));
        if ( !\request()->has( 'tdSelected' ) ) { // is Delete one row

            $row = $model::findOrFail($id);

            if ($model == "App\Models\Student"){

                $student = Student::find($id);
                foreach ($student->products as $product){
                    Product::destroy($product->id);
                }

            }

            $row->delete();

            return response( [ 'status' => 'success' , 'message' => 'تم الحذف بنجاح' ] );

        }else{  // is Delete multi row


            if ($model == "App\Models\Student"){
                foreach (\request('tdSelected') as $item){
                    $student = Student::find($item);
                    foreach ($student->products as $product){
                        Product::destroy($product->id);
                    }
                }
            }
            $model::whereIn('id' , \request('tdSelected'))->firstOrFail();

            $model::destroy(\request('tdSelected'));

            return response( [ 'status' => 'success' , 'message' => 'تم حذف العناصر المحدة بنجاح' ] );

        }
    }

    function MDT_finalDelete($model , $id , $path = '' , $img = false){

        if ( !\request()->has( 'tdSelected' ) ) { // is restore one row


            $row = $model::onlyTrashed()->findOrFail($id);


            if ($model == "App\Models\Student"){
                try{

                    $student = Student::onlyTrashed()->find($id);
                    //dd($student->products()->onlyTrashed()->get());
                    foreach ($student->products()->onlyTrashed()->get() as $product){
                        $product->forceDelete();
                    }
                }catch (\Exception $e){

                }

            }


            $row->forceDelete();

            if ($img !== false) {

                \Illuminate\Support\Facades\File::delete(base_path("public/$path/$row->img"));
                \Illuminate\Support\Facades\File::delete(base_path("public/$path/small_$row->img"));
                \Illuminate\Support\Facades\File::delete(base_path("public/$path/medium_$row->img"));

                $newPath = str_replace('/min/' , '/gallery' ,$path );
                File::deleteDirectory(base_path("public/$newPath/$row->slug"));
            }

            return response( [ 'status' => 'success' , 'message' => 'تم الحذف  بشكل نهائي' ] );


        }else { // is restore multi row


            $rows = $model::onlyTrashed()->whereIn('id' , request('tdSelected'));

            if ($model == "App\Models\Student"){
                try{

                    foreach (request('tdSelected') as $item){

                        $student = Student::onlyTrashed()->find($item);
                        foreach ($student->products()->onlyTrashed()->get() as $product){
                            $product->forceDelete();
                        }
                    }
                }catch (\Exception $e){

                }

            }
            if ($rows->count() > 0) {

                if ($img !== false) {

                    $rowsClone = $rows->clone();

                    foreach ($rowsClone->get() as $row) {

                        \Illuminate\Support\Facades\File::delete($path . $row->img);
                        \Illuminate\Support\Facades\File::delete($path . 'small_' . $row->img);
                        \Illuminate\Support\Facades\File::delete($path . 'medium_' . $row->img);
                    }

                }

                $rows->forceDelete();

            }else{

                abort(404);
            }

            return response( [ 'status' => 'success' , 'message' => 'تم حذف  العناصر المحددة  بشكل نهائي' ] );


        }
    }

    function MDT_restore($model , $id){

        if ( !\request()->has( 'tdSelected' ) ) { // is restore one row

            if ($model == "App\Models\Student"){
                try{

                    $student = Student::onlyTrashed()->find($id);
                    //dd($student->products()->onlyTrashed()->get());
                    foreach ($student->products()->onlyTrashed()->get() as $product){
                        $product->restore();
                    }
                }catch (\Exception $e){

                }

            }

            $row = $model::onlyTrashed()->findOrFail($id);

            $row->restore();

            return response( [ 'status' => 'success' , 'message' => 'تم الاسترجاع بنجاح' ] );


        }else { // is restore multi row

            if ($model == "App\Models\Student"){
                try{

                    foreach (request('tdSelected') as $item){

                        $student = Student::onlyTrashed()->find($item);
                        foreach ($student->products()->onlyTrashed()->get() as $product){
                            $product->restore();
                        }
                    }
                }catch (\Exception $e){

                }

            }

            $row = $model::onlyTrashed()->whereIn('id' , request('tdSelected'));

            if($row->count() > 0){

                $row->restore();

            }else{

                abort(404);
            }

            return response( [ 'status' => 'success' , 'message' => 'تم استرجاع العناصر المحددة بنجاح' ] );


        }
    }
}
