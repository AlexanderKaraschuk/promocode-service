<?php

declare(strict_types=1);

namespace App\UI\Http\Action;

use App\Core\Request\Request;
use App\Core\Response\Response;

interface ActionInterface
{
    public function __invoke(Request $request): ?Response;
}
