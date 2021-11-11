<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComingSoonRequest;
use App\Http\Requests\StoreComingSoonRequest;
use App\Http\Requests\UpdateComingSoonRequest;
use App\Models\ComingSoon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ComingSoonController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('coming_soon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comingSoons = ComingSoon::all();

        return view('admin.comingSoons.index', compact('comingSoons'));
    }

    public function create()
    {
        abort_if(Gate::denies('coming_soon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.comingSoons.create');
    }

    public function store(StoreComingSoonRequest $request)
    {
        $comingSoon = ComingSoon::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $comingSoon->id]);
        }

        return redirect()->route('admin.coming-soons.index');
    }

    public function edit(ComingSoon $comingSoon)
    {
        abort_if(Gate::denies('coming_soon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.comingSoons.edit', compact('comingSoon'));
    }

    public function update(UpdateComingSoonRequest $request, ComingSoon $comingSoon)
    {
        $comingSoon->update($request->all());

        return redirect()->route('admin.coming-soons.index');
    }

    public function show(ComingSoon $comingSoon)
    {
        abort_if(Gate::denies('coming_soon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.comingSoons.show', compact('comingSoon'));
    }

    public function destroy(ComingSoon $comingSoon)
    {
        abort_if(Gate::denies('coming_soon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comingSoon->delete();

        return back();
    }

    public function massDestroy(MassDestroyComingSoonRequest $request)
    {
        ComingSoon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('coming_soon_create') && Gate::denies('coming_soon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ComingSoon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
