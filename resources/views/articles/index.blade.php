<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikel Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Daftar Artikel Anda</h3>
                        <a href="{{ route('articles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Artikel Baru
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Judul</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                    <th class="py-2 px-4 border-b">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $article->title }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($article->status == 'diterima') bg-green-200 text-green-800
                                            @elseif($article->status == 'ditolak') bg-red-200 text-red-800
                                            @else bg-yellow-200 text-yellow-800
                                            @endif">
                                            {{ ucfirst($article->status) }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>