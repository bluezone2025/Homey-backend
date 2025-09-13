<?php


namespace App\MyDataTable;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


trait MDT_UploadImag
{


    public $sizeImg = [

        'small_width'   => 350,
        'small_height'  => 350,
        'medium_width'  => 800  ,
        'medium_height' => 600,
    ];

    public function MDT_saveImage($file , $name , $path ='assets/images/products/min/'){

        ini_set('memory_limit','256M');

        if ($file) {


            $pathSaveImag = public_path($path);


            File::isDirectory($pathSaveImag) ?? File::makeDirectory($pathSaveImag);

            $fileExt = $file->getClientOriginalExtension() === 'png' ? 'png': 'jpeg';

            $fileName = $name . '.' . $fileExt;
            $saveImage = $file->move($pathSaveImag, $fileName);

            $fileOld = Image::make($saveImage);

            // resize small
            $fileOld->resize($this->sizeImg['small_width'] , $this->sizeImg['small_height'] ,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag . '/small_' . $fileName);

            // resize medium
            $fileOld->resize($this->sizeImg['medium_width'] , $this->sizeImg['medium_height'] ,  function ($constraint) {
                $constraint->aspectRatio();
//                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag . '/medium_' . $fileName);


            $fileNew = Image::make($saveImage);

            $fileSize = $fileNew->filesize();

            if ($fileSize > 153600) {

                $q = $this->fileSize($fileSize);

                // resize min
                $fileNew->save($pathSaveImag .'/'. $fileName, $q);


                // resize small
                $fileNew = Image::make($pathSaveImag . "/small_$fileName");

                $q = $this->fileSize($fileNew->filesize());

                $fileNew->save($pathSaveImag . "/small_$fileName", $q);

                //resize medium
                $fileNew = Image::make($pathSaveImag . "/medium_$fileName");

                $q = $this->fileSize($fileNew->filesize());

                $fileOld->save($pathSaveImag . "/medium_$fileName", $q);

            }


            return $fileName;
        }

        return  null;
    }





    public function MDT_saveMultiImage($files, $name , $fk_id=['nameKey' , 'id'] , $path='assets/images/products/gallery/' ){

        ini_set('memory_limit','256M');

        $pathSaveImag = public_path($path);

        $saveNameFile = [];
        $count = 0;

       foreach ($files as $file){

           $rand = time().random_int(10000 , 900000);

           $fileExt = $file->getClientOriginalExtension() === 'png' ? 'png': 'jpeg';
           $fileName = $name.'_'.$rand.'.'.$fileExt;
           $saveImage = $file->move($pathSaveImag , $fileName);

           $file = Image::make($saveImage);

           $fileSize = $file->filesize();

           if ($fileSize > 153600) {

               $q = $this->fileSize($fileSize);

               // resize min

               $file->save($pathSaveImag.$fileName , $q);

           }


           $saveNameFile[$count]['src'] = $fileName;
           $saveNameFile[$count][$fk_id[0]]=$fk_id[1];
           $count++;
       }

       return $saveNameFile;

    }


    public function MDT_deleteImage($img , $path ='assets/images/products/min'){

        $pathImag = public_path($path);

        \Illuminate\Support\Facades\File::delete($pathImag.'/'.$img);
        \Illuminate\Support\Facades\File::delete($pathImag.'/'.'small_'.$img);
        \Illuminate\Support\Facades\File::delete($pathImag.'/'.'medium_'.$img);
    }

    public function MDT_deleteMultiImage($images , $path ='assets/images/products/gallery'){

        $pathImag = public_path($path);

        foreach ($images as $img){

            \Illuminate\Support\Facades\File::delete($pathImag.'/'.$img);

        }
    }





    private function fileSize($fileSize){

        if ($fileSize <= 204800) {
            return  95;
        }
        if ($fileSize > 204800 && $fileSize <= 409600) {
            return  85;
        }
        if ($fileSize > 409600 && $fileSize <= 768000) {
            return  70;
        }
        if ($fileSize > 768000 && $fileSize <= 102400) {
            return 50;
        }

        return  25;
    }




}
