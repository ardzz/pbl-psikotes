@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @endforeach
@endif
