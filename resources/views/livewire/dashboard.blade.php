<div class="p-6 bg-gradient-to-br from-gray-50 to-gray-100 h-screen rounded-lg">
    <div class="w-full flex">
        <h2 class="text-2xl font-bold mb-8 text-center dark:text-zinc-900">
            📊 Dashboard
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Pets Card -->
        <div class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-xl group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg cursor-pointer">
            <div class="relative w-full px-5 py-6 transition-all ease-in duration-75 bg-white dark:bg-zinc-900 rounded-lg group-hover:bg-opacity-0 group-hover:dark:bg-opacity-0 text-center hover:bg-zinc-800">
                <h3 class="text-xl font-semibold text-gray-400 group-hover:text-white transition-colors">Pets</h3>
                <p class="text-4xl font-bold text-purple-500 group-hover:text-white mt-2 transition-colors">{{ $petsCount }}</p>
            </div>
        </div>

        <!-- Adopters Card -->
        <div class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-xl group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800 shadow-lg cursor-pointer">
            <div class="relative w-full px-5 py-6 transition-all ease-in duration-75 bg-white dark:bg-zinc-900 rounded-lg group-hover:bg-opacity-0 group-hover:dark:bg-opacity-0 text-center hover:bg-zinc-800">
                <h3 class="text-xl font-semibold text-gray-400 group-hover:text-white transition-colors">Adopters</h3>
                <p class="text-4xl font-bold text-blue-500 group-hover:text-white mt-2 transition-colors">{{ $adoptersCount }}</p>
            </div>
        </div>

        <!-- Staff Card -->
        <div class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-xl group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 shadow-lg cursor-pointer">
            <div class="relative w-full px-5 py-6 transition-all ease-in duration-75 bg-white dark:bg-zinc-900 rounded-lg group-hover:bg-opacity-0 group-hover:dark:bg-opacity-0 text-center hover:bg-zinc-800">
                <h3 class="text-xl font-semibold text-gray-400 group-hover:text-white transition-colors">Staff</h3>
                <p class="text-4xl font-bold text-green-500 group-hover:text-white mt-2 transition-colors">{{ $staffsCount }}</p>
            </div>
        </div>

        <!-- Adoptations Card -->
        <div class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-xl group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 shadow-lg cursor-pointer">
            <div class="relative w-full px-5 py-6 transition-all ease-in duration-75 bg-white dark:bg-zinc-900 rounded-lg group-hover:bg-opacity-0 group-hover:dark:bg-opacity-0 text-center hover:bg-zinc-800">
                <h3 class="text-xl font-semibold text-gray-400 group-hover:text-white transition-colors">Adoptions</h3>
                <p class="text-4xl font-bold text-pink-600 group-hover:text-white mt-2 transition-colors">{{ $adoptationsCount }}</p>
            </div>
        </div>

        <!-- Adoptation Request Card -->
        <div class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-xl group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 shadow-lg cursor-pointer">
            <div class="relative w-full px-5 py-6 transition-all ease-in duration-75 bg-white dark:bg-zinc-900 rounded-lg group-hover:bg-opacity-0 group-hover:dark:bg-opacity-0 text-center hover:bg-zinc-800">
                <h3 class="text-xl font-semibold text-gray-400 group-hover:text-white transition-colors">Adoption Requests</h3>
                <p class="text-4xl font-bold text-orange-600 group-hover:text-white mt-2 transition-colors">{{ $adoptationRequestCount }}</p>
            </div>
        </div>

    </div>
</div>
