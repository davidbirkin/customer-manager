<div>
    <div class="card mb-4">
        <div class="card-header">
            <span class="d-inline-flex align-middle h-100">{{ __('Roles') }}</span>
            <button class="btn btn-primary btn-sm float-end" data-coreui-toggle="modal" wire:click.prevent="create">Add
                Role</button>
        </div>

        <div class="card-body table-responsive">
            <div class="w-25">
                Search:
                <input type="text" wire:model.debounce.300ms="search" class="form-control mb-2 w-100" />
            </div>
            <table class="table table-sm table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" data-sortable="true">Role Name</th>
                        <th scope="col" data-sortable="true">Users With Role</th>
                        <th scope="col">Date Added</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->users_count }}</td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm float-end"
                                    style="margin-right: 10px !important; color:white;" data-coreui-toggle="modal"
                                    wire:click.prevent="edit({{ $role->id }})">Edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan=" 4" class="text-center">No roles have been added at this time. You can add
                                a new role now!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Modal -->
            <div class="modal" @if ($showModal) style="display:block" @endif tabindex="-1"
                aria-labelledby="addRoleModalLabel" aria-hidden="true">
                <form method="get" class="modal-dialog modal-lg" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="staticBackdropLabel">{{ $modal_title ?? '' }}</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3 col-sm-12 col-md-12">
                                        <label for="role_name" class="form-label">Name of Role</label>
                                        <input type="text" class="form-control" name="name" wire:model="role.name"
                                            placeholder="Manager">
                                        @if ($errors->has('role.name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('role.name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-secondary btn-sm" data-coreui-dismiss="modal"
                                    style="color:white; background-color:  !important ">Close</button>
                                <button class="btn btn-danger btn-sm float-end"
                                    wire:click.prevent="deleteConfirm({{ $role->id }})">Delete</button>
                                <button type="button" class="btn btn-sm btn-primary"
                                    wire:click.prevent="save(@if ($modal_title == 'Add Role') true @else false @endif)">{{ $modal_button_text ?? '' }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
