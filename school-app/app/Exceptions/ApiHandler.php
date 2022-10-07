<?php

namespace App\Exceptions;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

trait ApiHandler
{
    public function handlerErrors(\Throwable $exception): Response|bool|Application|ResponseFactory
    {
        if ($exception instanceof ModelNotFoundException) {
            return $this->modelNotFoundException();
        }

        if ($exception instanceof ValidationException) {
            return $this->validationException($exception);
        }

        return false;
    }

    public function modelNotFoundException(): Response|Application|ResponseFactory
    {
        return $this->defaultResponse(
            "registro-nao-encontrado",
            "O sistema não encontrou o registro que você está buscando",
            404
        );
    }

    public function validationException(ValidationException $exception): Response|Application|ResponseFactory
    {
        return $this->defaultResponse(
            "erro-validacao",
            "Os dados enviados são inválidos",
            400,
            $exception->errors()
        );
    }

    public function defaultResponse(string $code, string $message, int $status, array $errors = []): Response|Application|ResponseFactory
    {
        return response([
            'code' => $code,
            'message' => $message,
            'status' => $status,
            'erros' => $errors
        ], $code);
    }
}