@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        @include('components.alert')
        <div class="card-header">
            <span class="d-inline-flex align-middle h-100">{{ __('Roles') }}</span>
            <button class="btn btn-primary btn-sm float-end" data-coreui-toggle="modal"
                data-coreui-target="#addRoleModal">Add Role</button>
        </div>

        <div class="card-body table-responsive">
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
                                <button class="btn btn-warning btn-sm float-end" data-roleid="{{ $role->id }}"
                                    data-coreui-toggle="modal" data-coreui-target="#editRoleModal">Edit Role</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No roles have been added at this time. You can add a
                                new role now!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('roles.add_role')

    @section('scripts')
        <script>
            var addButton = document.querySelector('.addRoleButton').addEventListener('click', addNewRole)
            var addRoleModal = new coreui.Modal(document.getElementById('addRoleModal'));
            var form = document.getElementById('addRoleForm')

            async function addNewRole() {
                const url = form.action;
                const token = form.firstElementChild.value;
                const formData = new FormData(form);
                const options = createFetchRequest("POST", formData, token)
                const response = await makeFetchRequest(url, options);

                if (response.status === "success") {
                    var heading = "New Role Added Successfully"
                    var content = `${form.role_name.value} has been added successfully`
                    addRoleModal.hide()
                    showToast(heading, content)

                }

            }
        </script>
    @endsection
@endsection
