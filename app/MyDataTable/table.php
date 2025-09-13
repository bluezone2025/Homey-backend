<?php

if (!function_exists('myDataTable_table')){

    function myDataTable_table(  $columns = ['id']   , $theme = 3 , $action = true , $tdOne=true , $classTable=null){

        $dataSection = session()->get("data-session");


        foreach ($columns as $columnName => $prams){

            $sort = true;
            $search = true;
            $show_by_lang = 'all';
            $class = '';

            if (is_array($prams)){ // is find prams

                $lang =  $prams[0];
                $sort = isset($prams[1]) ? $prams[1] : true;
                $search = isset($prams[2]) ? $prams[2] : true;
                $show_by_lang = isset($prams[3]) ? $prams[3] : 'all';
                $class = isset($prams[4]) ? $prams[4] : '';

            }else{ // is not fins prams

                $lang = $prams;
                $columnName =  is_numeric($columnName) ? $prams : $columnName  ;
            }

            // icon sort
            if ($sort){

                $sortBy = "<i class='sort-by'></i>";
                $classTh = "theOrderColumn" ;

            }else{

                $sortBy = "";
                $classTh = "" ;

            }


            $searchVal = $search ? "<div class='form-group input-search notExport notPrint'><input type='text' name='".$columnName."' class='form-control'  autocomplete='off' placeholder='....'></div>" : "<div class='form-group input-d-search  notExport notPrint'><input type='text' class='form-control'  autocomplete='off' placeholder='.....' readonly></div>";

            if ($show_by_lang === 'all'){

                $all_columns[] = "<th scope='col' class='" . $classTh . " th-" . $columnName . " " . $class . " ' data-orderColumn='" . $columnName . "'>  $lang  $sortBy $searchVal</th>";

            }else{

                $all_columns[] = app()->getLocale() == $show_by_lang ? "<th scope='col' class='" . $classTh . " th-" . $columnName . " " . $class . " ' data-orderColumn='" . $columnName . "'>  $lang  $sortBy $searchVal</th> " : '';

            }


        }

        $action = $action === true ? " <th scope='col' class='th-action notExport'>  Action <div class='form-group input-search'><input type='text' name='".$columnName."' class='form-control invisible'  autocomplete='off' placeholder='....'></div></th>" : "";
        $tdOne  = $tdOne === true ? " <th class='th-one notExport notPrint'></th> " : "";

        if ($theme == 1){
            $tableTheme = "table borderBottom";
            $thTheme = "thead-dark";
            $bodyTheme = "body-black";

        }elseif ($theme == 2){
            $tableTheme = "table table-striped";
            $thTheme = "thead-dark";
            $bodyTheme = "body-black";

        }elseif ($theme == 3){

            $tableTheme = "table table-light table-bordered";
            $thTheme = "thead-light";
            $bodyTheme = "body-black";

        } elseif ($theme == 4) {

            $tableTheme = "table table-dark  table-bordered ";
            $thTheme = "thead-dark";
            $bodyTheme = "body-black";

        }else{

            $tableTheme = "table   table-bordered ";
            $thTheme = "thead-light";
            $bodyTheme = "body-white";
        }

        return " <div class='table-responsive myDataTable-table-cover'>

        <table id='example' class=' data-table myDataTable-table ".$tableTheme .' '. $classTable." '>

            <thead class='".$thTheme."'>
            <tr>
                   ".$tdOne."
                   ".implode($all_columns)."
                   ".$action."

            </tr>
            </thead>

            <tbody class='".$bodyTheme."'></tbody>
        </table>


        <div class='myDataTable-print'>
        <table class='table table-striped'></table>
        </div>

    <div class=\"animation-body\">
        <div class=\"lds-facebook\">
            <div></div><div></div><div></div>
        </div>
    </div>

    <span class='d-none data-start-info'  data-orderColumn='".$dataSection["orderColumn"]."' data-orderBy='".$dataSection["orderBy"]."' data-count='".$dataSection["count"]."'></span>
    <div class=\"animation-message  animation-message-error_views\">
    </div>

    <div class=\"animation-message alert-success animation-message-success\">
    </div>
</div>
        <div class='btnPaginate'>  </div>

        ";
    }
}
