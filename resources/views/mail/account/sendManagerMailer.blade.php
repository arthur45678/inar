@component('mail::message')

    @component('mail::message')
        {{  $data['title'] }}

    @component('mail::message')
        {{ $data['body'] }}
    @component('mail::button', ['url' => url('/')])

    @endcomponent

    Այցելել կայք<br>
    {{ env('APP_NAME') }}
@endcomponent
