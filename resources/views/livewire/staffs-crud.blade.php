<div class="p-6 bg-gray-100 min-h-screen rounded-lg">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-semibold">
            {{ session('message') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold dark:text-zinc-900">👨‍💼 Staff</h2>
        <button wire:click="openModal"
            class="dark:bg-zinc-900 hover:bg-zinc-800 text-white font-semibold py-2 px-4 rounded-md cursor-pointer transition text-sm">
            + Add Staff
        </button>
    </div>

    {{-- Staff Table --}}
    <div class="overflow-hidden shadow-lg rounded-lg">
        <table class="min-w-full border-collapse dark:bg-zinc-900 text-white rounded-lg overflow-hidden">
            <thead class="dark:bg-zinc-700 uppercase text-sm text-gray-300">
                <tr>
                    <th class="py-3 px-4 text-left">Full Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Role</th>
                    <th class="py-3 px-4 text-left">Password</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse ($staffs as $staff)
                    <tr class="hover:bg-zinc-800 transition">
                        <td class="py-3 px-4 font-semibold">{{ $staff->fullname }}</td>
                        <td class="py-3 px-4">{{ $staff->email }}</td>
                        <td class="py-3 px-4">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-sm
                                    @if ($staff->role === 'admin') bg-red-600
                                    @elseif ($staff->role === 'veterinarian') bg-green-600
                                    @elseif ($staff->role === 'receptionist') bg-yellow-500
                                    @else bg-blue-500 @endif">
                                {{ ucfirst($staff->role) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-300">••••••••</td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <button wire:click="edit({{ $staff->id }})"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold text-sm py-2 px-4 rounded transition cursor-pointer">Edit</button>
                            <button wire:click="delete({{ $staff->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded transition cursor-pointer"
                                onclick="return confirm('Are you sure you want to delete this staff?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400">No staff members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $staffs->links() }}
    </div>


    {{-- Modal --}}
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-zinc-200 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md text-black p-6">
                <h2 class="text-lg font-semibold mb-4">
                    {{ $staff_id ? 'Edit Staff' : 'Add Staff' }}
                </h2>

                <form wire:submit.prevent="save" class="space-y-4">

                    {{-- Full Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" wire:model="fullname"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('fullname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" wire:model="email"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" wire:model="password"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select wire:model="role"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="veterinarian">Veterinarian</option>
                            <option value="receptionist">Receptionist</option>
                            <option value="assistant">Assistant</option>
                        </select>
                        @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
