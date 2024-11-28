<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Address\StoreAddressRequest;
use App\Models\Address;
use App\UseCases\Address\StoreAddressCase;
use App\UseCases\Address\DeleteAddressCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = Address::all();

        return view('addresses', ['addresses' => $addresses]);
    }

    public function store(StoreAddressRequest $request, StoreAddressCase $case): RedirectResponse
    {
        try {
            $requestData = $request->validated();
            $case->handle($requestData['address']);
            $message = ['success' => 'Адрес успешно добавлен!'];
        } catch (Throwable) {
            $message = ['danger' => 'Произошла ошибка при добавлении адреса!'];
        }

        return redirect()->back()->withInput()->with($message);
    }

    public function delete(Address $id, DeleteAddressCase $case): RedirectResponse
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
