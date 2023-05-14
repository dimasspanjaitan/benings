<?php

return [
    'price_type' => [
        'customer' => 1,
        'mitra' => 2
    ],
    'customer_level_id' => 10,
    'sale_types' => [
        '1' => [
            'value' => 1,
            'name' => 'Pending',
            'color' => 'text-warning',
            'class' => 'font-weight-bold text-warning'
        ],
        '2' => [
            'value' => 2,
            'name' => 'Processed',
            'color' => 'text-primary',
            'class' => 'font-weight-bold text-primary'
        ],
        '3' => [
            'value' => 3,
            'name' => 'Delivered',
            'color' => 'text-secondary',
            'class' => 'font-weight-bold text-secondary'
        ],
        '4' => [
            'value' => 4,
            'name' => 'Finished',
            'color' => 'text-success',
            'class' => 'font-weight-bold text-success'
        ],
        '5' => [
            'value' => 5,
            'name' => 'Canceled',
            'color' => 'text-danger',
            'class' => 'font-weight-bold text-danger'
        ],
    ],
    'logo' => [
        'logo1' => 'backend/img/logo1.png',
        'logo2' => 'backend/img/logo2.png',
        'logo2-small' => 'backend/img/logo2-small.png',
        'favicon' => 'backend/img/favicon.png'
    ]
];