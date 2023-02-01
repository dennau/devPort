<?php

namespace App\Http\Controllers;

use App\Models\SpecialPage;
use App\Models\SpecialPageClick;
use App\SpecialPage\Creator;
use App\SpecialPage\ClickHandler;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SpecialPageController extends Controller
{
    /**
     * @param SpecialPage $specialPage
     *
     * @return Application|Factory|View
     */
    public function show(SpecialPage $specialPage): Application|Factory|View
    {
        return view(
            'game',
            [
                'playLink' => route(
                    'special-page-play',
                    [
                        'specialPage' => $specialPage->hash
                    ]
                ),
                'historyLink' => route(
                    'special-page-history',
                    [
                        'specialPage' => $specialPage->hash
                    ]
                ),
                'createNewSpecialPageLink' => route(
                    'special-page-create-new',
                    [
                        'specialPage' => $specialPage->hash
                    ]
                ),
                'deleteCurrentSpecialPageLink' => route(
                    'special-page-destroy',
                    [
                        'specialPage' => $specialPage->hash
                    ]
                )
            ]
        );
    }

    /**
     * @param SpecialPage $specialPage
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(SpecialPage $specialPage): Application|RedirectResponse|Redirector
    {
        $specialPage->delete();
        return redirect(route('client-create'));
    }

    /**
     * @param SpecialPage $specialPage
     *
     * @return Application|RedirectResponse|Redirector
     * @throws BindingResolutionException
     */
    public function store(SpecialPage $specialPage): Application|RedirectResponse|Redirector
    {
        $newSpecialPage = app()->make(
                Creator::class,
                [
                    'client' => $specialPage->client
                ]
            )
            ->createNewSpecialPage();

        return redirect(
            route(
                'special-page',
                [
                    'specialPage' => $newSpecialPage->hash
                ]
            )
        );
    }

    /**
     * @param SpecialPage $specialPage
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function play(SpecialPage $specialPage): JsonResponse
    {
        /** @var SpecialPageClick $result */
        $result = app()->make(
                ClickHandler::class,
                [
                    'specialPage' => $specialPage
                ]
            )
            ->getResult();

        return response()
            ->json(
                [
                    'clicks' => [
                        $result->toArray()
                    ]
                ]
            );
    }

    /**
     * @param SpecialPage $specialPage
     *
     * @return JsonResponse
     */
    public function history(SpecialPage $specialPage): JsonResponse
    {
        return response()
            ->json(
                [
                    'clicks' => $specialPage->specialPageClicks()
                            ->latest()
                            ->take(3)
                            ->get()
                ]
            );
    }
}
