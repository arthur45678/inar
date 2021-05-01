@extends('layouts.account')

@section('styles')

@endsection

@section('content')

    <div class="section-header">
        <h1>{{ $title }}</h1>

    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Բարև {{ Auth::user()->f_name  ?? ' ' . ' '.Auth::user()->l_name  ?? ' '}}  {{__('You are logged in!') }}</h4>
                    </div>
                    <div class="card-body">



                       Մենեջեր: {{ Auth::user()->manager->f_name  ?? ' ' }}&nbsp;{{ Auth::user()->manager->l_name  ?? ' ' }}


                        <form method="post" action="{{ route('account.profiles.update', [$user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Անուն</label>
                                <input type="text" name="f_name" id="name" value="{{ $user->f_name  ?? ' ' }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Ազգանուն</label>
                                <input type="text" name="l_name" id="l_name" value="{{ $user->l_name  ?? ' ' }}" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="img">Նկար</label>
                                        <input type="file" name="img" id="img" value="" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($user->img)
                                        <img style="max-width: 118px" src="{{ $imagePath }}/{{ $user->img }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif

                                </div>
                            </div><!--row-->

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" id="email" value="{{ $user->email  ?? ' '}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Հեռ. 1</label>
                                <input type="tel" name="phone_1" id="phone_1" value="{{ $user->phone_1 ?? ' ' }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone_2">Հեռ. 2</label>
                                <input type="tel" name="phone_2" id="phone_2" value="{{ $user->phone_2 ?? ' ' }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Գաղտնաբառ</label>
                                <input type="password" name="password" id="password" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Կրկնել գաղտնաբառը</label>
                                <input type="password" name="confirm-password" id="confirm-password" value="" class="form-control">
                            </div>



                            <h4>Կազմակերպություն</h4>
                            <div class="form-group">
                                <label for="[company']['company_name']">Կազմակերպության անունը</label>
                                <input type="text" name="company[company_name]" id="company_name" value="{{ $company->company_name ?? ''}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="company_name">Ծրագրի անունը</label>
                                <input type="text" name="company[program_name]" id="program_name" value="{{ $company->program_name ?? '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="company_name">Կազմակերպության հասցե</label>
                                <input type="text" name="company[company_address]" id="company_address" value="{{ $company->company_address ?? '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="company_name">Կազմակերպության հեռ.</label>
                                <input type="text" name="company[company_phone_1]" id="company_phone_1" value="{{ $company->company_phone_1 ?? ''}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="company_phone_2">Կազմակերպության հեռ.</label>
                                <input type="text" name="company[company_phone_2]" id="company_phone_1" value="{{ $company->company_phone_2 ?? '' }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </div>
                    <div class="card-footer">
                        Footer Card
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

@endsection
