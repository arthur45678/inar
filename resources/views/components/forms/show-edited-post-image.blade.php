<div class="form-group">
    @if($item->image)
        <img style="max-width: 118px" src="{{ $imagePath }}/{{ $item->image }}" alt="">
    @else
        {{--no-image.jpg--}}
        <img style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
    @endif
</div>
