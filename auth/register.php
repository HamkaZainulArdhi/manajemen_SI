<?php
include '../fuction.php'; // File koneksi database

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<script>
            alert('Registrasi berhasil! Silakan login.');
            window.location.href = 'login.php';
        </script>";
    } else {
        $error = "Gagal registrasi. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>

<body class="bg-gray-100">
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('../images/hero-loginNEW.jpg');">
        <div class="relative z-10 flex items-center justify-center h-full flex-col">

           <div class="text-gray-800 text-center -mt-8 ">
                <h1 class="text-4xl font-bold">Selamat Datang Di Kelas </h1>
                <h2 class="text-3xl font-semibold">S1SI-07-D  </h2>
            </div>

            <!-- Form Login dengan blur dan ukuran yang lebih kecil -->
            <div class="w-full max-w-sm mx-auto p-8 ">
                <h1 class="text-2xl font-bold text-center">Register</h1>
                <?php if (isset($error)): ?>
                <p class="text-red-500 mb-4 text-center"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-2">
                        <label for="username" class="block text-sm font-medium">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg"
                             required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg"
                             required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg"
                             required>
                    </div>
                    <button type="submit" name="register"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg text-lg">Register</button>
                </form>
                <div class="flex justify-center">
                    <div class="inline-block text-center bg-white mt-2 px-4  rounded-lg">
                        <p>Sudah punya akun? <a href="login.php" class="text-blue-500">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>