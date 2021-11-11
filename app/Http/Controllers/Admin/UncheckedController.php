<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Programme;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UncheckedController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('binding_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(!Gate::denies('Egyptology_Student')){
            $users = User::where('program_id','1')->where('status','like','Unchecked')->get();
        }else if(!Gate::denies('BioHealth_Student')){
            $users = User::where('program_id','2')->where('status','like','Unchecked')->get();
        }else{
            // $users = User::where('status','like','Unchecked')->get();
            $users = User::where('status','like','Unchecked')->whereHas('roles', function($q){
                $q->where('id', '!=', 7);
            })->get();
        }
        //$users = User::where('status','like','Unchecked')->get();

        $roles = Role::get();
        $programmes = Programme::get();
        return view('admin.users.index', compact('users', 'roles','programmes'));
    }
    public function visitors()
    {
        abort_if(Gate::denies('binding_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::where('status','like','Unchecked')->whereHas('roles', function($q){
            $q->where('id', '=', 7);
        })->get();

        $roles = Role::get();
        $programmes = Programme::get();
        return view('admin.users.index', compact('users', 'roles','programmes'));
    }


}
