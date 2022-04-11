@if (isset($flash_message))
    <div class="alert alert-{{ $alert_type }}" role="alert">
        {{ $flash_message }}
    </div>
@endif
