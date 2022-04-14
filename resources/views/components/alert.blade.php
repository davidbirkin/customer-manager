@if ($flash_message)
    <div class="alert alert-{{ $alert_type }} alert-dismissible" role="alert">
        @if ($alert_type == 'success')
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
        @endif
        {!! $flash_message !!}
        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"
            wire:click.prevent="hideAlert"></button>
    </div>
@endif
