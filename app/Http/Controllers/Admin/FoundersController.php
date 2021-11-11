<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFounderRequest;
use App\Http\Requests\StoreFounderRequest;
use App\Http\Requests\UpdateFounderRequest;
use App\Models\Founder;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FoundersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('founder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $founders = Founder::with(['media'])->get();

        return view('admin.founders.index', compact('founders'));
    }

    public function create()
    {
        abort_if(Gate::denies('founder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.founders.create');
    }

    public function store(StoreFounderRequest $request)
    {
        $founder = Founder::create($request->all());

        if ($request->input('image', false)) {
            $founder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $founder->id]);
        }

        return redirect()->route('admin.founders.index');
    }

    public function edit(Founder $founder)
    {
        abort_if(Gate::denies('founder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.founders.edit', compact('founder'));
    }

    public function update(UpdateFounderRequest $request, Founder $founder)
    {
        $founder->update($request->all());

        if ($request->input('image', false)) {
            if (!$founder->image || $request->input('image') !== $founder->image->file_name) {
                if ($founder->image) {
                    $founder->image->delete();
                }
                $founder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($founder->image) {
            $founder->image->delete();
        }

        return redirect()->route('admin.founders.index');
    }

    public function show(Founder $founder)
    {
        abort_if(Gate::denies('founder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.founders.show', compact('founder'));
    }

    public function destroy(Founder $founder)
    {
        abort_if(Gate::denies('founder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $founder->delete();

        return back();
    }

    public function massDestroy(MassDestroyFounderRequest $request)
    {
        Founder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('founder_create') && Gate::denies('founder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Founder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
