<?php

if (!function_exists('myDataTable_search')){

    function myDataTable_search($column , $sign , $option = []){

        $options = [];
        foreach ($option as $key => $val){

            $options[] = ' <option value="'.$key.'">'.$val.'</option>';
        }

        return '<select class="input-group customFilter" data-column="'.$column.'" data-sign="'.$sign.'" >
                    '.implode($options).'
              </select>';
    }

}
