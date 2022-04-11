<!-- Modal -->
<div class="modal fade" id="addRoleModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
    aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Role</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('roles.store') }}" method="post" id="addRoleForm">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-md-12">
                            <label for="role_name" class="form-label">Name of Role</label>
                            <input type="text" class="form-control" name="role_name" id="role_name"
                                placeholder="Manager">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addRoleButton">Add Role</button>
            </div>
        </div>
    </div>
</div>
