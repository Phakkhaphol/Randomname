
<?php
require 'connect.php';

// ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ตรวจสอบค่าของ $id ก่อนว่าเป็นค่าที่ถูกต้อง
    if (empty($id) || !is_numeric($id)) {
        echo "ID ไม่ถูกต้อง";
        exit;
    }

    try {
        // สร้างคำสั่ง SQL สำหรับการลบข้อมูล
        $query = "DELETE FROM randomnum WHERE ID = :id";

        // เตรียมคำสั่ง SQL
        $stmt = $pdo->prepare($query);

        // ผูกค่าตัวแปรกับคำสั่ง SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // ทำการลบข้อมูล
        if ($stmt->execute()) {
            // หากลบสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้า List_Name.php
            header("Location: List_Name.php");
            exit;
        } else {
            // แสดงข้อผิดพลาดหากการลบไม่สำเร็จ
            echo "เกิดข้อผิดพลาดในการลบข้อมูล";
        }
    } catch (Exception $e) {
        // หากมีข้อผิดพลาดในการทำงาน
        echo "Error: " . $e->getMessage();
    }
} else {
    // หากไม่ได้รับค่า id
    echo "ไม่พบข้อมูลที่จะลบ";
}
?>
