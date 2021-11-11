<div class="card">
    <div class="card-header">
        {{ trans('cruds.user_log.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            User Action
                        </th>
                        <th>
                            Date / Time
                        </th>
                    </tr>
                    @foreach($userLogs as $k => $v)
                        <tr>
                            <td>
                                {{$v['log_message']}}
                            </td>
                            <td>
                                {{$v['created_at']}}
                            </td>
                        </tr>
                    @endforeach
                    


                </tbody>
            </table>


        </div>
    </div>
</div>
