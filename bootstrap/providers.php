<?php

return [
    App\Providers\AppServiceProvider::class,
    
    // Load additional route files
    function ($app) {
        require base_path('routes/imports.php');
    },
];
