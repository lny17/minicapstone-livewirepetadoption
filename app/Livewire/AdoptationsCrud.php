<?php

namespace App\Livewire;

use App\Models\AdoptationRequest;
use App\Models\Adoptations;
use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;

class AdoptationsCrud extends Component
{
    use WithPagination;

    public $adoptationRequests;
    public $staffs;

    public $isShowModal = false;
    public $adoptation_id, $adoptationRequest_id, $adoptation_date, $staff_id;

    public function render()
    {
        $adoptations = Adoptations::with(['adoptationRequest', 'staff'])->latest()->paginate(5);
        $this->adoptationRequests = AdoptationRequest::all();
        $this->staffs = Staff::all();
        return view('livewire.adoptations-crud', ['adoptations' => $adoptations]);
    }

    protected $rules = [
        'adoptationRequest_id' => 'required',
        'adoptation_date' => 'required',
        'staff_id' => 'required',
    ];

    public function openModal(){
        $this->resetFields();
        $this->isShowModal = true;
    }

    public function closeModal(){
        $this->isShowModal = false;
    }

    public function resetFields(){
        $this->reset('adoptation_id', 'adoptationRequest_id', 'adoptation_date', 'staff_id');
    }

    public function save(){
        $this->validate();

        Adoptations::updateOrCreate(
            ['id' => $this->adoptation_id],
            [
                'adoptationRequest_id' => $this->adoptationRequest_id,
                'adoptation_date' => $this->adoptation_date,
                'staff_id' => $this->staff_id,
            ]
        );

        session()->flash('message', $this->adoptation_id ? 'Adoptation updated successfully!' : 'Adoptation added successfully!');

        $this->isShowModal = false;
        $this->resetFields();
    }

    public function edit($id){
        $adopt = Adoptations::findOrFail($id);
        $this->adoptation_id = $adopt->id;
        $this->adoptationRequest_id = $adopt->adoptationRequest_id;
        $this->adoptation_date = $adopt->adoptation_date;
        $this->staff_id = $adopt->staff_id;

        $this->isShowModal = true;
    }

    public function delete($id){
        $adopt = Adoptations::findOrFail($id);
        $adopt->delete();
        session()->flash('message', 'Adoptation delete successfully');
    }

}
