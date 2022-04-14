<?php

namespace App\Http\Livewire\Roles;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Rolepage extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except', 1]
    ];
    public $success = false;
    public $flash_message = false;
    public $alert_type;

    public $modal_button_text;
    public $modal_title;

    public int $perPage = 5;
    public string $search = '';
    public $showModal = false;
    public $page = 1;
    public Role $role;

    protected $listeners = [
        'delete'
    ];

    protected function rules()
    {
        return [
            'role.name' => "required|string|unique:roles,name"
        ];
    }

    public function mount()
    {
        $this->perPage = 5;
    }

    public function render()
    {
        $roles = Role::query()
            ->when($this->search !== '', function($query) { 
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('users')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        if ($roles->total() <= 5) {
            $this->resetPage();
        };

        return view('livewire.roles.rolepage', [
            "roles" => $roles
        ]);
    }

    public function updated($name, $value)
    {
        if($name == 'role.name') $this->validateOnly('role.name');
    }

    public function create()
    {
        $this->role = new Role();
        $this->modal_title = "Add Role";
        $this->modal_button_text = "Add Role";
        $this->showModal = true;
    }

    public function edit($roleId)
    {
        $this->modal_title = "Edit Role";
        $this->modal_button_text = "Save Role Update";
        $this->showModal = true;
        $this->role = Role::find($roleId);
    }

    public function deleteConfirm($roleId)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            "title" => 'Are you absolutely sure', 
            "text" => "", 
            "id" => $roleId,
            "confirmconfirmButtonText" => "Yes",
            "showDenyButton" => true
        ]);
    }

    public function delete($roleId)
    {   
        ray('inside delete');
        $this->role = Role::find($roleId);
        $user = User::where('role_id', $roleId)->update(['role_id' => null]);
        $this->role->delete();
    }

    public function save($newRole)
    {
        $this->flash_message = "Existing Role <strong>" . $this->role->name . "</strong> has been updated successfully";
        $this->alert_type = 'success';

        if ($newRole == true) {
            $this->flash_message = "New Role <strong>" . $this->role->name . "</strong>, saved successfully";
        }

        $this->role->save();
        $this->showModal = false;
    }

    public function hideAlert()
    {
        $this->flash_message = "";
        $this->alert_type = '';
    }
}
