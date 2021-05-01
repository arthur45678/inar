@extends('layouts.admin')

@section('styles')

@endsection

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('content')

    @include('admin.includes.info-box')

    <main>

        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                {{ $title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main page content-->
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Անուն</th>
                            <th width="320px">Գործողություն</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.roles.show',$role->id) }}">Տեսնել</a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('admin.roles.edit',$role->id) }}">Փոփոխել</a>
                                    @endcan
                                    @can('role-delete')
                                        <form method="post" action="{{ route('admin.roles.destroy', [$role->id]) }}" style="display: inline">
                                            @csrf()
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Ջնջել</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>


                    {!! $roles->render() !!}
                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
