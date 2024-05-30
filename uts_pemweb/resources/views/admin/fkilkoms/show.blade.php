@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gallery.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.galleries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.id') }}
                        </th>
                        <td>
                            {{ $gallery->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.nidn') }}
                        </th>
                        <td>
                            {{ $gallery->nidn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.nama_dosen') }}
                        </th>
                        <td>
                            {{ $gallery->nama_dosen }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.kode_matakuliah') }}
                        </th>
                        <td>
                            {{ $gallery->kode_matakuliah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.matakuliah') }}
                        </th>
                        <td>
                            {{ $gallery->matakuliah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.sks') }}
                        </th>
                        <td>
                            {{ $gallery->sks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.jurusan') }}
                        </th>
                        <td>
                            {{ $gallery->jurusan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gallery.fields.image') }}
                        </th>
                        <td>
                            @if($gallery->image)
                                <a href="{{ $gallery->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $gallery->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.galleries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection