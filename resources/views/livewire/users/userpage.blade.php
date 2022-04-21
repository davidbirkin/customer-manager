<div>

    @if ($flash_message)
        <div class="alert alert-{{ $alert_type }} alert-dismissible" role="alert">
            @if ($alert_type == 'success')
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
            @endif
            {!! $flash_message !!}
            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <span class="d-inline-flex align-middle h-100">{{ __('Users') }}</span>
            <button class="btn btn-primary btn-sm float-end" wire:click="create">Add User</button>
        </div>
        <div class="card-body table-responsive">
            <div class="w-25">
                Search:
                <input type="text" wire:model.debounce.300ms="search" class="form-control mb-2 w-100" />
            </div>
            <table class="table table-sm table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email_address }}</td>
                            <td>{{ $user->contact_number ?? 'Not Set' }}</td>
                            <td>{{ $user->role->name ?? 'Not Set' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm float-end"
                                    wire:click.prevent="edit({{ $user->id }})">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal" @if ($showModal) style="display:block" @endif
                data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="staticBackdropLabel">{{ $modal_title }}</h5>
                            <form wire:submit.prevent="save">
                                @csrf
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input wire:model="user.full_name" type="text"
                                        class="form-control @if ($errors->has('user.full_name')) is-invalid @endif"
                                        name="full_name" id="full_name" placeholder="John Smith">
                                    @if ($errors->has('user.full_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user.full_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="email_address" class="form-label">Email Address</label>
                                    <input wire:model="user.email_address" type="email"
                                        class="form-control @if ($errors->has('user.email_address')) is-invalid @endif"
                                        name="email_address" id="email_address" placeholder="johnsmith@company.com">
                                    @if ($errors->has('user.email_address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user.email_address') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="address_line_1" class="form-label">Address Line 1</label>
                                <input wire:model="user.address_line_1" type="text"
                                    class="form-control @if ($errors->has('user.address_line_1')) is-invalid @endif"
                                    name="address_line_1" id="address_line_1" placeholder="123 Main Street">
                                @if ($errors->has('user.address_line_1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user.address_line_1') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="address_line_2" class="form-label">Address Line 2</label>
                                    <input wire:model="user.address_line_2" type="text"
                                        class="form-control @if ($errors->has('user.address_line_2')) is-invalid @endif"
                                        name="address_line_2" id="address_line_2" placeholder="Unit, Apt, Floor.">
                                    @if ($errors->has('user.address_line_2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user.address_line_2') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="postal_code" class="form-label">Postal/Zip Code</label>
                                    <input wire:model="user.postal_code" type="text"
                                        class="form-control @if ($errors->has('user.postal_code')) is-invalid @endif"
                                        name="postal_code" id="postal_code" placeholder="12345">
                                    @if ($errors->has('user.postal_code'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user.postal_code') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input wire:model="user.contact_number" type="tel"
                                        class="form-control @if ($errors->has('user.contact_number')) is-invalid @endif"
                                        name="contact_number" id="contact_number" placeholder="(123) 444-5555">
                                    @if ($errors->has('user.contact_number'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user.contact_number') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="role" class="form-label">User Role</label>
                                    <select wire:model="user.role_id" class="form-select form-select-sm" name="role_id"
                                        aria-label="form-select example">
                                        <option selected>Please Select...</option>
                                        @if (!empty($roles))
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('user.role_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user.role_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="id" wire:model="user.id">

                        </div>
                        <div class="modal-footer border-top-0">
                            <button wire:click="close" type="button" class="btn btn-secondary"
                                data-coreui-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_user"
                                wire:click="save(@if ($modal_title == 'Create User') true @else false @endif)">{{ $modal_button_text }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
