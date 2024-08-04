<?php

use psr\Http\Message\ServerRequestInterface as Request;
use psr\Http\Server\RequestHandlerInterface as RequestHandler;

$jsonBodyParser = function (Request $request, RequestHandler $handler) {
    $contentType = $request->getHeaderLine('Content-Type');
    if (strstr($contentType, 'application/json')) {
        $contents = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $request = $request->withParsedBody($contents);
        }
    }
    return $handler->handle($request);
};
