<?php
require 'connect.php';

try {
    // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
    $query = "SELECT * FROM randomnum";
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($users !== false) {
        $userCount = count($users); // นับจำนวนผู้โชคดีที่เหลือ
    } else {
        $userCount = 0;
    }
} catch (Exception $e) {
    // หากมีข้อผิดพลาดในการดึงข้อมูลจากฐานข้อมูล
    $userCount = 0;
    $users = [];
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add_Name </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f8ff;
        }

        header {
            position: relative;
            z-index: 10;
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
            color: white;
            padding: 20px 0;
            animation: rainbow 5s linear infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        

        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .full-background {
            background-color: #87CEFA;
            min-height: 100vh;
            padding-top: 70px; /* ลดระยะห่าง */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: -20px; /* ลดระยะห่างระหว่างคอนเทนเนอร์กับส่วนบน */
        }

        .highlight {
            color: #f39c12;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
        }

        /* เพิ่มลวดลายหิมะ */
        .snowflakes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
            animation: snow 10s linear infinite;
        }

        .snowflakes div {
            position: absolute;
            top: -10px;
            width: 10px;
            height: 10px;
            background-color: #ffffff;
            border-radius: 50%;
            opacity: 0.7;
            animation: snowflakesAnimation 10s linear infinite;
        }

        @keyframes snowflakesAnimation {
            0% {
                transform: translateX(0) translateY(0);
            }
            100% {
                transform: translateX(100vw) translateY(100vh);
            }
        }

        @keyframes snow {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>🌈 WORKSHOP 2025 🌈</h1>
        <h2 style="margin-top: -20px;">✨ SMT & SMF ✨</h2> <!-- ลดระยะห่างระหว่าง h1 และ h2 เพิ่มขึ้น -->
        <div class="button-container" style="text-align: left; margin-left: 20px;">
            <a href="index.php" class="btn btn-outline-primary btn-sm" style="margin-right: 10px; color: #3498db; font-weight: bold; border-color: #3498db;">🏠 HOME</a>
        </div>
    </header>
    
    <!-- The rest of your content here... -->

</body>

    <div class="container">
        <h2>✨ เพิ่มรายชื่อ ✨</h2>

        <!-- ไอคอนต้นคริสต์มาส -->
        <div class="tree-icon">
            🎄
        </div>

        <!-- ข้อความแจ้งเตือนเมื่อเพิ่มชื่อสำเร็จ -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
            <div class="alert alert-success">
                🎉 เพิ่มชื่อสำเร็จแล้ว! 🎉
            </div>
        <?php } ?>

        <form action="Check_Add.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">📛 ชื่อ</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="กรอกชื่อเต็ม" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">📍 ที่ตั้ง</label>
                <select class="form-control" id="location" name="location" required>
                    <option value="">-- เลือกศูนย์บริการ --</option>
                    <option value="ศูนย์บริการซัมซุงสาขาสุราษธานี">ศูนย์บริการซัมซุงสาขาสุราษธานี</option>
                    <option value="ศูนย์บริการซัมซุงสาขานครศรีธรรมราช">ศูนย์บริการซัมซุงสาขานครศรีธรรมราช</option>
                    <option value="ศูนย์บริการซัมซุงสาขาภูเก็ต">ศูนย์บริการซัมซุงสาขาภูเก็ต</option>
                    <option value="ศูนย์บริการซัมซุงสาขาเกาะสมุย">ศูนย์บริการซัมซุงสาขาเกาะสมุย</option>
                    <option value="ศูนย์บริการซัมซุงสาขาหัวหิน">ศูนย์บริการซัมซุงสาขาหัวหิน</option>
                    <option value="สมาร์ทฟิกซ์ จำกัด (สาขาหาดใหญ่)">สมาร์ทฟิกซ์ จำกัด (สาขาหาดใหญ่)</option>
                    <option value="สมาร์ทฟิกซ์ จำกัด (สาขาภูเก็ต)">สมาร์ทฟิกซ์ จำกัด (สาขาภูเก็ต)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">📞 เบอร์โทร</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="กรอกเบอร์โทรศัพท์" required>
            </div>
            <button type="submit" class="btn btn-primary">🚀 ส่งข้อมูล 🚀</button>
        </form>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
