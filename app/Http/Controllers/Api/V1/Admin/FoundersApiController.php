<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFounderRequest;
use App\Http\Requests\UpdateFounderRequest;
use App\Http\Resources\Admin\FounderResource;
use App\Models\Founder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FoundersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('founder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FounderResource(Founder::all());
    }

    public function store(StoreFounderRequest $request)
    {
        $founder = Founder::create($request->all());

        if ($request->input('image', false)) {
            $founder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new FounderResource($founder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Founder $founder)
    {
        abort_if(Gate::denies('founder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FounderResource($founder);
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

        return (new FounderResource($founder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Founder $founder)
    {
        abort_if(Gate::denies('founder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $founder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
