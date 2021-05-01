@extends('layouts.account')

@section('styles')

@endsection

@section('content')

    <div class="section-header">
        <h4>{{ Auth::user()->f_name }}&nbsp;{{ Auth::user()->l_name }}</h4>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header"> -->
                        <!-- <h4 class="col-md-4 px-0">Բարև {{ Auth::user()->f_name . ' '.Auth::user()->l_name}}  {{__('You are logged in!') }}</h4> -->
                    <!-- </div> -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mt-3 mr-1">
                               @include('account.includes.sidebar')
                            </div>
                        <div class="col-md-8 col-sm-12 mt-3 ml-sm-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <div>Էլ. հասցե՝ {{ Auth::user()->email  }}</div>
                                     <div>Հեռ.`{{ Auth::user()->phone_1  }}&nbsp{{ Auth::user()->phone_2  }};</div>

                                </div>
                            </div>
                        </div><!--row-->

                        <div class="row">

                            <div class="col-md-12">

                                <p>Ուղարկվել է: {{ $message->created_at }}</p>
                                <h3>Կարդալ հաղորդագրությունը</h3>
                                <h2>Վերնագիր: {{ $message->mysite }}</h2>
                                <h5>Ուղարկող{{ $message->receiver->f_name }}&nbsp;{{ $message->receiver->l_name }}</h5>
                                <div class="">

                                    {{ $message->text }}
                                </div>
                            </div>

                        </div><!--row-->

                        </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

@endsection
