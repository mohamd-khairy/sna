<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBlogscommentRequest;
use App\Http\Requests\UpdateBlogscommentRequest;
use App\Http\Resources\Admin\BlogscommentResource;
use App\Models\Blogscomment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogscommentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blogscomment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogscommentResource(Blogscomment::with(['blog'])->get());
    }

    public function store(StoreBlogscommentRequest $request)
    {
        $blogscomment = Blogscomment::create($request->all());

        if ($request->input('image', false)) {
            $blogscomment->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new BlogscommentResource($blogscomment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Blogscomment $blogscomment)
    {
        abort_if(Gate::denies('blogscomment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogscommentResource($blogscomment->load(['blog']));
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

        return (new BlogscommentResource($blogscomment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Blogscomment $blogscomment)
    {
        abort_if(Gate::denies('blogscomment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogscomment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
