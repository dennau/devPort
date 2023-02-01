<?php

namespace App\Http\Middleware;

use App\Models\SpecialPage;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class SpecialPageChecker
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response|RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        /** @var SpecialPage $specialPage */
        $specialPage = $request->route('specialPage');

        if ($specialPage->created_at < now()->subDays(SpecialPage::LIFETIME_DAYS)) {
            abort(404);
        }

        return $next($request);
    }
}
