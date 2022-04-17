<?php

return [
    'template' => [
        'header'    => TEMPLATE_PATH . 'header.php',
        'nav'       => TEMPLATE_PATH . 'nav.php',
        'titlebar'  => TEMPLATE_PATH . 'titlebar.php',
        ':view'     => 'action_view',
        'footer'   => TEMPLATE_PATH . 'footer.php'
    ],
    'header_resources' => [
        'css' => [
            'normalize'     => CSS . 'normalize.css',
            'main'          => CSS . 'main.css',
            'fawsome'       => CSS . 'all.min.css',
            'pre_gfonts'    => 'https://fonts.googleapis.com',
            'pre2_gfonts'   => 'https://fonts.gstatic.com',
            'gfonts'        => 'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap' 
        ],
        'js' => [
            
        ]
        ],
    'footer_resources' => [
        'main'      => JS . 'main.js'
    ]
];