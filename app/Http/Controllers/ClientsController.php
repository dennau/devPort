<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use App\Models\SpecialPage;
use App\SpecialPage\Creator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ClientsController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        return view('mainpage');
    }

    /**
     * @param ClientStoreRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     * @throws BindingResolutionException
     */
    public function store(ClientStoreRequest $request): Application|RedirectResponse|Redirector
    {
        /** @var Client $client */
        $client = Client::create(
            [
                'username' => $request->validated('username'),
                'phone' => $request->validated('phone')
            ]
        );

        /** @var SpecialPage $specialPage */
        $specialPage = app()->make(
                Creator::class,
                [
                    'client' => $client
                ]
            )
            ->createNewSpecialPage();

        return redirect(
            route(
                'special-page',
                [
                    'specialPage' => $specialPage->hash
                ]
            )
        );
    }
}
