<?php
$conn = mysqli_connect("localhost", "root", "12345", "xe_shop");
if ($conn) {
    if (!mysqli_set_charset($conn, "utf8mb4")) {
        die("Lỗi charset: " . mysqli_error($conn));
    }
} else {
    die("Kết nối thất bại: ");
}
?>
