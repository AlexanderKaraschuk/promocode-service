<?php

declare(strict_types=1);

use App\Core\Router\Route;

return [
    Route::get('/^\/$/', \App\UI\Http\Action\IndexAction::class),
    Route::get('/^\/signup$/', \App\UI\Http\Action\User\ShowSingUpFormAction::class),
    Route::post('/^\/signup$/', \App\UI\Http\Action\User\SignUpAction::class),
];
