<?php
include '../fuction.php'; 
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: ../dashboard/index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Pengguna tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body class="bg-gray-100">
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('../images/hero-loginNEW.jpg');">
       
        <div class="relative z-10 flex items-center justify-center h-full flex-col ">

            <!-- Teks Selamat datang di atas form -->
            <div class="text-gray-800 text-center -mt-24">
               <h1 class="text-4xl font-bold">Selamat Datang Di Program Studi </h1>
                <h2 class="text-3xl font-semibold">Sistem Informasi Batch 23 </h2>
            </div>

            <!-- Form Login dengan blur dan ukuran yang lebih kecil -->
            <div class="w-full max-w-sm mx-auto p-8 ">
                <h1 class="text-2xl font-bold  text-center">Login</h1>
                <?php if (isset($error)): ?>
                <p class="text-red-500 mb-4 text-center"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST" class="">
                    <div class="mb-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg"
                            required>
                    </div>
                    <button type="submit" name="login"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg text-lg">Login</button>
                </form>
                <div class="mt-2 text-center">
                    <p>Belum punya akun? <a href="register.php" class="text-blue-500">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>