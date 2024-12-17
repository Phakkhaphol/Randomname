<?php
require 'connect.php';

// ตรวจสอบว่า id มีค่าหรือไม่
if (isset($_GET['id'])) {
    // ดึงข้อมูลของผู้ใช้จากฐานข้อมูล
    $id = $_GET['id'];
    $query = "SELECT * FROM randomnum WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่าพบข้อมูลหรือไม่
    if (!$user) {
        echo "ไม่พบผู้ใช้ที่ต้องการแก้ไข";
        exit;
    }
} else {
    echo "ไม่มีข้อมูล ID ที่จะทำการแก้ไข";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ แก้ไขข้อมูลผู้ใช้งาน ✨</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://www.transparenttextures.com/patterns/diamond-balls.png'), linear-gradient(135deg, #81d4fa, #b2ebf2); /* พื้นหลังสีฟ้า */
            font-family: 'Arial', sans-serif;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
        }

        /* เอฟเฟกต์ตกตุกตาน้ำแข็ง */
        @keyframes snow {
            0% { top: -10%; }
            100% { top: 100%; }
        }

        .snowflake {
            position: absolute;
            top: -10%;
            color: #fff;
            font-size: 30px;
            z-index: 1;
            animation: snow 5s linear infinite;
            animation-delay: var(--delay);
        }

        .snowflake:nth-child(odd) {
            animation-duration: 6s;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 600px;
        }

        h1 {
            color: #c0392b; /* สีแดงคริสต์มาส */
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        /* ปรับให้ label และ input ชิดซ้าย */
        .form-group label {
            text-align: left;
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-control {
            text-align: left; /* ทำให้ข้อมูลใน input ชิดซ้าย */
        }

        .btn-primary {
            background-color: #27ae60;
            border-color: #27ae60;
            border-radius: 30px;
            padding: 16px 40px;
            font-size: 20px;
            font-weight: bold;
            margin: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            background-color: #2ecc71;
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
        }

        .btn-primary:active {
            transform: scale(1);
        }
    </style>
</head>
<body>
    <!-- เอฟเฟกต์ตกตุกตาน้ำแข็ง -->
    <div class="snowflake" style="--delay: 0s;">❄️</div>
    <div class="snowflake" style="--delay: 1s;">❄️</div>
    <div class="snowflake" style="--delay: 2s;">❄️</div>
    <div class="snowflake" style="--delay: 3s;">❄️</div>
    <div class="snowflake" style="--delay: 4s;">❄️</div>

    <div class="container">
        <h1>✨ แก้ไขข้อมูลผู้ใช้งาน ✨</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['ID']; ?>">

            <div class="form-group">
                <label for="name">ชื่อ</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['Phone']); ?>" required>
            </div>

            <div class="form-group">
                <label for="location">ศูนย์บริการ</label>
                <select class="form-control" id="location" name="location" required>
                    <option value="">-- เลือกศูนย์บริการ --</option>
                    <option value="ศูนย์บริการซัมซุงสาขาสุราษธานี" <?php echo ($user['Location'] == 'ศูนย์บริการซัมซุงสาขาสุราษธานี') ? 'selected' : ''; ?>>ศูนย์บริการซัมซุงสาขาสุราษธานี</option>
                    <option value="ศูนย์บริการซัมซุงสาขานครศรีธรรมราช" <?php echo ($user['Location'] == 'ศูนย์บริการซัมซุงสาขานครศรีธรรมราช') ? 'selected' : ''; ?>>ศูนย์บริการซัมซุงสาขานครศรีธรรมราช</option>
                    <option value="ศูนย์บริการซัมซุงสาขาภูเก็ต" <?php echo ($user['Location'] == 'ศูนย์บริการซัมซุงสาขาภูเก็ต') ? 'selected' : ''; ?>>ศูนย์บริการซัมซุงสาขาภูเก็ต</option>
                    <option value="ศูนย์บริการซัมซุงสาขาเกาะสมุย" <?php echo ($user['Location'] == 'ศูนย์บริการซัมซุงสาขาเกาะสมุย') ? 'selected' : ''; ?>>ศูนย์บริการซัมซุงสาขาเกาะสมุย</option>
                    <option value="ศูนย์บริการซัมซุงสาขาหัวหิน" <?php echo ($user['Location'] == 'ศูนย์บริการซัมซุงสาขาหัวหิน') ? 'selected' : ''; ?>>ศูนย์บริการซัมซุงสาขาหัวหิน</option>
                    <option value="สมาร์ทฟิกซ์ จำกัด (สาขาหาดใหญ่)" <?php echo ($user['Location'] == 'สมาร์ทฟิกซ์ จำกัด (สาขาหาดใหญ่)') ? 'selected' : ''; ?>>สมาร์ทฟิกซ์ จำกัด (สาขาหาดใหญ่)</option>
                    <option value="สมาร์ทฟิกซ์ จำกัด (สาขาภูเก็ต)" <?php echo ($user['Location'] == 'สมาร์ทฟิกซ์ จำกัด (สาขาภูเก็ต)') ? 'selected' : ''; ?>>สมาร์ทฟิกซ์ จำกัด (สาขาภูเก็ต)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">บันทึกการแก้ไข</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
