<?php
// เชื่อมต่อกับฐานข้อมูล
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $name = $_POST['name'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];

    // ตรวจสอบว่ามีข้อมูลครบถ้วนหรือไม่
    if (empty($name) || empty($location) || empty($phone)) {
        echo "<script>
            alert('All fields are required!');
            window.history.back();
        </script>";
    } else {
        // คำสั่ง SQL สำหรับเพิ่มข้อมูล
        $sql = "INSERT INTO randomnum (Name, Location, Phone) VALUES (:name, :location, :phone)";
        $stmt = $pdo->prepare($sql);

        try {
            // เพิ่มข้อมูลลงในฐานข้อมูล
            $stmt->execute(['name' => $name, 'location' => $location, 'phone' => $phone]);
            echo "<script>
                alert('Data added successfully!');
                window.location.href = 'Add_Name.php';
            </script>";
        } catch (PDOException $e) {
            // ถ้ามีข้อผิดพลาด
            echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.history.back();
            </script>";
        }
    }
}
?>
