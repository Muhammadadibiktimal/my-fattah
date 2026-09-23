<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Profil</h2>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Foto Profil -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Foto Profil</label>
            <div class="flex items-center space-x-5">
                <div class="relative group">
                    <img id="preview-image"
                        src="{{ Auth::user()->profile ? asset('storage/' . Auth::user()->profile) : asset('images/logo/logo.png') }}"
                        alt="Foto Profil"
                        class="h-20 w-20 rounded-full border-4 border-green-100 object-cover shadow-md transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-sm">
                        Ganti
                    </div>
                </div>
                <input type="file" name="profile" accept="image/*" id="image-input"
                    class="block w-full text-sm text-gray-600 cursor-pointer file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0 file:text-sm file:font-semibold
                    file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition duration-200"/>
            </div>
            @error('profile')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div class="input flex flex-col w-full static">
            <label for="name"
                class="text-green-600 text-xs font-semibold relative top-2 ml-[7px] px-[3px] bg-white w-fit">
                Nama Pengguna:
            </label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                placeholder="Tulis nama di sini..."
                class="border-green-500 px-[10px] py-[11px] text-sm bg-white border-2 rounded-[5px] w-full focus:outline-none placeholder:text-black/25 focus:ring-2 focus:ring-green-200 transition"/>
        </div>

        <!-- Email -->
        <div class="input flex flex-col w-full static">
            <label for="email"
                class="text-green-600 text-xs font-semibold relative top-2 ml-[7px] px-[3px] bg-white w-fit">
                Email:
            </label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                placeholder="contoh@email.com"
                class="border-green-500 px-[10px] py-[11px] text-sm bg-white border-2 rounded-[5px] w-full focus:outline-none placeholder:text-black/25 focus:ring-2 focus:ring-green-200 transition"/>
        </div>
        <!-- Tombol Simpan -->
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-500 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-600 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-700 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                <i data-lucide="save" class="w-5 h-5 mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Preview Gambar -->
<script>
    const imageInput = document.getElementById('image-input');
    const previewImage = document.getElementById('preview-image');

    imageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                previewImage.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Inisialisasi icon lucide
    lucide.createIcons();
</script>

<!-- Tambahkan script lucide -->
<script src="https://unpkg.com/lucide@latest"></script>
