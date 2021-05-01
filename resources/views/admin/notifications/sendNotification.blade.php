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
                    <form method="post" action="{{ route('admin.notifications.storeNotifications') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-check">
                            <input name="send_all_investors" type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Ուղարկել բոլոր ներդրողներին</label>
                        </div>

                        <div class="form-group">
                            <label for="receivers">Ընտրել ում ուղարկել</label>
                            <select name="receivers[]" id="receivers" class="select2 form-control"  multiple="multiple">
                                @foreach($receivers as $item)
                                    <option value="{{ $item->id }}">{{ $item->f_name }}&nbsp;{{ $item->l_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Վեռնագիր</label>
                            <input type="text" name="name" id="name" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="text">Տեքստ</label>
                            <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ուղարկել</button>
                        </div>

                    </form>





                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
