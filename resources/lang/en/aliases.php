<?php
return[

    "active" => [
        '0' => 'Not yet approved',
        '1' => 'approved',
    ],

    "has_service" => [
        '0' => 'The department does not accept services',
        '1' => 'The department accepts services',
    ],

    "has_product" => [
        '0' => 'The department does not accept products',
        '1' => 'The department accepts products',
    ],

    "status" => [
        'pending' => 'pending review' ,
        'accept'=>'The order has been accepted',
        'shipping'=> 'orders are being shipped',
        'done'=> 'Order delivered',
        'reject'=> 'The order was rejected',
    ],
    "box_status" => [
        'paid' => 'تم الدفع' ,
        'done' => 'تم التسليم' ,
        'retrieved'=>'تم الاسترجاع',
    ],
    "status_a" => [
        'accept'=>'The order has been accepted',
        'shipping'=> 'orders are being shipped',
        'done'=> 'Order delivered',
        'reject'=> 'The order was rejected',
    ],

    'level' => [
        0 => 'unimportant',
        1 => 'normal',
        2 => 'important',
        3 => 'very important',
        4 => 'highest priority',
    ],

    "payment_method" => [
        'cash' => 'Cash' ,
        'knet'=>'MyFathorah',
        'tabby'=> 'Tabby',
        'wallet'    => "Wallet"
    ],


];
