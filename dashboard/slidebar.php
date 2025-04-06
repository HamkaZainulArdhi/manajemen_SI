<?php
// Ensure proper character encoding
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Hamburger Button for Mobile -->
    <button id="hamburger" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed md:sticky md:top-0 md:h-screen  md:static top-0 left-0 h-screen bg-white w-64 shadow-lg z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex items-center mb-6 p-4">
            <img src="../images/SI.png" alt="Logo" class="w-16 h-16 mr-4">
            <h1 class="text-1xl text-blue-500 font-bold">Sistem Informasi Angkatan 2023</h1>
        </div>
        <ul class="space-y-4 [&>li>a]:transition-colors [&>li>a]:duration-300 [&>li>a]:ease-in-out [&>li>a:hover]:bg-blue-700 [&>li>a:hover]:text-white">
            <!-- Dashboard -->
            <li>
                <h1 class="text-sm text-gray-500 font-semibold mb-2 px-4">Utama</h1>
                <a href="index.php" class="block py-2 px-4 rounded hover:bg-blue-700">
                    <i class="fa fa-house mr-2"></i>Dashboards
                </a>
            </li>

             <li class="relative group">
                <h1 class="text-sm text-gray-500 font-semibold mb-2 px-4">Manajemen</h1>
                <a href="#" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-users mr-2"></i>Mahasiswa
                    <span class="ml-auto transform group-hover:rotate-90 transition-transform">▼</span>
                </a>
                <div class="hidden group-hover:block absolute left-full top-0 ml-2 bg-white rounded shadow-lg w-56">
                    <a href="mahasiswa.php" class="block py-2 px-4 hover:bg-blue-50">
                        <i class="fa-solid fa-list mr-2"></i>Daftar Mahasiswa
                    </a>
                    <a href="tambah-mahasiswa.php" class="block py-2 px-4 hover:bg-blue-50">
                        <i class="fa-solid fa-user-plus mr-2"></i>Tambah Mahasiswa
                    </a>
                </div>
            </li>

            <!-- Dropdown Dosen -->
            <li class="relative group">
                <a href="#" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-chalkboard-user mr-2"></i>Dosen
                    <span class="ml-auto transform group-hover:rotate-90 transition-transform">▼</span>
                </a>
                <div class="hidden group-hover:block absolute left-full top-0 ml-2 bg-white rounded shadow-lg w-52">
                    <a href="dosen.php" class="block py-2 px-4 hover:bg-blue-50">
                        <i class="fa-solid fa-list mr-2"></i>Daftar Dosen
                    </a>
                    <a href="tambah-dosen.php" class="block py-2 px-4 hover:bg-blue-50">
                        <i class="fa-solid fa-user-plus mr-2"></i>Tambahkan Dosen
                    </a>
                </div>
            </li>

            <li>
                <a href="mata-pelajaran.php" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-book mr-2"></i>Mata Pelajaran
                </a>
            </li>

            <li>
                <h1 class="text-sm text-gray-500 font-semibold mb-2 px-4">Absensi</h1>
                <a href="absensi.php" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-calendar-days mr-2"></i>Absensi
                </a>
            </li>

            <li>
                <a href="absensi-guru.php" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-list mr-2"></i>Daftar Absensi
                </a>
            </li>

            <li>
                <h1 class="text-sm text-gray-500 font-semibold mb-2 px-4">Lainnya</h1>
                <a href="About.php" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-users-between-lines mr-2"></i>Tentang Kami
                </a>
            </li>

            <li>
                <a href="kelas.php" class="flex items-center py-2 px-4 rounded">
                    <i class="fa-solid fa-graduation-cap mr-2"></i>Daftar Kelas
                </a>
            </li>
        </ul>
    </div>

    <!-- Overlay for Mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden md:hidden z-30"></div>

    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        hamburger.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>