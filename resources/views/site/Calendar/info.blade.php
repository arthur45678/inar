@if($post->img)
    <img style="max-width: 318px; object-fit: contain;" src="{{ showImage($post->img) }}" alt="">

@endif

<p class="event_title" style="">{{$post->name ?? ' '}}</p>
<p class="event_text">{!! $post->text !!}</p>
<p class="event_text">{{\Carbon\Carbon::parse($post->event_started_date)->format('H:i') ?? ' '}}</p>
