@extends('layouts.admin')
@section('content')
@can('fkilkom_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fkilkoms.create') }}">
                {{ trans('global.add') }} {{ trans('') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('Fakultas Ilmu Komputer') }} {{ trans('') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Gallery">
                <thead>
                    <tr>
                        <th width="20">

                        </th>
                        <th>
                            {{ trans('id') }}
                        </th>
                        
                        <th>
                            {{ trans('NIDN') }}
                        </th>
                        <th>
                            {{ trans('Nama Dosen') }}
                        </th>
                        <th>
                            {{ trans('Kode MataKuliah') }}
                        </th>
                        <th>
                            {{ trans('MataKuliah') }}
                        </th>
                        <th>
                            {{ trans('SKS') }}
                        </th>
                        <th>
                            {{ trans('Jurusan') }}
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fkilkom as $key => $f)
                        <tr data-entry-id="{{ $f->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $f->id ?? '' }}
                            </td>
                            <td>
                                {{ $f->nidn ?? '' }}
                            </td>
                            <td>
                                {{ $f->nama_dosen ?? '' }}
                            </td>
                            <td>
                                {{ $f->kode_matakuliah ?? '' }}
                            </td>
                            <td>
                                {{ $f->matakuliah ?? '' }}
                            </td>
                            <td>
                                {{ $f->sks ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Fkilkom::JURUSAN_SELECT[$f->jurusan] ?? '' }}
                            </td>
                          
                            <td>
                                @can('fkilkom_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.fkilkoms.show', $f->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('fkilkom_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.fkilkoms.edit', $f->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('fkilkom_delete')
                                    <form action="{{ route('admin.fkilkoms.destroy', $f->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fkilkom_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fkilkoms.massDestroy') }}",
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
  let table = $('.datatable-Gallery:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection