<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\SendUnPaidEmailNotification;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UnpaidApplicantsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('Send_Email_Unpaid'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $payed_users= Payment::SELECT('user_id')->Where('status','Captured')->pluck('user_id')->toArray();
       // $unpaid_users= User::whereNotIn('id',$payed_users)->pluck('id')->toArray();
        $users = User::whereHas('roles', function ($q) {
            return $q->where('id', 3);
        })->whereNotIn('id',$payed_users)->where('status','like','Approve')->get();
       // dd($users->pluck('full_name_en')->toArray());
        foreach ($users as $user){
            Notification::send($user, new SendUnPaidEmailNotification($user));
        }
        return redirect('/admin');
    }


}
