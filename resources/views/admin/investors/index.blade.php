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

                @can('user-create')
                    <div class="card-body">
                        <p><a class="btn btn-primary" href="{{ route('admin.investors.create') }}">Նոր ներդնող</a></p>
                    </div><!--row-->
                @endcan

                    {{--Search--}}
                    <div class="card-header">Ֆիլտր</div>
                    <div class="card-body">
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="id" class="col-form-label">Իդ</label>
                                        <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Անուն</label>
                                        <input id="name" class="form-control" name="f_name" value="{{ request('name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Ազգանուն</label>
                                        <input id="name" class="form-control" name="l_name" value="{{ request('name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Փոստ</label>
                                        <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">Որոնել</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--Search end--}}


                <div class="card-header">Բոլոր ներդնողները</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Անուն</th>
                            <th>Ազգանուն</th>
                            <th>Փոստ</th>
                            <th width="310px">Գործողություններ</th>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->f_name }}</td>
                                <td>{{ $user->l_name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.investors.edit',$user->id) }}">Խմբագրել</a>

                                    <form method="post" action="{{ route('admin.investors.destroy', [$user->id]) }}" style='display: inline'>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Ջնջել</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
