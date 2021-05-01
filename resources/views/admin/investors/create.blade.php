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
                    <form method="post" action="{{ route('admin.investors.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Անուն</label>
                            <input type="text" name="f_name" id="name" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Ազգանուն</label>
                            <input type="text" name="l_name" id="l_name" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="img">Նկար</label>
                            <input type="file" name="img" id="img" value="" class="form-control-file">
                        </div>


                        <div class="form-group">
                            <label for="name">Էլ․փոստ</label>
                            <input type="email" name="email" id="email" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Հեռ. 1</label>
                            <input type="tel" name="phone_1" id="phone_1" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone_2">Հեռ. 2</label>
                            <input type="tel" name="phone_2" id="phone_2" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Գաղտնաբառ</label>
                            <input type="password" name="password" id="password" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Կրկնել գաղտնաբառը</label>
                            <input type="password" name="confirm-password" id="confirm-password" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Ընտրել մենեջեր</label>
                            <select class="form-control" name="manager_id" id="manager_id">
                                @foreach($managers as $item)
                                    <option value="{{ $item->id }}">{{ $item->f_name }}&nbsp;{{ $item->l_name }}</option>
                                @endforeach
                                <option value="{{ $item->id }}"></option>
                            </select>
                        </div>

                        <h4>Կազմակերպություն</h4>
                        <div class="form-group">
                            <label for="[company']['company_name']">Կազմակերպության անունը</label>
                            <input type="text" name="company[company_name]" id="company_name" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="company_name">Ծրագրի անունը</label>
                            <input type="text" name="company[program_name]" id="program_name" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="company_name">Կազմակերպության հասցե</label>
                            <input type="text" name="company[company_address]" id="company_address" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="company_name">Կազմակերպության հեռ. 1</label>
                            <input type="text" name="company[company_phone_1]" id="company_phone_1" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="company_phone_2">Կազմակերպության հեռ. 2</label>
                            <input type="text" name="company[company_phone_2]" id="company_phone_1" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ավելացնել</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </main>
@endsection

@section('scripts')

@endsection
