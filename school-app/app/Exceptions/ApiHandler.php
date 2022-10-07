<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

trait ApiHandler
{
    public function handlerErrors(\Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return $this->defaultResponse(
                "registro-nao-encontrado",
                "O sistema não encontrou o registro que você está buscando",
                404
            );
        }

        if ($exception instanceof ValidationException) {
            return $this->defaultResponse(
                "erro-validacao",
                "Os dados enviados são inválidos",
                400
            );
        }
    }

    public function defaultResponse(string $code, string $message, int $status, array $errors = [])
    {
        return response([
            'code' => $code,
            'message' => $message,
            'status' => $status,
            'erros' => $errors
        ], $code);
    }
}