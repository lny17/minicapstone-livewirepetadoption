<?php

namespace App\Livewire;

use App\Models\Adopter;
use Livewire\Component;
use Livewire\WithPagination;

class AdoptersCrud extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $adopterId, $fullname, $email, $phone, $address;
    public $isOpen = false;

    protected $rules = [
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:adopters,email',
        'phone' => 'nullable|string|max:50',
        'address' => 'nullable|string|max:255',
    ];

    public function render()
    {
        $adopters = Adopter::latest()->paginate(5);
        return view('livewire.adopters-crud', ['adopters' => $adopters]);
    }

        public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $adopter = Adopter::findOrFail($id);
        $this->adopterId = $adopter->id;
        $this->fullname = $adopter->fullname;
        $this->email = $adopter->email;
        $this->phone = $adopter->phone;
        $this->address = $adopter->address;
        $this->isOpen = true;
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->adopterId) {
            $rules['email'] = 'required|email|max:255|unique:adopters,email,' . $this->adopterId;
        }

        $validated = $this->validate($rules);

        Adopter::updateOrCreate(['id' => $this->adopterId], $validated);

        session()->flash('message', $this->adopterId ? 'Adopter updated successfully!' : 'Adopter added successfully!');
        $this->closeModal();
        $this->resetFields();
    }

    public function delete($id)
    {
        Adopter::findOrFail($id)->delete();
        session()->flash('message', 'Adopter deleted successfully!');
    }

    public function resetFields()
    {
        $this->adopterId = null;
        $this->fullname = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
