<?php

declare(strict_types=1);

use App\Core\Router\Route;

return [
    Route::get('/^\/$/', \App\UI\Http\Action\IndexAction::class),
];
