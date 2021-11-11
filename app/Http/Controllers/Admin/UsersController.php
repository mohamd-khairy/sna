<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Programme;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(!Gate::denies('Egyptology_Student')){
            $users = User::where('program_id','1')->get();
        }else if(!Gate::denies('BioHealth_Student')){
            $users = User::where('program_id','2')->get();
        }else{
            $users = User::all();
        }
        $roles = Role::get();
        $programmes = Programme::get();

        return view('admin.users.index', compact('users', 'roles', 'programmes'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $programs = Programme::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.users.create', compact('roles', 'programs'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        if ($request->input('personal_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('personal_photo')))->toMediaCollection('personal_photo');
        }

        if ($request->input('id_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('id_photo')))->toMediaCollection('id_photo');
        }

        if ($request->input('degree_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('degree_photo')))->toMediaCollection('degree_photo');
        }

        foreach ($request->input('certificates', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificates');
        }

        if ($request->input('cv', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('cv')))->toMediaCollection('cv');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $programs = Programme::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $user->load('roles', 'program');

        return view('admin.users.edit', compact('roles', 'user', 'programs'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        if ($request->input('personal_photo', false)) {
            if (!$user->personal_photo || $request->input('personal_photo') !== $user->personal_photo->file_name) {
                if ($user->personal_photo) {
                    $user->personal_photo->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('personal_photo')))->toMediaCollection('personal_photo');
            }
        } elseif ($user->personal_photo) {
            $user->personal_photo->delete();
        }

        if ($request->input('id_photo', false)) {
            if (!$user->id_photo || $request->input('id_photo') !== $user->id_photo->file_name) {
                if ($user->id_photo) {
                    $user->id_photo->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('id_photo')))->toMediaCollection('id_photo');
            }
        } elseif ($user->id_photo) {
            $user->id_photo->delete();
        }

        if ($request->input('degree_photo', false)) {
            if (!$user->degree_photo || $request->input('degree_photo') !== $user->degree_photo->file_name) {
                if ($user->degree_photo) {
                    $user->degree_photo->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('degree_photo')))->toMediaCollection('degree_photo');
            }
        } elseif ($user->degree_photo) {
            $user->degree_photo->delete();
        }

        if (count($user->certificates) > 0) {
            foreach ($user->certificates as $media) {
                if (!in_array($media->file_name, $request->input('certificates', []))) {
                    $media->delete();
                }
            }
        }

        $media = $user->certificates->pluck('file_name')->toArray();

        foreach ($request->input('certificates', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificates');
            }
        }

        if ($request->input('cv', false)) {
            if (!$user->cv || $request->input('cv') !== $user->cv->file_name) {
                if ($user->cv) {
                    $user->cv->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('cv')))->toMediaCollection('cv');
            }
        } elseif ($user->cv) {
            $user->cv->delete();
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'program', 'userPayments', 'userUserAlerts');

        $user_roles_arr = $user->roles->toArray();
        $user_role = $user_roles_arr[0]['id'];

        // Get user log
        $user_logs = UserLog::where('user_id', $user->id)->get()->toArray();
        if($user_role==7){
            return view('admin.users.showvisitor', compact('user','user_logs'));
        }else{
            return view('admin.users.show', compact('user','user_logs'));
        }
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function verify(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        abort_if(!$user, 404);

        $user->verified           = 1;
        $user->verified_at        = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        //  $user->verification_token = null;
        $user->status = 'Unchecked';
        $user->save();

        return back();
    }
}
