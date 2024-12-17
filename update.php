<?php
require 'connect.php';

// ตรวจสอบว่ามีข้อมูลที่ต้องการอัปเดตหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // รับค่าจากฟอร์ม
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    // ตรวจสอบว่าข้อมูลที่ได้รับมาครบถ้วน
    if (empty($name) || empty($phone) || empty($location)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit;
    }

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูล
    $query = "UPDATE randomnum SET Name = :name, Phone = :phone, Location = :location WHERE id = :id";

    // เตรียมคำสั่ง SQL
    $stmt = $pdo->prepare($query);

    // ผูกค่าตัวแปรกับคำสั่ง SQL
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':id', $id);

    // ทำการอัปเดตข้อมูล
    if ($stmt->execute()) {
        echo "อัปเดตข้อมูลเรียบร้อยแล้ว!";
        header("Location: List_Name.php");  // เปลี่ยนเส้นทางไปยังหน้ารายชื่อผู้ติดต่อ
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
    }
} else {
    echo "ข้อมูลไม่ครบถ้วน";
}
?>
