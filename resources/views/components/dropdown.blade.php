<select class="form-select" name="{{ $name }}">
    @foreach($options as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>
