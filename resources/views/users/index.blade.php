@extends('layouts.app')

@section('content')

    @livewire('users.user-table')


@section('scripts')
    <script>
        var phoneInputs = document.getElementsByName('contact_number');
        phoneInputs.forEach((phoneInput) => {
            phoneInput.addEventListener('input', function(e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });
        })
    </script>
@endsection
@endsection
