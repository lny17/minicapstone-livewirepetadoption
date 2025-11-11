<div class="p-6 bg-gray-100 min-h-screen rounded-lg">

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-semibold">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold dark:text-zinc-900">🐶 Pets</h2>
        <button wire:click="openModal"
            class="dark:bg-zinc-900 hover:bg-zinc-800 text-white font-semibold py-2 px-4 rounded-md cursor-pointer transition text-sm">
            + Add Pet
        </button>
    </div>

    <div class="overflow-hidden shadow-lg rounded-lg">
        <table class="min-w-full border-collapse dark:bg-zinc-900 text-white rounded-lg overflow-hidden">
            <thead class="dark:bg-zinc-700 uppercase text-sm text-gray-300">
                <tr>
                    <th class="py-3 px-4 text-left">Image</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Species</th>
                    <th class="py-3 px-4 text-left">Sex</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Arrival Date</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse ($pets as $pet)
                    <tr class="hover:bg-zinc-800 transition">
                        <td class="py-3 px-4">
                            @if ($pet->image)
                                <img src="{{ asset('storage/pets/' . $pet->image) }}" alt="{{ $pet->name }}"
                                    class="w-12 h-12 object-cover rounded-full">
                            @else
                                <span class="text-gray-400 text-sm italic">No Image</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-semibold">{{ $pet->name }}</td>
                        <td class="py-3 px-4">{{ $pet->species }}</td>
                        <td class="py-3 px-4 capitalize">{{ $pet->sex }}</td>
                        <td class="py-3 px-4">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-sm
                                    @if ($pet->status == 'available') bg-green-600
                                    @elseif ($pet->status == 'adopted') bg-gray-500
                                    @else bg-yellow-500 @endif">
                                {{ ucfirst($pet->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $pet->arrival_date }}</td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <button wire:click="edit({{ $pet->id }})"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold text-sm py-2 px-4 rounded transition cursor-pointer">Edit</button>
                            <button wire:click="delete({{ $pet->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded transition cursor-pointer"
                                onclick="return confirm('Are you sure you want to delete this pet?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-400">No pets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pets->links() }}
    </div>


    {{-- Modal --}}
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-zinc-200 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md text-black p-6">
                <h2 class="text-lg font-semibold mb-4">
                    {{ $pet_id ? 'Edit Pet' : 'Add Pet' }}
                </h2>

                <form wire:submit.prevent="save" class="space-y-4">

                    {{-- Image --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pet Image</label>
                        <input type="file" wire:model="newImage"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                        @if ($newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" class="mt-2 w-20 h-20 object-cover rounded-full border">
                        @elseif ($image)
                            <img src="{{ asset('storage/pets/' . $image) }}" class="mt-2 w-20 h-20 object-cover rounded-full border">
                        @endif
                        @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" wire:model="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Species --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                        <input type="text" wire:model="species"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('species') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Sex --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sex</label>
                        <select wire:model="sex"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">-- Select --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select wire:model="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="available">Available</option>
                            <option value="adopted">Adopted</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    {{-- Arrival Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Arrival Date</label>
                        <input type="date" wire:model="arrival_date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('arrival_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
