<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}">{{ ucfirst($name) }}</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes }}
    />
    @error($name)
    <span class="help-block">{{ $message }}</span>
    @enderror
</div>
