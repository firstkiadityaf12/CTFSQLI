<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan user database
$password = ""; // Sesuaikan dengan password database
$database = "ctf"; // Sesuaikan dengan nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
} else {
    echo "Koneksi Berhasil!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        if ($username === 'admin') {
            $flag = $conn->query("SELECT secret FROM flag")->fetch_assoc()['secret'];
            echo "Congrats! Your flag is: " . $flag;
        } else {
            echo "Welcome, $username!";
        }
    } else {
        echo "Invalid credentials!";
    }
}
?>
