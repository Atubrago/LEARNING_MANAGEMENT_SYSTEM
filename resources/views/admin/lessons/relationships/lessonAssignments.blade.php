<div class="content">
    @can('assignment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.assignments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.assignment.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.assignment.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-lessonAssignments">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.assignment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignment.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignment.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignment.fields.lesson') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignment.fields.deadline') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignment.fields.file') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $key => $assignment)
                                    <tr data-entry-id="{{ $assignment->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $assignment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignment->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignment->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignment->lesson->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignment->deadline ?? '' }}
                                        </td>
                                        <td>
                                            @if($assignment->file)
                                                <a href="{{ $assignment->file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('assignment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.assignments.show', $assignment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('assignment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.assignments.edit', $assignment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('assignment_delete')
                                                <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('assignment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assignments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-lessonAssignments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection