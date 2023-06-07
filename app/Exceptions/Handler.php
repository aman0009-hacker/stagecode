<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
    }

    //method to protect csrf
    protected function invalidToken($request, $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'CSRF token mismatch. Please try again.'], 419);
        }

        return redirect()->back()->withInput()->withErrors(['CSRF token mismatch. Please try again.']);
    }
    //method to protect csrf
}
