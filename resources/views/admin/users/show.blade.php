@extends('layouts.admin')
@section('content')
@php
$user_roles_arr = $user->roles->toArray();
@endphp
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="javascript:history.back()">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.program') }}
                        </th>
                        <td>
                            {{ $user->program->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <td>
                            {{ $user->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.full_name_en') }}
                        </th>
                        <td>
                            {{ $user->full_name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.full_name_ar') }}
                        </th>
                        <td>
                            {{ $user->full_name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.personal_photo') }}
                        </th>
                        <td>
                            @if($user->personal_photo)
                                <a href="{{ $user->personal_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->personal_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.national') }}
                        </th>
                        <td>
                            {{ $user->national }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id_photo') }}
                        </th>
                        <td>
                            @if($user->id_photo)
                                <a href="{{ $user->id_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->id_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.birth_date') }}
                        </th>
                        <td>
                            {{ $user->birth_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.birth_country') }}
                        </th>
                        <td>
                            {{ $user->birth_country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <td>
                            {{ $user->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.state') }}
                        </th>
                        <td>
                            {{ $user->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.linkedin') }}
                        </th>
                        <td>
                            {{ $user->linkedin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.undergraduate') }}
                        </th>
                        <td>
                            {{ App\Models\User::UNDERGRADUATE_SELECT[$user->undergraduate] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.degree') }}
                        </th>
                        <td>
                            {{ App\Models\User::DEGREE_SELECT[$user->degree] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.degree_photo') }}
                        </th>
                        <td>
                            @if($user->degree_photo)
                                <a href="{{ $user->degree_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->degree_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.certificates') }}
                        </th>
                        <td>
                            @foreach($user->certificates as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.cv') }}
                        </th>
                        <td>
                            @if($user->cv)
                                <a href="{{ $user->cv->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.personal_statement') }}
                        </th>
                        <td>
                            {{ $user->personal_statement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.know_us') }}
                        </th>
                        <td>
                            {{ App\Models\User::KNOW_US_RADIO[$user->know_us] ?? '' }}
                        </td>
                    </tr>
                    @foreach( Auth::user()->roles as $roles)
                        @if($roles['title']=='CEO'  )
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.know_us') }}
                                </th>
                                <td>
                                    {{ App\Models\User::KNOW_US_RADIO[$user->know_us] ?? '' }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="col-lg-12" style="display: flex" >
                <div class="col-lg-2">
                    <select class="form-control " id="select_action" required>
                        <option value="Unchecked" {{ old('status', $user->status) === 'Unchecked' ? 'selected' : '' }}>Unchecked</option>
                        <option value="Approve" {{ old('status', $user->status) === 'Approve' ? 'selected' : '' }}>Approve</option>
                        <option value="Refused" {{ old('status', $user->status) === 'Refused' ? 'selected' : '' }}>Refused</option>
                        <option value="Pending" {{ old('status', $user->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Withdrawal" {{ old('status', $user->status) === 'Withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <input id="Reason" class="form-control"  placeholder="Please add A reasons" type="hidden"  value="{{ old('reason', $user->reason) }}" />
                </div>
                <button class="btn btn-danger " id="approval" type="submit" >
                    {{ trans('global.save') }}
                </button>
            </div>
        </br>
            @foreach( Auth::user()->roles as $roles)
                @if($roles['title']=='CEO' && $user_roles_arr[0]['id']!=7 )
                        <div class="col-lg-12" style="display: flex" >
                            <div class="col-lg-2">
                                <input type="hidden" name="installment" value="0">
                                <input class="form-check-input" type="checkbox" name="installment" id="installment" value="1" {{ old('installment', $user->installment) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="installment">{{ trans('cruds.user.fields.installment') }}</label>
                            </div>
                            <div class="col-lg-2">
                                <input id="installment_amount" class="form-control" min="1000" max="25000" type="hidden"  value="{{ old('installment_amount', $user->installment_amount) }}" />
                            </div>
                            <button class="btn btn-success " id="diff_installment" type="submit" >
                                {{ trans('global.save') }}
                            </button>
                        </div>

                    @if($user->status == 'Refused' || $user->status == 'Withdrawal' )
                        <button class="btn btn-success  col-lg-5 offset-3" id="confirmDisApproval" type="submit" >
                            Confirm {{ $user->status }} and send Email To student
                        </button>
                    @endif
                @endif
            @endforeach

        <!-- Image loader -->
            <div id='loader' class="offset-4 " style='display: none;'>
                <img src="{{ asset('reload.gif') }}" width='150px' height='150px'>
            </div>
            <!-- Image loader -->
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.user_log.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_payments">
            @includeIf('admin.users.relationships.userPayments', ['payments' => $user->userPayments])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_logs">
            @includeIf('admin.users.relationships.userUserLogs', ['userLogs' => $user_logs])
        </div>
    </div>
</div>

@endsection
@section('scripts')
 <script>
    $('#select_action').change(function(){
        var val =$(this).val();
        if(val=='Refused'||val=='Pending'||val=='Withdrawal'){
            $('#Reason').attr('type','text');
        }else {
            $('#Reason').attr('type','hidden');
        }
    });
    $('#approval').click(function(){
        var val =$('#select_action').val();
        $('#approval').attr('disabled',true);
        if(val=='Refused'||val=='Pending'||val=='Withdrawal'){
            if($('#Reason').val()==''){
              return  alert('Please add a reason');
            }
        }
        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ route('admin.users.approval') }}',
            data:'userID={{ $user->id }}&selection= '+$('#select_action').val()+'&reason='+$('#Reason').val(),
            beforeSend: function(){
                // Show image container
                $("#loader").show();
                // return false;
            },
            success:function(data) {
                // location.reload();
                console.log(data)
                return false;
            }
        });
    })

    $('#installment').change(function(){
        var val =$(this).val();
        if($('#installment').is(':checked')){
            $('#installment_amount').attr('type','number');
            $('#installment_amount').attr('value',12850);
        }else {
            $('#installment_amount').attr('type','hidden');
            $('#installment_amount').attr('value',0);
        }
    });
    $('#diff_installment').click(function(){
        var installment= 0 ;
        $('#diff_installment').attr('disabled',true);
        if($('#installment').is(':checked')){
            installment = 1 ;
            if($('#installment_amount').val()==''||$('#installment_amount').val()>25700||$('#installment_amount').val()<0){
                return  alert('Please add a valid installment amount');
            }
        }
        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ route('admin.users.installment') }}',
            data:'userID={{ $user->id }}&installment= '+installment+'&installment_amount='+$('#installment_amount').val(),
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success:function(data) {
                location.reload();
            }
        });
    })
    $('#confirmDisApproval').click(function(){
        $('#confirmDisApproval').attr('disabled',true);
        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ route('admin.users.disapproval') }}',
            data:'userID={{ $user->id }}',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success:function(data) {
                location.reload();

            }
        });
    })
    @if($user->status == 'Refused'||$user->status == 'Pending'||$user->status == 'Withdrawal')
    $('#Reason').attr('type','text');
    @endif
    @if($user->installment == 1)
    $('#installment_amount').attr('type','text');
     @endif
</script>
@endsection

