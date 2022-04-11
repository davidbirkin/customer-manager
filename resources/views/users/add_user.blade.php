<!-- Modal -->
<div class="modal fade" id="addUserModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
    aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-md-6">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                placeholder="John Smith">
                        </div>
                        <div class="mb-3 col-sm-12 col-md-6">
                            <label for="email_address" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email_address" id="email_address"
                                placeholder="johnsmith@company.com">
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="address_line_1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" name="address_line_1" id="address_line_1"
                            placeholder="123 Main Street">
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-md-6">
                            <label for="address_line_2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" name="address_line_2" id="address_line_2"
                                placeholder="Unit, Apt, Floor.">
                        </div>
                        <div class="mb-3 col-sm-12 col-md-6">
                            <label for="postal_code" class="form-label">Postal/Zip Code</label>
                            <input type="text" class="form-control" name="postal_code" id="postal_code"
                                placeholder="12345">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-md-6">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" name="contact_number" id="contact_number"
                                placeholder="123-444-5555" pattern="[1-9]{3}-[0-9]{3}-[0-9]{4}">
                        </div>
                        <div class="mb-3 col-sm-12 col-md-6">
                            <label for="role" class="form-label">User Role</label>
                            <select class="form-select form-select-sm" name="role_id"
                                aria-label=".form-select-sm example">
                                <option selected>Please Select</option>
                                @if (!empty($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add User</button>
            </div>
        </div>
    </div>
</div>
