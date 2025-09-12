<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Selamat Datang, {{ Auth::user()->name }}</h1>
                    <h3 class="text-lg font-semibold mb-4">Statistik Artikel Anda</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                            <p class="text-sm text-gray-600">Total Artikel</p>
                            <p class="text-2xl font-bold">{{ $totalArticles }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow-md">
                            <p class="text-sm text-gray-600">Disetujui</p>
                            <p class="text-2xl font-bold">{{ $approvedArticles }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                            <p class="text-sm text-gray-600">Diproses</p>
                            <p class="text-2xl font-bold">{{ $pendingArticles }}</p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg shadow-md">
                            <p class="text-sm text-gray-600">Ditolak</p>
                            <p class="text-2xl font-bold">{{ $rejectedArticles }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>