<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserLogRequest;
use App\Http\Requests\StoreUserLogRequest;
use App\Http\Requests\UpdateUserLogRequest;
use App\Models\UserLog;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserLogsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_logs = UserLog::all();

        return view('admin.userLogs.index', compact('user_logs'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userLogs.create');
    }

    public function store(StoreUserLogRequest $request)
    {   
        $user_log = UserLog::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user_log->id]);
        }

        return redirect()->route('admin.user-logs.index');
    }

    public function edit(UserLog $user_log)
    {
        abort_if(Gate::denies('user_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userLogs.edit', compact('user_log'));
    }

    public function update(UpdateUserLogRequest $request, UserLog $user_log)
    {
        $user_log->update($request->all());

        return redirect()->route('admin.user-logs.index');
    }

    public function show(UserLog $user_log)
    {
        abort_if(Gate::denies('user_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userLogs.show', compact('user_log'));
    }

    public function destroy(UserLog $user_log)
    {
        abort_if(Gate::denies('user_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_log->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserLogRequest $request)
    {
        UserLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_log_create') && Gate::denies('user_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserLog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
