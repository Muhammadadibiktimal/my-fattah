<section class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 mt-10 transition-all duration-300">
  <header class="mb-6 text-center">
    <h2 class="text-2xl font-extrabold text-green-700 dark:text-green-400">
      Ganti Password
    </h2>
    <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
      Pastikan password barumu kuat dan aman.
    </p>
  </header>

  <form method="POST" action="{{ route('password.update') }}" class="space-y-8">
    @csrf
    @method('put')

    <!-- Password Baru -->
    <div class="input flex flex-col w-full relative">
      <label
        for="password"
        class="text-green-600 text-sm font-semibold relative top-2 left-3 px-[5px] bg-white dark:bg-gray-800 w-fit"
      >
        Password Baru:
      </label>
      <input
        id="password"
        type="password"
        name="password"
        placeholder="Masukkan password baru..."
        autocomplete="new-password"
        required
        class="border-green-500 px-[12px] py-[12px] text-sm bg-[#f5f5f5] dark:bg-gray-900 border-2 rounded-[8px] w-full focus:outline-none focus:ring-2 focus:ring-green-400 placeholder:text-black/30 dark:placeholder:text-gray-400 transition-all duration-300"
      />
      <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500 text-sm" />
    </div>

    <!-- Konfirmasi Password -->
    <div class="input flex flex-col w-full relative">
      <label
        for="password_confirmation"
        class="text-green-600 text-sm font-semibold relative top-2 left-3 px-[5px] bg-white dark:bg-gray-800 w-fit"
      >
        Konfirmasi Password:
      </label>
      <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="Ulangi password baru..."
        autocomplete="new-password"
        required
        class="border-green-500 px-[12px] py-[12px] text-sm bg-[#f5f5f5] dark:bg-gray-900 border-2 rounded-[8px] w-full focus:outline-none focus:ring-2 focus:ring-green-400 placeholder:text-black/30 dark:placeholder:text-gray-400 transition-all duration-300"
      />
      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
    </div>

    <!-- Tombol Simpan -->
    <div class="flex items-center justify-between mt-8">
      <button
        type="submit"
        class="relative inline-flex items-center justify-center px-7 py-3 font-semibold text-white rounded-xl overflow-hidden transition-all duration-500 bg-gradient-to-r from-green-600 via-emerald-500 to-green-600 hover:from-green-700 hover:via-emerald-600 hover:to-green-700 shadow-lg hover:shadow-green-400/30 transform hover:-translate-y-0.5"
      >
        <span class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-400 opacity-0 hover:opacity-20 blur-lg transition-opacity duration-500"></span>
        <i data-lucide="shield-check" class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-12"></i>
        Simpan Password
      </button>

      @if (session('status') === 'password-updated')
      <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2500)"
        class="text-sm text-green-600 dark:text-green-400 font-semibold"
      >
        Password berhasil diperbarui!
      </p>
      @endif
    </div>
  </form>
</section>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
  });
</script>
