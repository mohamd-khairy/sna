<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles'])->get());
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

        if ($request->input('certificates', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('certificates')))->toMediaCollection('certificates');
        }

        if ($request->input('cv', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('cv')))->toMediaCollection('cv');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
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

        if ($request->input('certificates', false)) {
            if (!$user->certificates || $request->input('certificates') !== $user->certificates->file_name) {
                if ($user->certificates) {
                    $user->certificates->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('certificates')))->toMediaCollection('certificates');
            }
        } elseif ($user->certificates) {
            $user->certificates->delete();
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

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
