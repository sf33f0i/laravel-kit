<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Clients\YandexGeocoderClient;
use App\Http\Requests\GeoData\StoreGeoDataRequest;
use App\Models\GeoData;
use App\UseCases\GeoData\DeleteGeoDataCase;
use App\UseCases\GeoData\StoreGeoDataCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class GeoDataController extends Controller
{
    public function index(): View
    {
        $geoData = GeoData::all();

        return view('index', ['geoData' => $geoData]);
    }

    public function store(
        StoreGeoDataRequest $request,
        StoreGeoDataCase $case,
        YandexGeocoderClient $client,
    ): RedirectResponse {
        try {
            $requestData = $request->validated();
            $case->handle($requestData, $client);
            $message = ['success' => 'Адрес успешно добавлен!'];
        } catch (Throwable $exception) {
            $message = ['danger' => $exception->getMessage()];
        }

        return redirect()->back()->with($message);
    }

    public function delete(GeoData $id, DeleteGeoDataCase $case): RedirectResponse
    {
        try {
            $case->handle($id);
            $message = ['success' => 'Запись удалена!'];
        } catch (Throwable $exception) {
            $message = ['danger' => $exception->getMessage()];
        }

        return redirect()->back()->with($message);
    }
}
