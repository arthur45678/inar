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
                   <table class="table table-hover">
                       <thead>
                           <tr>
                               <th>Վեռնագիռ</th>
                               <th>Տեքստ</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>{{ $post->name }}</td>
                               <td>{{ $post->text }}</td>
                           </tr>

                       </tbody>
                   </table>


                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
