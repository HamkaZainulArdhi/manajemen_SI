<?php
session_start();
include '../fuction.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Tambahkan data Mahasiswa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $class = $_POST['class'];

    $gambar = upload();


    $stmt = $conn->prepare("INSERT INTO students (name, class, nama_file) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $class, $gambar);
    // Eksekusi query   

    if ($stmt->execute()) {
        // If successful, show success message and redirect after 2 seconds
        $successMessage = "Data Mahasiswa berhasil ditambahkan!";
    } else {
        $errorMessage = "Gagal menambahkan data mahaMahasiswa.";
    }
}

function upload(){
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    $extensiongambarvalid = ['jpg', 'jpeg', 'png'];
    $extensiongambar = explode('.', $nama_file);
    $extensiongambar = strtolower(end($extensiongambar));
    if (!in_array($extensiongambar, $extensiongambarvalid)) {
        echo "<script>
            alert('LU UPLOAD BUKAN GAMBAR COKK!');
            window.location.href = 'tambah-mahasiswa.php';
        </script>";
        exit();
    }

    move_uploaded_file($tmp_file, '../images/' . $nama_file);
    return $nama_file;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Tambah Mahasiswa</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Tambah Data Mahasiswa</h2>

            <!-- Form Tambah Mahasiswa -->
            <form action="" method="POST" class="bg-white shadow rounded p-6 space-y-4" enctype="multipart/form-data">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Mahasiswa</label>
                    <input type="text" name="name"
                        class="w-full border-gray-900 border rounded p-2 focus:ring-2 focus:ring-blue-600" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kelas</label>
                    <input type="text" name="class"
                        class="w-full border-gray-900 border rounded p-2 focus:ring-2 focus:ring-blue-600" required>
                </div>
                <div>
                <label class="block text-gray-700 font-bold mb-2">Foto</label>
                    <input type="file" name="gambar" id="fileInput" accept="image/*"
                        class="w-full border-gray-900 border rounded p-2 focus:ring-2 focus:ring-blue-600" >
                    <div id="previewContainer" class="mt-3">
                        <img id="previewImage" class="hidden max-w-xs rounded-lg shadow-md">
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>

            <!-- Success/Error Message -->
            <?php if (isset($successMessage)): ?>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo $successMessage; ?>',
                confirmButtonColor: '#3085d6',
                timer: 2000, // Show alert for 2 seconds before redirecting
            }).then(() => {
                window.location.href = "mahasiswa.php"; // Redirect after success
            });
            </script>
            <?php elseif (isset($errorMessage)): ?>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?php echo $errorMessage; ?>',
                confirmButtonColor: '#d33',
            });
            </script>
            <?php endif; ?>
        </div>
    </div>
    <script>
document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0]; 
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('previewImage');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
</body>

</html>