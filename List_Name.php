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
    <title> List_NAME </title>
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
        <div class="button-container" style="text-align: left;">
            <a href="index.php" class="btn btn-outline-primary btn-sm" style="margin-left: 20px; margin-right: 10px; color: #3498db; font-weight: bold; border-color: #3498db;">🏠 HOME</a>
        </div>
    </header>

    <div class="full-background">
        <!-- ภาพหิมะตก -->
        <div class="snowflakes">
            <div style="left: 10%; animation-duration: 8s; animation-delay: 0s;"></div>
            <div style="left: 20%; animation-duration: 10s; animation-delay: 2s;"></div>
            <div style="left: 30%; animation-duration: 12s; animation-delay: 4s;"></div>
            <div style="left: 40%; animation-duration: 7s; animation-delay: 6s;"></div>
            <div style="left: 50%; animation-duration: 10s; animation-delay: 8s;"></div>
            <div style="left: 60%; animation-duration: 15s; animation-delay: 10s;"></div>
            <div style="left: 70%; animation-duration: 11s; animation-delay: 12s;"></div>
            <div style="left: 80%; animation-duration: 9s; animation-delay: 14s;"></div>
            <div style="left: 90%; animation-duration: 13s; animation-delay: 16s;"></div>
        </div>

        <div class="container">
            <h1 class="text-center mb-4 highlight">รายชื่อผู้โชคดี</h1>
            <p class="text-center mb-4" style="font-size: 1.5rem; color: #e74c3c; font-weight: 600;">จำนวนผู้โชคดีที่เหลือ: <strong class="highlight" style="font-size: 1.8rem; color: #f39c12;"><?php echo $userCount; ?></strong> คน</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['ID']); ?></td>
                            <td><?php echo htmlspecialchars($user['Name']); ?></td>
                            <td><?php echo htmlspecialchars($user['Location']); ?></td>
                            <td><?php echo htmlspecialchars($user['Phone']); ?></td>
                            <td>
                                <form action="edit_Name.php" method="GET" style="display:inline;">
                                    <button type="submit" name="id" value="<?php echo $user['ID']; ?>" class="btn btn-warning btn-sm">แก้ไข</button>
                                </form>

                                <form action="deletee.php" method="GET" style="display:inline;">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $user['ID']; ?>)">ลบ</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">ไม่มีผู้โชคดีในระบบ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // ฟังก์ชันสำหรับการลบผู้ใช้งาน
        function confirmDelete(id) {
            if (confirm('คุณแน่ใจที่จะลบผู้ใช้นี้?')) {
                // ส่งคำขอลบไปยัง delete.php
                window.location.href = 'deletee.php?id=' + id;
            }
        }
    </script>
</body>
</html>
