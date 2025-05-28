<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */

     public function render($request, Throwable $exception)
    {
        
        if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
            return response()->view('frontend.too-many-request', [], 429); // Return the custom too many requests view
        }
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return redirect()->route('not-found'); // This redirects to the named route 'not-found'
        }
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return response()->route('/'); // Return the custom page expired view
        }
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return response()->view('frontend.page-expired', [], 419); // Return the custom internal server error view
        }
        if ($exception instanceof HttpException && $exception->getStatusCode() === 500) {
            return response()->view('frontend.internal-server-error', [], 500); // Return the custom internal server error view
        }
    
        // Default behavior for all other exceptions
        return parent::render($request, $exception);
    }

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
