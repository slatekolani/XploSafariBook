<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];


    public function handle($request, Closure $next) {
        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->tokensMatch($request)
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response(__('exceptions.token_mismatch'), 401);
        } else {
            // redirect the user back to the page and show token mismatch error
            return redirect()->back()->withInput()->withFlashWarning(__('exceptions.token_mismatch'));
        }
    }

}
