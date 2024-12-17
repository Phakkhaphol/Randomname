<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ MENU ✨</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- สำหรับไอคอน -->
    <style>
        /* พื้นหลังคริสต์มาส */
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

        /* การออกแบบคอนเทนเนอร์ */
        .container {
            background: rgba(255, 255, 255, 0.9); /* พื้นหลังโปร่งแสง */
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            max-width: 700px;
            text-align: center;
            position: relative;
            z-index: 10;
            animation: scaleIn 0.7s ease-in-out;
        }

        /* แอนิเมชันการเข้ามาของคอนเทนเนอร์ */
        @keyframes scaleIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        h1 {
            color: #c0392b; /* สีแดงคริสต์มาส */
            font-weight: bold;
            margin-bottom: 25px;
            text-shadow: 2px 2px 5px rgba(255, 0, 0, 0.6); /* เงาสีแดง */
        }

        h2 {
            color: #c0392b; /* สีแดงคริสต์มาส */
            font-weight: bold;
            margin-bottom: 25px;
            text-shadow: 2px 2px 5px rgba(255, 0, 0, 0.6); /* เงาสีแดง */
        }

        .btn-custom {
            background-color: #27ae60; /* สีเขียวคริสต์มาส */
            border: none;
            border-radius: 30px;
            padding: 16px 40px;
            font-size: 20px;
            font-weight: bold;
            margin: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .btn-custom:hover {
            background-color: #2ecc71;
            transform: scale(1.1); /* ขยายขนาดปุ่มเมื่อ hover */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
        }

        .btn-custom:active {
            transform: scale(1); /* เมื่อคลิกปุ่มให้กลับมาขนาดปกติ */
        }

        .tree-icon {
            font-size: 70px;
            color: #f39c12; /* สีทองของต้นคริสต์มาส */
            animation: rotateTree 3s ease-in-out infinite;
        }

        /* เอฟเฟกต์หมุนของต้นคริสต์มาส */
        @keyframes rotateTree {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(10deg); }
            100% { transform: rotate(0deg); }
        }

        .gift-icon {
            font-size: 70px;
            color: #e74c3c; /* สีแดงของของขวัญ */
            animation: bounceGift 1.5s ease-in-out infinite;
        }

        /* เอฟเฟกต์กระโดดของของขวัญ */
        @keyframes bounceGift {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
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
        <h1>✨ WELCOME TO✨</h1>
        <h1>🌈 WORKSHOP 2025 🌈</h1>
        <h2 style="margin-top: -20px;">✨ SMT & SMF ✨</h2>

        <!-- ไอคอนต้นคริสต์มาส -->
        <div class="tree-icon">
            🎄
        </div>

        <form action="" method="get">
            <!-- ปุ่มที่ 1 -->
            <a href="Random.php" class="btn btn-custom">สุ่มผู้โชคดี</a><br>
            
            <!-- ปุ่มที่ 2 -->
            <a href="List_Name.php" class="btn btn-custom">รายชื่อผู้โชคดี</a><br>
            
            <!-- ปุ่มที่ 3 -->
            <a href="Add_Name.php" class="btn btn-custom">เพิ่มรายชื่อ</a><br>
            
           
        </form>

        <!-- ไอคอนของขวัญ -->
        <div class="gift-icon mt-4">
            🎁
        </div>
        
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
