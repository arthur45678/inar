
@foreach($tree as $key => $value)
    <?php $dash = ($value['parent'] == 0) ? '' : str_repeat('-', $r) .' '; ?>
    @if($menu->id == $value['id'])
        @continue
    @endif

    @if($menu->parent == $value['id'])

        <option  selected="selected" value="{{ $value['id'] }}">{{ $dash }}{{ $value['title'] }}</option>
    @else
        <option value="{{ $value['id'] }}">{{ $dash }}{{ $value['title'] }}</option>
    @endif


    @if($value['parent'] == $p)
        <?php $r = 0; ?>
    @endif

    @if(isset($value['_children']))
        @include('admin.menus.includes.editSelect', ['tree' => $value['_children'], 'r' => $r+1, $p => $value['parent'],'menu' => $menu])
    @endif

@endforeach


