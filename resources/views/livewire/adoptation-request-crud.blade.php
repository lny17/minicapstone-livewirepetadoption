<div class="p-6 bg-gray-100 min-h-screen rounded-lg">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-semibold">
            {{ session('message') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold dark:text-zinc-900">📝 Adoption Requests</h2>
        <button wire:click="openModal"
            class="dark:bg-zinc-900 hover:bg-zinc-800 text-white font-semibold py-2 px-4 rounded-md cursor-pointer transition text-sm">
            + Add Request
        </button>
    </div>

    {{-- Adoptation Requests Table --}}
    <div class="overflow-hidden shadow-lg rounded-lg">
        <table class="min-w-full border-collapse dark:bg-zinc-900 text-white rounded-lg overflow-hidden">
            <thead class="dark:bg-zinc-700 uppercase text-sm text-gray-300">
                <tr>
                    <th class="py-3 px-4 text-left">Pet</th>
                    <th class="py-3 px-4 text-left">Adopter</th>
                    <th class="py-3 px-4 text-left">Request Date</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse ($adoptationRequests as $req)
                    <tr class="hover:bg-zinc-800 transition">
                        <td class="py-3 px-4 font-semibold">{{ $req->pet->name }}</td>
                        <td class="py-3 px-4">{{ $req->adopter->fullname }}</td>
                        <td class="py-3 px-4">{{ $req->request_date }}</td>
                        <td class="py-3 px-4">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-sm
                                    @if ($req->status == 'pending') bg-yellow-500
                                    @elseif ($req->status == 'in_progress') bg-blue-600
                                    @elseif ($req->status == 'completed') bg-green-600
                                    @else bg-gray-500 @endif">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <button wire:click="edit({{ $req->id }})"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold text-sm py-2 px-4 rounded transition cursor-pointer">
                                Edit
                            </button>
                            <button wire:click="delete({{ $req->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded transition cursor-pointer"
                                onclick="return confirm('Are you sure you want to delete this request?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400">No requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $adoptationRequests->links() }}
    </div>


    {{-- Modal --}}
    @if ($isShowModal)
        <div class="fixed inset-0 bg-zinc-200 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md text-black p-6">
                <h2 class="text-lg font-semibold mb-4">
                    {{ $adoptationRequest_id ? 'Edit Request' : 'Add Request' }}
                </h2>

                <form wire:submit.prevent="save" class="space-y-4">

                    {{-- Pet --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pet</label>
                        <select wire:model="pet_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">-- Select Pet --</option>
                            @foreach ($pets as $pet)
                                <option value="{{ $pet->id }}" name="pet_id">{{ $pet->name }}</option>
                            @endforeach
                        </select>
                        @error('pet_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Adopter --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adopter</label>
                        <select wire:model="adopter_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">-- Select Adopter --</option>
                            @foreach ($adopters as $adopter)
                                <option value="{{ $adopter->id }}" name="adopter_id">{{ $adopter->fullname }}</option>
                            @endforeach
                        </select>
                        @error('adopter_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Request Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Request Date</label>
                        <input type="date" wire:model="request_date" name="request_date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('request_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select wire:model="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end space-x-2 mt-5">
                        <button type="button" wire:click="closeModal"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-[#1e2a38] hover:bg-[#243447] text-white px-4 py-2 rounded-lg font-semibold transition cursor-pointer">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

</div>
