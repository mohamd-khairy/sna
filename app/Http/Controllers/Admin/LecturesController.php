<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLectureRequest;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Models\Lecture;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LecturesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lecture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lectures = Lecture::all();

        return view('admin.lectures.index', compact('lectures'));
    }

    public function create()
    {
        abort_if(Gate::denies('lecture_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lectures.create');
    }

    public function store(StoreLectureRequest $request)
    {
        $lecture = Lecture::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lecture->id]);
        }

        return redirect()->route('admin.lectures.index');
    }

    public function edit(Lecture $lecture)
    {
        abort_if(Gate::denies('lecture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lectures.edit', compact('lecture'));
    }

    public function update(UpdateLectureRequest $request, Lecture $lecture)
    {
        $lecture->update($request->all());

        return redirect()->route('admin.lectures.index');
    }

    public function show(Lecture $lecture)
    {
        abort_if(Gate::denies('lecture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lectures.show', compact('lecture'));
    }

    public function destroy(Lecture $lecture)
    {
        abort_if(Gate::denies('lecture_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecture->delete();

        return back();
    }

    public function massDestroy(MassDestroyLectureRequest $request)
    {
        Lecture::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lecture_create') && Gate::denies('lecture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lecture();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
