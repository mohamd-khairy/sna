<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Http\Resources\Admin\JobApplicationResource;
use App\Models\JobApplication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('job_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobApplicationResource(JobApplication::with(['job'])->get());
    }

    public function store(StoreJobApplicationRequest $request)
    {
        $jobApplication = JobApplication::create($request->all());

        if ($request->input('cv', false)) {
            $jobApplication->addMedia(storage_path('tmp/uploads/' . basename($request->input('cv'))))->toMediaCollection('cv');
        }

        return (new JobApplicationResource($jobApplication))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobApplicationResource($jobApplication->load(['job']));
    }

    public function update(UpdateJobApplicationRequest $request, JobApplication $jobApplication)
    {
        $jobApplication->update($request->all());

        if ($request->input('cv', false)) {
            if (!$jobApplication->cv || $request->input('cv') !== $jobApplication->cv->file_name) {
                if ($jobApplication->cv) {
                    $jobApplication->cv->delete();
                }
                $jobApplication->addMedia(storage_path('tmp/uploads/' . basename($request->input('cv'))))->toMediaCollection('cv');
            }
        } elseif ($jobApplication->cv) {
            $jobApplication->cv->delete();
        }

        return (new JobApplicationResource($jobApplication))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplication->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
