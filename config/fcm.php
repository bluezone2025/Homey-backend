<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAQkEc80w:APA91bFGAI0nYJDlGN9Ch_iiEBZgfQihK-vVobnAGiZmRs-mOHKR4Lt_3rScqXye89vgQnJsFv3_dueKzTWl9wlpfVO-6FgHVfyRAWZty8Ds1iGmzY0hWiuvn60QjV8Q51-D1Obo8Zhz'),
        'sender_id' => env('FCM_SENDER_ID', '284560257868'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
