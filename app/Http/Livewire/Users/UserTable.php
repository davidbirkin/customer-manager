<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Traits\WithSorting;

class UserTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => [
            'except' => ''
        ]
    ];

    public string $name;
    public $full_name;
    public $email_address;
    public $address_line_1;
    public $address_line_2;
    public $contact_number;
    public $postal_code;
    public $role_id;
    public $success = false;
    public $roles;
    public $flash_message = false;
    public $alert_type;
    public $modal_button_text;

    public int $perPage;
    public string $email;
    public string $search = '';
    public $showModal = false;
    public User $user;
    public $modal_title;
    protected $password;

    public function mount(User $user)
    {
        $this->email = '';
        $this->perPage = 5;
        $this->user = $user;
        $this->roles = Role::all();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search !== '', function($query) { 
                $query->where('full_name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.users.user-table', [
            'users' => $users,
            'roles' => $this->roles
        ]);
    }

    public function rules()
    {
        return [
            'user.full_name' => 'required|string|min:3|max:100', 
            'user.email_address' => 'required|email|'. Rule::unique('users', 'email_address')->ignore($this->user->id),
            'user.address_line_1' => 'nullable|string|max:100',
            'user.address_line_2' => 'nullable|string|max:100',
            'user.contact_number' => 'nullable|string|regex:/^\(\d{3}\).*?([0-9]{3}).*?([0-9]{4})/',
            'user.postal_code' => 'nullable|string|max:10',
            'user.role_id' => 'nullable|integer|min:1'
        ];
    }

    public function updated($name, $value)
    {
        if($name = 'user.full_name') $this->validateOnly('user.full_name');
        if($name = 'user.email_address') $this->validateOnly('user.email_address');
        if($name = 'user.address_line_1') $this->validateOnly('user.address_line_1');
        if($name = 'user.address_line_2') $this->validateOnly('user.address_line_2');
        if($name = 'user.contact_number') $this->validateOnly('user.contact_number');
        if($name = 'user.postal_code') $this->validateOnly('user.postal_code');
        if($name = 'user.role_id') $this->validateOnly('user.role_id');
    }

    public function create()
    {
        $this->user = new User();
        $this->modal_title = "Create User";
        $this->modal_button_text = "Add User";
        $this->showModal = true;
    }

    public function edit($userId)
    {
        $this->modal_title = "Edit User";
        $this->modal_button_text = "Update User";
        $this->showModal = true;
        $this->user = User::with('role')->find($userId);
    }

    public function save($newUser)
    {
        $this->flash_message = "Existing User <strong>" . $this->user->full_name . "</strong> has been updated successfully";
        $this->alert_type = 'success';

        if ($newUser == true) {
            $this->user->password = Hash::make(Str::random(20));
            $this->flash_message = "New User <strong>" . $this->user->full_name . "</strong> saved successfully";
        }
        
        $this->user->save();
        $this->showModal = false;
    }

    public function close()
    {
        $this->showModal = false;
    }   
}
