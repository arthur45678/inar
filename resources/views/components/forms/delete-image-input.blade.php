@if(isset($item, $fieldName))
        <label for="delete_image">Удалить изображение</label>
        <input type="checkbox" id="delete_image" name="delete_image[{{ $item->image }}]">
@endif
