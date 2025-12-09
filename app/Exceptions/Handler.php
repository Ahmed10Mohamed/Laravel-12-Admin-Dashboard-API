<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponses;

    /**
     * The exceptions that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [];

    /**
     * The inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Handle unauthenticated requests.
     */
    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        return $request->expectsJson()
            ? $this->sendError('يجب تسجيل الدخول أولاً', [], 401)
            : redirect('/');
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e): Response
    {
        // If API request → handle with API rules
        if ($request->is('api/*')) {
            return $this->handleApiException($e);
        }

        // If WEB request → handle normally
        return $this->handleWebException($request, $e);
    }

    /**
     * Handle all API exceptions cleanly and consistently.
     */
    private function handleApiException(Throwable $e): Response
    {
        return match (true) {

            $e instanceof AuthenticationException =>
                $this->sendError(translate('Unauthorized'), [], 401),

            $e instanceof NotFoundHttpException =>
                $this->sendError(translate('Route not found'), [], 404),

            $e instanceof ModelNotFoundException =>
                $this->sendError(translate('Resource not found'), [], 404),

            default => $this->sendError(
                $e->getMessage(),
                [],
                $e->getCode() > 0 && $e->getCode() < 600 ? $e->getCode() : 500
            ),
        };
    }

    /**
     * Handle Web exceptions and show custom blade views.
     */
    private function handleWebException(Request $request, Throwable $e): Response
    {
        // If debug mode is enabled → show Laravel detailed error page
        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        // Sanitize status code (ensure it's valid)
        $status = (int) ($e->getCode() ?: 500);
        if ($status < 100 || $status > 599) {
            $status = 500;
        }

        // Render custom views
        return match ($status) {
            404 => response()->view('errors.404', [], 404),
            500 => response()->view('errors.500', [], 500),
            401 => response()->view('errors.401', [], 401),
            default => response()->view(
                'errors.default',
                ['message' => $e->getMessage()],
                $status
            ),
        };
    }
}
