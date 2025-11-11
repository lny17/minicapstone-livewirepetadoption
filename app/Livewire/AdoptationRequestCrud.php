<?php

namespace App\Livewire;

use App\Models\AdoptationRequest;
use App\Models\Adopter;
use App\Models\Pet;
use Livewire\Component;
use Livewire\WithPagination;

class AdoptationRequestCrud extends Component
{
    use WithPagination;

    public $pets;
    public $adopters;

    public $isShowModal = false;
    public $adoptationRequest_id, $pet_id, $adopter_id, $request_date, $status = 'pending';

    public function render()
    {
        $adoptationRequests = AdoptationRequest::with(['pet', 'adopter'])->latest()->paginate(5);
        $this->pets = Pet::all();
        // dd($this->pets);
        $this->adopters = Adopter::all();

        // dd($this->adopters);
        return view('livewire.adoptation-request-crud', ['adoptationRequests' => $adoptationRequests]);
    }

    protected $rules = [
        'pet_id' => 'required',
        'adopter_id' => 'required',
        'request_date' => 'required',
        'status' => 'required|in:pending,in_progress,completed',
    ];

    public function openModal(){
        $this->resetFields();
        $this->isShowModal = true;
    }

    public function closeModal(){
        $this->isShowModal = false;
    }

    public function resetFields(){
        $this->reset('pet_id', 'adopter_id', 'request_date', 'status');
    }

    public function save(){
        // dd($this->pets);
        $this->validate();
        AdoptationRequest::updateOrCreate(
            ['id' => $this->adoptationRequest_id],
            [
                'pet_id' => $this->pet_id,
                'adopter_id' => $this->adopter_id,
                'request_date' => $this->request_date,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->adoptationRequest_id ? 'Request updated successfully!' : 'Request added successfully!');

        $this->isShowModal = false;
        $this->resetFields();
    }

    public function edit($id){
        $req = AdoptationRequest::findOrFail($id);
        $this->adoptationRequest_id = $req->id;
        $this->pet_id = $req->pet_id;
        $this->adopter_id = $req->adopter_id;
        $this->request_date = $req->request_date;
        $this->status = $req->status;

        $this->isShowModal = true;
    }

    public function delete($id){
        $req = AdoptationRequest::findOrFail($id);
        $req->delete();
        session()->flash('message', 'Request deleted successfully!');
    }
}
