<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;

class CreateAdmin extends Component
{
    public $admin;
    public $adminId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateAdmin") ? [
            'admin.email' => 'required|email|unique:admins,email,' . $this->adminId
        ] : [
            'admin.password' => 'required|min:8|confirmed',
            'admin.password_confirmation' => 'required' // livewire need this
        ];

        return array_merge([
            'admin.name' => 'required|min:3',
            'admin.email' => 'required|email|unique:admins,email'
        ], $rules);
    }

    public function createAdmin ()
    {
        $this->resetErrorBag();
        $this->validate();

        Admin::create($this->admin);

        $this->emit('saved');
        $this->reset('admin');
    }

    public function updateAdmin ()
    {
        $this->resetErrorBag();
        $this->validate();

        Admin::query()
            ->where('id', $this->adminId)
            ->update($this->admin);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!!$this->adminId) {
            $admin = Admin::find($this->adminId);

            $this->admin = [
                "name" => $admin->name,
                "email" => $admin->email,
            ];
        }

        $this->button = create_button($this->action, "Admin");
    }

    public function render()
    {
        return view('livewire.create-admin');
    }
}
