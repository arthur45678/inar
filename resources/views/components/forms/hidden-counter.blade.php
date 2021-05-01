{{-- incommings: $type="hidden", $class, $name --}}
{{-- @dump($old_default) --}}
<input type="{{$type}}" class="{{$counter_class}}" name="{{$counter_name}}" value="{{old($counter_name, $old_default)}}">
