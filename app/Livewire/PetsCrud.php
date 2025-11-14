<?php

namespace App\Livewire;

use App\Models\Pet;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PetsCrud extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'tailwind';

    public $pet_id, $image, $newImage, $name, $species, $sex, $status = "available", $arrival_date;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string',
        'species' => 'required|string',
        'sex' => 'required|string',
        'status' => 'required|in:available,adopted,pending',
        'arrival_date' => 'required|date',
        'newImage' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $pets = Pet::latest()->paginate(5);
        return view('livewire.pets-crud', ['pets' => $pets]);
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetFields()
    {
        $this->reset(['pet_id', 'name', 'species', 'sex', 'status', 'arrival_date', 'image', 'newImage']);
    }

    public function save()
{
    $this->validate();

    if ($this->newImage) {
        $imageName = time() . '.' . $this->newImage->extension();
        $this->newImage->storeAs('pets', $imageName, 'public');
    }

    $finalImage = $this->newImage ? $imageName : ($this->pet_id ? Pet::find($this->pet_id)->image : null);

    $pet = Pet::updateOrCreate(
        ['id' => $this->pet_id],
        [
            'image' => $finalImage,
            'name' => $this->name,
            'species' => $this->species,
            'sex' => $this->sex,
            'status' => $this->status,
            'arrival_date' => $this->arrival_date,
        ]
    );

    // Update $image so it displays immediately after save
    $this->image = $pet->image;
    $this->newImage = null;

    $this->resetPage();
    session()->flash('message', $this->pet_id ? 'Pet updated successfully!' : 'Pet added successfully!');
    $this->closeModal();
}

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $this->pet_id = $pet->id;
        $this->name = $pet->name;
        $this->species = $pet->species;
        $this->sex = $pet->sex;
        $this->status = $pet->status;
        $this->arrival_date = $pet->arrival_date;
        $this->image = $pet->image;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $pet = Pet::findOrFail($id);
        if ($pet->image && file_exists(storage_path('app/public/pets/' . $pet->image))) {
            unlink(storage_path('app/public/pets/' . $pet->image));
        }
        $pet->delete();

        session()->flash('message', 'Pet deleted successfully!');
    }
}
