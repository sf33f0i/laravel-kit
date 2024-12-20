<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\DeleteModelException;
use App\Exceptions\NotFoundAddressException;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Models\Address;
use App\UseCases\Address\StoreAddressCase;
use App\UseCases\Address\DeleteAddressCase;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use JsonException;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = Address::query()->selectRaw("*, ST_AsText(position) as point")->get();

        return view('addresses', ['addresses' => $addresses]);
    }

    /**
     * @throws JsonException|GuzzleException
     */
    public function store(StoreAddressRequest $request, StoreAddressCase $case): RedirectResponse
    {
        try {
            $requestData = $request->validated();
            $case->handle($requestData['address']);
            $message = ['success' => 'Адрес успешно добавлен!'];
        } catch (NotFoundAddressException) {
            $message = ['danger' => 'Произошла ошибка при добавлении записи!'];
        }

        return redirect()->back()->withInput()->with($message);
    }

    public function delete(Address $id, DeleteAddressCase $case): RedirectResponse
    {
        try {
            $case->handle($id);
            $message = ['success' => 'Запись удалена!'];
        } catch (DeleteModelException) {
            $message = ['danger' => 'Произошла ошибка при удалении записи!'];
        }

        return redirect()->back()->with($message);
    }
}
