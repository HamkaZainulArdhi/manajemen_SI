<?php
session_start();
include '../fuction.php';

// Fetch distinct classes for filter buttons
$class_query = "SELECT DISTINCT class FROM students ORDER BY class";
$class_result = mysqli_query($conn, $class_query);
$classes = [];
while ($class_row = mysqli_fetch_assoc($class_result)) {
    $classes[] = $class_row['class'];
}

// Fetch all students
$query = "SELECT * FROM students ORDER BY class, name";
$result = mysqli_query($conn, $query);
$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <?php include 'slidebar.php'; ?>

        <!-- Konten utama -->
        <div class="flex-1 md:w-3/4 p-6">
            <!-- Hero Section -->
            <section class="relative bg-cover bg-center h-96 rounded-lg overflow-hidden shadow-md"
                style="background-image: url('../images/herosecc.png');">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white">
                    <h1 class="text-4xl md:text-5xl font-bold">Program Studi Sistem Informasi</h1>
                    <h3 class="text-lg md:text-xl">Telkom University Purwokerto</h3>
                    <h3 class="text-md bg-red-700 p-1 rounded-md md:text-md">Angkatan 2023</h3>
                </div>
            </section>

            <!-- Tentang Kami Section -->
            <section class="mt-12 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-blue-500 mb-4">Tentang Kami</h2>
                <p class="text-gray-700">Kami adalah mahasiswa Program Studi Sistem Informasi di Telkom University Purwokerto. Kami memiliki visi untuk menjadi profesional yang kompeten dalam bidang teknologi informasi dan komunikasi.</p>
                <p class="text-gray-700 mt-4">Kami berkomitmen untuk memberikan kontribusi positif kepada masyarakat melalui inovasi dan teknologi.</p>
            </section>

            <!-- Filter Buttons -->
            <div class="flex flex-col gap-2 mt-8 mb-4 items-start">
                <h1 class="block text-gray-700 font-bold">Kelas</h1>
                <div class="flex gap-2">
                <button onclick="filterStudents('all')" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 active:bg-blue-700">
                    Semua
                </button>
                <?php foreach ($classes as $class): ?>
                    <button onclick="filterStudents('<?php echo $class; ?>')"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 active:bg-blue-700">
                        <?php echo $class; ?>
                    </button>
                <?php endforeach; ?>
                </div>
            </div>

            <section class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <?php foreach ($students as $student): ?>
                        <div class="student-card  overflow-hidden" 
                             data-class="<?php echo $student['class']; ?>">
                            <div class="aspect-w-1 aspect-h-1 mx-auto ">
                                <img src="../images/<?php echo $student['nama_file']; ?>" 
                                     alt="<?php echo $student['name']; ?>"
                                     class="w-32 h-56  object-cover mx-auto ">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class=" -mt-4 bg-blue-500 p-1 rounded-md text-lg font-semibold text-white"><?php echo $student['name']; ?></h3>
                                <p class="text-sm text-gray-600"><?php echo $student['class']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>

    <script>
        function filterStudents(kelas) {
            const cards = document.querySelectorAll('.student-card');
            cards.forEach(card => {
                card.style.display = (kelas === 'all' || card.dataset.class === kelas) ? 'block' : 'none';
            });
        }
        filterStudents('all');
    </script>
</body>
</html>