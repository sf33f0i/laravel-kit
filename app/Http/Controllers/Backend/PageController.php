<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\Page;
use App\UseCases\Page\CreatePageCase;
use App\UseCases\Page\UpdatePageCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::query()->latest()->paginate(25);

        return view('backend.page.index', [
            'pages' => $pages,
        ]);
    }

    public function create(): View
    {
        $page = new Page();

        return view('backend.page.create', [
            'page' => $page,
        ]);
    }

    public function store(CreatePageRequest $request, CreatePageCase $case): RedirectResponse
    {
        $data = $request->toArray();
        $case->handle($data);

        return redirect()->route('backend.page.index')->with('success', 'Запись успешно создана');
    }

    public function edit(int $id): View
    {
        $page = Page::findOrFail($id);

        return view('backend.page.edit', [
            'page' => $page,
        ]);
    }

    public function update(UpdatePageRequest $request, Page $page, UpdatePageCase $case): RedirectResponse
    {
        $data = $request->toArray();
        $case->handle($data, $page);

        return redirect('page')->with('success', 'Запись успешно обновлена');
    }

    public function destroy(int $id): RedirectResponse
    {
        Page::destroy($id);

        return redirect('page')->with('flash_message', 'Запись удалена!');
    }
}
