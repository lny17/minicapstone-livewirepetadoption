<?php

namespace App\Livewire;

use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;

class StaffsCrud extends Component
{

    use WithPagination;

    public $staff_id, $fullname, $email, $password, $role;
    public $isModalOpen = false;

    protected $rules = [
        'fullname' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string',
        'role' => 'required|in:admin,veterinarian,receptionist,assistant',
    ];

    public function render()
    {
        $staffs = Staff::latest()->paginate(5);
        return view('livewire.staffs-crud', ['staffs' => $staffs]);
    }

    public function openModal(){
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function closeModal(){
        $this->isModalOpen = false;
    }

    public function resetFields(){
        $this->reset(['staff_id', 'fullname', 'email', 'password', 'role']);
    }

    public function save(){
        $this->validate();

            Staff::updateOrCreate(
            ['id' => $this->staff_id],
            [
                'fullname' => $this->fullname,
                'email' => $this->email,
                'password' => $this->password,
                'role' => $this->role,
            ]
        );

        session()->flash('message', $this->staff_id ? 'Staff updated successfully!' : 'Staff added successfully!');

        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id){
        $staff = Staff::findOrFail($id);
        $this->staff_id = $staff->id;
        $this->fullname = $staff->fullname;
        $this->email = $staff->email;
        $this->password = $staff->password;
        $this->role = $staff->role;

        $this->isModalOpen = true;
    }

    public function delete($id){
        $staff = Staff::findOrFail($id);
        session()->flash('message', 'Staff deleted successfully!');
        $staff->delete();
    }


}
