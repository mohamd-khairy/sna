<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogscommentRequest;
use App\Http\Requests\StoreBlogscommentRequest;
use App\Http\Requests\UpdateBlogscommentRequest;
use App\Models\Blog;
use App\Models\Blogscomment;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BlogscommentsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blogscomment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogscomments = Blogscomment::with(['blog', 'media'])->get();

        $blogs = Blog::get();

        return view('admin.blogscomments.index', compact('blogscomments', 'blogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('blogscomment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogs = Blog::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.blogscomments.create', compact('blogs'));
    }

    public function store(StoreBlogscommentRequest $request)
    {
        $blogscomment = Blogscomment::create($request->all());

        if ($request->input('image', false)) {
            $blogscomment->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blogscomment->id]);
        }

        return redirect()->route('admin.blogscomments.index');
    }

    public function edit(Blogscomment $blogscomment)
    {
        abort_if(Gate::denies('blogscomment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogs = Blog::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blogscomment->load('blog');

        return view('admin.blogscomments.edit', compact('blogs', 'blogscomment'));
    }

    public function update(UpdateBlogscommentRequest $request, Blogscomment $blogscomment)
    {
        $blogscomment->update($request->all());

        if ($request->input('image', false)) {
            if (!$blogscomment->image || $request->input('image') !== $blogscomment->image->file_name) {
                if ($blogscomment->image) {
                    $blogscomment->image->delete();
                }
                $blogscomment->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($blogscomment->image) {
            $blogscomment->image->delete();
        }

        return redirect()->route('admin.blogscomments.index');
    }

    public function show(Blogscomment $blogscomment)
    {
        abort_if(Gate::denies('blogscomment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogscomment->load('blog');

        return view('admin.blogscomments.show', compact('blogscomment'));
    }

    public function destroy(Blogscomment $blogscomment)
    {
        abort_if(Gate::denies('blogscomment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogscomment->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogscommentRequest $request)
    {
        Blogscomment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('blogscomment_create') && Gate::denies('blogscomment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Blogscomment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
