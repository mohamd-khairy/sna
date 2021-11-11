<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySnippetRequest;
use App\Http\Requests\StoreSnippetRequest;
use App\Http\Requests\UpdateSnippetRequest;
use App\Models\Snippet;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SnippetController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('snippet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $snippets = Snippet::all();

        return view('admin.snippets.index', compact('snippets'));
    }

    public function create()
    {
        abort_if(Gate::denies('snippet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.snippets.create');
    }

    public function store(StoreSnippetRequest $request)
    {
        $snippet = Snippet::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $snippet->id]);
        }

        return redirect()->route('admin.snippets.index');
    }

    public function edit(Snippet $snippet)
    {
        abort_if(Gate::denies('snippet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.snippets.edit', compact('snippet'));
    }

    public function update(UpdateSnippetRequest $request, Snippet $snippet)
    {
        $snippet->update($request->all());

        return redirect()->route('admin.snippets.index');
    }

    public function show(Snippet $snippet)
    {
        abort_if(Gate::denies('snippet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.snippets.show', compact('snippet'));
    }

    public function destroy(Snippet $snippet)
    {
        abort_if(Gate::denies('snippet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $snippet->delete();

        return back();
    }

    public function massDestroy(MassDestroySnippetRequest $request)
    {
        Snippet::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('snippet_create') && Gate::denies('snippet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Snippet();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
