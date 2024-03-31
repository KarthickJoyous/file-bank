<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            $error =  __('messages.user.errors.too_many_attempts');
            $code = 429;
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => $error,
                    'code' => $code
                ], $code);
            } else {
                abort($code);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            
            if($request->is('api/*')) {

                $error_code = 422;

                $errors = $e->errors();

                return response()->json([
                    'success' => false,
                    'message' => $errors[array_key_first($errors)][0],
                    'code' => $error_code
                ], $error_code);
            }
        });
    }
}
