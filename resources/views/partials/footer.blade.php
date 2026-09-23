    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 mt-12 border-t border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo & Deskripsi -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Al-Fattah" class="h-16 w-16 object-contain">
                    <span class="text-xl font-extrabold text-yellow-600 dark:text-yellow-400">
                        PONDOK PESANTREN <br>Al-Fattah
                    </span>
                </div>
                <p class="text-sm leading-relaxed">
                    Menjadi lembaga pendidikan Islam yang unggul, mencetak generasi Qur’ani, berilmu, dan berakhlak mulia.
                </p>
            </div>

            <!-- Link Navigasi -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-yellow-600 dark:text-yellow-400">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-600 dark:hover:text-yellow-400 transition">Beranda</a></li>
                    <li><a href="{{ route('visi-misi') }}" class="hover:text-yellow-600 dark:hover:text-yellow-400 transition">Visi & Misi</a></li>
                    <li><a href="{{ route('sejarah') }}" class="hover:text-yellow-600 dark:hover:text-yellow-400 transition">Sejarah</a></li>
                    <li><a href="{{ route('posts.index') }}" class="hover:text-yellow-600 dark:hover:text-yellow-400 transition">Berita</a></li>
                    <li><a href="{{ route('pendaftaran.form') }}" class="hover:text-yellow-600 dark:hover:text-yellow-400 transition">Pendaftaran</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-yellow-600 dark:text-yellow-400">Kontak</h3>
                <ul class="space-y-2 text-sm">
                    <li><span class="iconify inline-block mr-2 text-yellow-600 dark:text-yellow-400" data-icon="mdi:map-marker"></span>Jl. Raya Ponpes Al-Fattah No.123</li>
                    <li><span class="iconify inline-block mr-2 text-yellow-600 dark:text-yellow-400" data-icon="mdi:phone"></span>+62 812-3456-7890</li>
                    <li><span class="iconify inline-block mr-2 text-yellow-600 dark:text-yellow-400" data-icon="mdi:email"></span>info@alfattah.sch.id</li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="bg-gray-200 dark:bg-gray-900 py-4 text-center text-sm text-gray-600 dark:text-gray-400 border-t border-gray-300 dark:border-gray-700">
            © {{ date('Y') }} Pondok Pesantren Al-Fattah. All rights reserved.
        </div>
    </footer>
