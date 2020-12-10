<?php

declare(strict_types=1);

use App\Core\Router\Route;

return [
    Route::get('/^\/$/', \App\UI\Http\Action\IndexAction::class),
    Route::get('/^\/signup$/', \App\UI\Http\Action\User\ShowSingUpFormAction::class),
    Route::post('/^\/signup$/', \App\UI\Http\Action\User\SignUpAction::class),
    Route::get('/^\/signin$/', \App\UI\Http\Action\User\ShowSingInFormAction::class),
    Route::post('/^\/signin$/', \App\UI\Http\Action\User\SignInAction::class),
    Route::get('/^\/logout$/', \App\UI\Http\Action\User\LogoutAction::class),
    Route::post('/^\/getpromocode/', \App\UI\Http\Action\Promocode\GetPromocodeAction::class),
    Route::get('/^\/getpromocodebench/', \App\UI\Http\Action\Promocode\GetPromocodeBenchmarkAction::class),
];
