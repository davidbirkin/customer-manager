@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        @include('components.alert')
        <div class="card-header">
            <span class="d-inline-flex align-middle h-100">{{ __('Users') }}</span>
            <button class="btn btn-primary btn-sm float-end" data-coreui-toggle="modal"
                data-coreui-target="#addUserModal">Add User</button>
        </div>
        <div class="card-body table-responsive">
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
                                <button class="btn btn-warning btn-sm float-end editUser" data-userid="{{ $user->id }}"
                                    data-coreui-toggle="modal" data-coreui-target="#editUserModal">Edit User</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
    @include('users.add_user')
    @include('users.edit_user')

@section('scripts')
    <script>
        var editModal = new coreui.Modal(document.getElementById('editUserModal'));
        var editButtons = document.querySelectorAll('.editUser');
        editButtons.forEach((button) => {
            button.addEventListener('click', getUser);
        })

        document.getElementById('update_user').addEventListener('click', updateUser);

        var phoneInputs = document.getElementsByName('contact_number');
        phoneInputs.forEach((phoneInput) => {
            phoneInput.addEventListener('input', function(e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });
        })

        async function getUser(e) {
            e.preventDefault()
            let userId = e.target.dataset.userid;
            let url = '/users/' + userId + '/edit'
            const options = createFetchRequest("GET")
            const response = await makeFetchRequest(url, options)
                .then(async function(user) {
                    await populateModal(user);
                    editModal.toggle()
                })
                .catch(function(err) {
                    console.log(err)
                    alert(err)
                })
        }

        async function updateUser(e) {
            e.preventDefault();
            const form = document.getElementById('edit_user_form');
            const token = form.firstElementChild.value;
            const formData = new FormData(form);
            const plainFormData = Object.fromEntries(formData.entries());
            const jsonDataString = JSON.stringify(plainFormData)
            const url = "/users/" + plainFormData.id + "/update";

            const response = await postRequest(url, jsonDataString, token).then(function(response) {
                var heading = "User Update Successful"
                var content = `${response.user.full_name} has been updated successfully`
                showToast(heading, content)
                editModal.toggle()
                console.log(response)
            })
        }

        function populateModal(user) {
            let parsedUser = JSON.parse(JSON.stringify(user));
            Object.keys(parsedUser).forEach(function(key) {
                if (key == "role") return;

                if (parsedUser[key] != null && key !== "role_id") {
                    document.querySelector("#edit_user_form input[name='" + key + "']").value =
                        parsedUser[key];
                }

                if (parsedUser[key] != null & key == "role_id") {
                    document.querySelector("#edit_user_form select[name='" + key + "']")
                        .selectedIndex = parsedUser[key];
                }
            })
        }
    </script>
@endsection
@endsection
