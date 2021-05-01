
@foreach($tree as $key => $value)
    <?php $dash = ($value['parent'] == 0) ? '' : str_repeat('-', $r) .' '; ?>

    <option value="{{ $value['id'] }}">{{ $dash }}{{ $value['title'] }}</option>

    @if($value['parent'] == $p)
        <?php $r = 0; ?>
    @endif

    @if(isset($value['_children']))
        @include('admin.menus.includes.navigationSelectParentMenu', ['tree' => $value['_children'], 'r' => $r+1, $p => $value['parent']])
    @endif

@endforeach


