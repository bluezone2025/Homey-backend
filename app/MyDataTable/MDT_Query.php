<?php


namespace App\MyDataTable;


trait MDT_Query
{

    function MDT_Query_method($model , $pathView  , $softDelete = false  , $data = [],$type=null){



        $withRelationship = array_key_exists('with_RS' , $data) ? $data['with_RS'] : [];
        $withCount        = array_key_exists('with_count' , $data) ? $data['with_count'] :[];
        $sendDataWithView = array_key_exists('with' , $data) ? $data['with'] : [];
        $columnsGet       = array_key_exists('select' , $data) ? $data['select'] : '*';
        $startCount       = array_key_exists('count' , $data) ? $data['count'] : 10;
        $orderBy          = array_key_exists('orderBy' , $data) ? $data['orderBy'] :['id' , 'desc'];
        $condition        = array_key_exists('condition' , $data) ? $data['condition'] : null;
        $condition2       = array_key_exists('condition2' , $data) ? $data['condition2'] : null;
        $condition3       = array_key_exists('condition3' , $data) ? $data['condition3'] : null;
        $whereIn       = array_key_exists('whereIn' , $data) ? $data['whereIn'] : null;

        $filter           = array_key_exists('filter' , $data) ? $data['filter'] : null;

        $modelDB = $model;

        if (is_array($condition)){ // create query where

            $conditionName = $condition[0];
            unset($condition[0]);
        }
        if (is_array($condition2)){ // create query where

            $condition2Name = $condition2[0];
            unset($condition2[0]);
        }
        if (is_array($condition3)){ // create query where

            $condition3Name = $condition3[0];
            unset($condition3[0]);
        }



        request('filter') ? $filter = request('filter') : '';

        if (is_array($filter)) {

            $filterName = $filter[0];
            unset($filter[0]);
        }

        if (\request()->ajax() && \request()->has('myDataTableAjax')) {


            if ($modelDB == "App\Models\BoxOrder"){
                $modelDB = $modelDB::with($withRelationship)->withTrashed()
                    ->withCount($withCount);
            }else{
                $modelDB = $modelDB::with($withRelationship)
                    ->withCount($withCount);
            }
        
            $softDelete ? $modelDB->onlyTrashed() :'';

            isset($conditionName) ? $modelDB->$conditionName(...$condition) : '';
            // dd($condition2);
            isset($condition2Name) ? $modelDB->$condition2Name(...$condition2) : '';
            isset($condition3Name) ? $modelDB->$condition3Name(...$condition3) : '';

            isset($filterName) ? $modelDB->$filterName(...$filter) : '';
            if (request('search')){
                if (request('searchColumn') == "user.phone" || request('searchColumn') == "user.address" || request('searchColumn') == "user.name"){
                    $columnName = str_replace('user.',"",request('searchColumn'));
                    $value = request('search');
                    $modelDB->whereHas('shipping_address', function($query) use ($columnName,$value) {
                        $query->where($columnName, 'LIKE', '%' . $value . '%');
                    });
                }else{
                    $modelDB->where( \request( 'searchColumn' ) , "LIKE" , "%" . \request( 'search' ) . "%" );
                }
            }
            #request('search') ? $modelDB->where( \request( 'searchColumn' ) , "LIKE" , "%" . \request( 'search' ) . "%" ) : '';
            if (\request( 'orderColumn' ) && \request( 'orderBy' )){
                if (\request('orderColumn') != "total_orders") {
                    if (\request('orderColumn') != "count_orders"){
                        if (\request('orderColumn') != "total_wallet"){
                            $modelDB->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ));
                        }
                    }


                }
            }
            if ( \request( 'orderColumn' ) != 'id' && \request( 'orderBy' ) != 'desc') {
                $modelDB->orderby( 'id'  , 'desc' );
            }




            if (\request('orderColumn') == "count_orders" || \request('orderColumn') == "total_orders" || \request('orderColumn') == "total_wallet"){
                $dataTable = $modelDB->get();

            }else{
                $dataTable = $modelDB->paginate( request('count',20) , $columnsGet);
            }


            if (\request('orderColumn') == "count_orders") {
                //$dataTableCollection = $dataTable->getCollection(); // Get the collection from paginator

                # Sort based on total_orders
                if (\request('orderBy') == "asc") {
                    $dataTable = $dataTable->sortBy(function($user) {

                        return $user->count_orders;
                    });
                } else {

                    $dataTable = $dataTable->sortByDesc(function($user) {
                        return $user->count_orders;
                    });
                }

                # Convert the sorted collection back to a paginator
                //$dataTable = $dataTable->setCollection($sorted->values()); // Re-apply sorted collection to paginator
            }


            if (\request('orderColumn') == "total_wallet") {
                //$dataTableCollection = $dataTable->getCollection(); // Get the collection from paginator

                # Sort based on total_orders
                if (\request('orderBy') == "asc") {
                    $dataTable = $dataTable->sortBy(function($user) {

                        return $user->total_wallet;
                    });
                } else {

                    $dataTable = $dataTable->sortByDesc(function($user) {
                        return $user->total_wallet;
                    });
                }

                # Convert the sorted collection back to a paginator
                //$dataTable = $dataTable->setCollection($sorted->values()); // Re-apply sorted collection to paginator
            }

            if (\request('orderColumn') == "total_orders") {
                //$dataTableCollection = $dataTable->getCollection(); // Get the collection from paginator

                # Sort based on total_orders
                if (\request('orderBy') == "asc") {
                    $dataTable = $dataTable->sortBy(function($user) {
                        return $user->total_orders;
                    });
                } else {

                    $dataTable = $dataTable->sortByDesc(function($user) {
                        return $user->total_orders;
                    });
                }

                # Convert the sorted collection back to a paginator
                //$dataTable = $dataTable->setCollection($sorted->values()); // Re-apply sorted collection to paginator
            }


// Manually paginate after sorting
            if (\request('orderColumn') == "count_orders" || \request('orderColumn') == "total_orders" || \request('orderColumn') == "total_wallet") {
                $page = \request('page', 1);
                $perPage = request('count',20); // Default to 20 items per page if 'count' is not specified
                $pagedData = $dataTable->slice(($page - 1) * $perPage, $perPage)->values();
                $dataTable = new \Illuminate\Pagination\LengthAwarePaginator($pagedData, $dataTable->count(), $perPage, $page, [
                    'path' => \request()->url(),
                    'query' => \request()->query(),
                ]);
            }

            //dd(request()->all());
            $btn = $dataTable->links()->render();
            // if($type  == 'order'){
            //     foreach($dataTable as $item ) {
            //       $item->image_total=$item->image;
            //     }    
            //     // dd($dataTable);
            // }
            return response(['dataDB' => $dataTable, 'btn' => $btn]);

        }

        //dd($orderBy);

    // dd($sendDataWithView);
        session()->flash('data-session' , [
            'count' => $startCount ,
            'orderBy' => $orderBy[1] ,
            'orderColumn' => $orderBy[0]
        ]);

        return view($pathView)->with($sendDataWithView);

    }

}
