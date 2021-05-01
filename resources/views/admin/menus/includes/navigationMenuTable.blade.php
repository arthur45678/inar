
@foreach($tree as $key => $value)
    <?php $dash = ($value['parent'] == 0) ? '' : str_repeat('-', $r) .' '; ?>

    <tr>
        <td>{{ $dash }}{{ $value['title'] }}</td>
        <td>{{ isset($value['path']) ? $value['path'] : '' }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('admin.menus.edit',[$value['id']]) }}">Փոփոխել</a>
        </td>
        
        <td>
            <form method="post" action="{{ route('admin.menus.destroy',[$value['id']]) }}">
                <input type="hidden" name="_method" value="delete">
                {{ csrf_field() }}

                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </td>

    </tr>
    @if($value['parent'] == $p)
        <?php $r = 0; ?>
    @endif

    @if(isset($value['_children']))
        @include('admin.menus.includes.navigationMenuTable', ['tree' => $value['_children'], 'r' => $r+1, $p => $value['parent']])
    @endif

@endforeach


