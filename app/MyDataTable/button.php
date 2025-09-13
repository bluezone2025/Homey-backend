<?php
if (!function_exists('myDataTable_button')) {

    function myDataTable_button($button = [] ,  $selectAll=true ,  $csv=true , $pdf=false , $json=false ,  $print=true , $sort=true  , $reload=true )
    {


        $dataSection =  session()->get("data-session");

        function  isSelected ($key , $val) {

            $dataSection =  session()->get("data-session");

            return $dataSection[$key] == $val  ? 'selected' : '';
        }

        $customButton = '';
        $i = 0;
        if ( count($button) > 0){

            foreach ($button as $key => $value){

                if (!is_array($value)){

                    $customButton .= "<a href='".$value."' class='btn btn-secondary btnCustom".$i."'>".$key."</a>";

                }else{

                    $customButton .= "<a href='".$value[0]."' class='btn btn-secondary btnCustom".$i."'>".$value[1].' '.$key."</a>";
                }
                $i++;
            }
        }
        $selectAll  =  $selectAll == true ? "<button class='selectAll-dataTable btn btn-secondary' data-langSelect='".__('myDataTable.selectAll')."<i class=\"fal fa-check-double\"></i>' data-langDeselect='".__('myDataTable.deselect')."<i class=\"fal fa-check-double\"></i>'>" . __('myDataTable.selectAll') . "<i class=\"fal fa-check-double\"></i></button>" : "";
        $reload     =  $reload    == true ? "<button class='reload-dataTable btn btn-secondary '>"  . __('myDataTable.reload') . "<i class=\"fad fa-sync-alt\"></i></button>" : "<button class='reload-dataTable btn btn-secondary d-none'>" . __('myDataTable.reload') . "</button>";
        $print      =  $print     == true ? "<button class='print-dataTable print-button'><span class='print-icon'></span></button>" : "";
        $csv        =  $csv       == true ? "<button class='csv-dataTable btn btn-secondary'>".__('myDataTable.csv')."<i class=\"fad fa-file-excel\"></i> </span></button>" : "";
        $pdf        =  $pdf       == true ? "<button class='pdf-dataTable btn btn-secondary'>".__('myDataTable.pdf')."<i class=\"fal fa-file-pdf\"></i> </span></button>" : "";
        $json       =  $json      == true ? "<button class='json-dataTable btn btn-secondary'>".__('myDataTable.json')."<i class=\"fal fa-check-double\"></i> </span></button>" : "";
        $sort       =  $sort      == true ? "<div class='dropdown sectionDropDown'>


    </div>" : "";

        return "

<div class='position-relative myDataTableButton'>


    <div class='btn-myDataTable text-nowrap table-responsive overflow-y-hidden'>
    ".$customButton."

  <select class='selectLines'>
       <option ".isSelected('count' , '20')." value='20' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 20]) . "</option>
       <option ".isSelected('count' , '50')." value='50' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 50]) . "</option>
       <option ".isSelected('count' , '100')." value='100' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 100]) . "</option>
       <option ".isSelected('count' , '150')." value='150' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 150]) . "</option>
       <option ".isSelected('count' , '200')." value='200' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 200]) . "</option>
       <option ".isSelected('count' , '300')." value='300' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 300]) . "</option>
       <option ".isSelected('count' , '500')." value='500' class='dropdown-item'>" . __('myDataTable.lines', ["number" => 500]) . "</option>

  </select>
  <select class='orderBy' data-orderColumn='".$dataSection['orderColumn']."'>
       <option ".isSelected('orderBy' , 'asc')." value='asc' class='dropdown-item'>" .  __('myDataTable.asc') . "</option>
       <option ".isSelected('orderBy' , 'desc')." value='desc' class='dropdown-item'>" . __('myDataTable.desc') . "</option>
  </select>


    ".$sort."
    ".$reload."
    ".$selectAll."
    ".$csv."
    ".$pdf."
    ".$json."
    ".$print."

</div>
</div>

    ";
    }
}
