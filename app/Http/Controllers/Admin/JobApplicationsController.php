<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobApplicationRequest;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('job_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplications = JobApplication::with(['job', 'media'])->get();

        $jobs = Job::get();

        return view('admin.jobApplications.index', compact('jobApplications', 'jobs'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_application_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobApplications.create', compact('jobs'));
    }

    public function store(StoreJobApplicationRequest $request)
    {
        $jobApplication = JobApplication::create($request->all());

        if ($request->input('cv', false)) {
            $jobApplication->addMedia(storage_path('tmp/uploads/' . basename($request->input('cv'))))->toMediaCollection('cv');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $jobApplication->id]);
        }

        return redirect()->route('admin.job-applications.index');
    }

    public function edit(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobApplication->load('job');

        return view('admin.jobApplications.edit', compact('jobs', 'jobApplication'));
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

        return redirect()->route('admin.job-applications.index');
    }

    public function show(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplication->load('job');

        return view('admin.jobApplications.show', compact('jobApplication'));
    }

    public function destroy(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplication->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobApplicationRequest $request)
    {
        JobApplication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('job_application_create') && Gate::denies('job_application_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new JobApplication();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
