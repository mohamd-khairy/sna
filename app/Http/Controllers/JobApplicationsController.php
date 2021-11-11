<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobApplicationRequest;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\ContentCategory;
use App\Models\Job;
use App\Models\JobApplication;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationsController extends Controller
{
    use MediaUploadingTrait;
    public function create()
    {
        $jobs = Job::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $ContentCategory = ContentCategory::get();
        return view('frontend.jobApplicationcreate', compact('jobs','ContentCategory'));
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

        return redirect()->route('/');
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
