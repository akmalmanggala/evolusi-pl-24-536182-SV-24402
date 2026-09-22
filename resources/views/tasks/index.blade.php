<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas - KEPL Pertemuan 3</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen p-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-      
700">
            <div>
                <h1 class="text-2xl font-bold text-sky-400">Manajemen Tugas (CRUD Task)</h1>
                <p class="text-sm text-slate-400">Praktikum KEPL Pertemuan 3 - Continuous   
Deployment</p>
            </div>
            <a href="/" class="text-sm bg-slate-800 hover:bg-slate-700 px-3 py-2 rounded-   
lg border border-slate-700 transition">Kembali ke Beranda</a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-900/50 border border-emerald-500 text-emerald-200 px-4   
py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah Cepat -->
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 mb-8">
            <h2 class="text-lg font-semibold mb-4 text-slate-200">Tambah Tugas Baru</h2>    
            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">      
                @csrf
                <div>
                    <input type="text" name="title" placeholder="Judul tugas..." required   
                            class="w-full bg-slate-900 border border-slate-700 rounded-lg    
px-4 py-2 text-slate-200 focus:outline-none focus:border-sky-500">
                </div>
                <div>
                    <textarea name="description" placeholder="Deskripsi tugas (opsional).   
.." rows="2"
                                class="w-full bg-slate-900 border border-slate-700 rounded-   
lg px-4 py-2 text-slate-200 focus:outline-none focus:border-sky-500"></textarea>
                </div>
                <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white font-   
medium px-5 py-2 rounded-lg transition">Simpan Tugas</button>
            </form>
        </div>

        <!-- List Tugas -->
        <div class="space-y-3">
            <h2 class="text-lg font-semibold mb-4 text-slate-200">Daftar Tugas Aktif</h2>   
            @forelse($tasks as $task)
                <div class="bg-slate-800 p-4 rounded-xl border border-slate-700 flex        
justify-between items-center">
                    <div>
                        <h3 class="font-medium text-slate-100 {{ $task->is_completed ?      
'line-through text-slate-500' : '' }}">{{ $task->title }}</h3>
                        @if($task->description)
                            <p class="text-sm text-slate-400 mt-1">{{ $task->description    
}}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"    
onsubmit="return confirm('Hapus tugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-400 hover:text-rose-     
300 text-sm font-medium px-3 py-1 bg-rose-950/40 border border-rose-800/60 rounded-
lg">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-slate-800/50 rounded-xl border border-     
slate-800 text-slate-500">
                    Belum ada tugas. Silakan tambahkan tugas di atas.
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>