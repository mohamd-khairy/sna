@extends('layouts.admin')
@section('content')
@can('payment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.payments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.payment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.payment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.id') }}
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.user') }}
                        </th>
                        
                        @if($are_lectures?? '')
                            <th>
                                Lecture
                            </th>
                        @else
                            <th>
                                Programme
                            </th>
                        @endif

                        <th>
                            {{ trans('cruds.payment.fields.transaction') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.status') }}
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" style="width: 65px;">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" style="width: 100px;">
                        </td>
                        <td>
                            <select class="search"  style="width: 200px;">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->full_name_en }}">{{ $item->full_name_en }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search"  style="width: 200px;">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($programmes as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}"  style="width: 120px;">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>

                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        <tr data-entry-id="{{ $payment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $payment->id ?? '' }}
                            </td>
                            <td>
                                {{ date_format($payment->updated_at,"Y/M/d ")  ?? '' }}
                            </td>
                            <td>
                                @if($payment->payment_type==2)
                                    {{ $payment->user->name ?? '' }}
                                @else
                                    {{ $payment->user->full_name_en ?? '' }}
                                @endif
                            </td>
                            <td>
                                <!-- $programs_list[$users_programs[$payment->user_id]] ?? '' -->
                                @if($payment->payment_type==2)
                                    {{ $lectures_arr[$payment->lecture_id]?? '' }}
                                @else
                                    {{ $payment->user->program->name?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $payment->transaction ?? '' }}
                            </td>
                            <td>
                                {{ $payment->status ?? '' }}
                            </td>
                            <td>
                                {{ $payment->amount ?? '' }}
                            </td>
                            <td>
                                {{ date_format($payment->updated_at,"Y/M/d ")  ?? '' }}
                            </td>
                            <td>
                                @can('payment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.payments.show', $payment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('payment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.payments.edit', $payment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Payment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
