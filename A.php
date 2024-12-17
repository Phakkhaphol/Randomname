<?php
// รวมไฟล์ connect.php เพื่อเชื่อมต่อฐานข้อมูล
require 'connect.php';

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT Name, Location FROM randomnum";  // ปรับให้ตรงกับโครงสร้างตารางของคุณ
$stmt = $pdo->query($query);

// สร้าง array ของชื่อและสถานที่
$namesArray = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $namesArray[] = $row;
}

// แปลงเป็น JSON และใส่ในตัวแปร JavaScript
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎉 Random Name Generator 🎉</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/KPBRO.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
            flex-direction: column;
        }
        header {
            position: absolute;
            top: 0;
            width: 100%;
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
            background-size: 200% 200%;
            color: white;
            padding: 20px 0;
            text-align: center;
            animation: rainbow 5s linear infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }
        .section {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            min-height: 400px;
            height: auto;  
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }

        .random-name {
            font-size: 36px;
            font-weight: bold;
            color: #0074c2;
            margin: 20px 0;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .random-name span {
            font-size: 18px;
            color: #555;
            font-style: italic;
        }
        .btn {
            padding: 12px 30px;
            font-size: 18px;
            background-color: #0074c2;
            color: white;
            border: none;
            border-radius: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #005999;
        }
        .previous-results-list1 {
            margin-top: 20px;
            text-align: left;
            font-size: 30px;
            color: #0074c2;
            height: 300px;
            overflow-y: auto;
            padding: 10px;
            background-color: rgba(0, 116, 194, 0.1);
            border-radius: 8px;
        }
        .previous-results-list {
            margin-top: 10px;
            text-align: left;
            font-size: 35px;
            color: #0074c2;
            height: 150px;
            overflow-y: auto;
            padding: 10px;
            background-color: rgba(0, 116, 194, 0.1);
            border-radius: 8px;
        }
        .result-item {
            margin: 8px 0;
            color: #555;
        }
        /* Style for remaining lucky winners */
        #remaining-winners {
            font-size: 20px;
            color: #0074c2;
            font-weight: bold;
            margin-top: 10px;
        }
        header .button-container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 10px;
            padding-left: 20px;
        }

        /* Styling for the Home button */
        header .button-container a {
            font-size: 20px;
            font-weight: bold;
            color: white;
            background: linear-gradient(45deg, #ff7e5f, #feb47b);
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        header .button-container a:hover {
            background: linear-gradient(45deg, #feb47b, #ff7e5f);
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        header .button-container a:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <header>
        <h1>🌈 WORKSHOP 2025 🌈</h1>
        <h1>✨ SMT & SMF ✨</h1>
        <div class="button-container">
            <a href="index.php">🏠 HOME</a>
            <a href="List_Name.php">🔙 รายชื่อ</a>
        </div>
    </header>

    <div class="container">
        <div class="section">
            <h1>🎲 LUCKY NUMBER 🎲</h1>
            <h2>💫 ผู้โชคดีได้แก่ 💫</h2>
            <div class="previous-results-list" id="random-name">🎉 Click to Start! 🎉</div>

            <!-- Input สำหรับกรอกจำนวนผู้โชคดี -->
            <label for="numWinners">จำนวนผู้โชคดี:</label>
            <input type="number" id="numWinners" value="1" min="1" max="10" class="form-control" style="margin-bottom: 20px;">
            
            <button type="button" class="btn" onclick="startSpin()">🚀 เริ่มสุ่ม 🚀</button>
            
            <!-- Display remaining lucky winners -->
            <p id="remaining-winners">💫 Remaining: <span id="remaining-count">0</span> 💫</p>
        </div>

        <div class="section">
            <h1>🏆 รายชื่อผู้โชคดี 🏆</h1>
            <div class="previous-results-list1" id="previous-results-list"></div>
        </div>
    </div>

    <audio id="spin-sound" src="img/555.mp3"></audio>

    <script>
        var allResults = [];
        var data = <?php echo json_encode($namesArray); ?>;  // รับข้อมูลจาก PHP มาใช้ใน JavaScript

        // ฟังก์ชันเริ่มสุ่ม
        function startSpin() {
            var numWinners = parseInt(document.getElementById('numWinners').value);  // ดึงจำนวนผู้โชคดีจากอินพุต
            var randomNameElement = document.getElementById("random-name");
            randomNameElement.style.opacity = 0;

            var spinSound = document.getElementById("spin-sound");
            spinSound.pause();
            spinSound.currentTime = 0;
            spinSound.play();

            var winners = []; // เก็บผู้โชคดีทั้งหมด
            var interval = setInterval(function() {
                var randomIndex = Math.floor(Math.random() * data.length);
                var randomPerson = data[randomIndex];
                randomNameElement.innerHTML = randomPerson.Name + " <br> <span>🏠 " + randomPerson.Location + "</span>";
                randomNameElement.style.opacity = 1;
            }, 150);

            setTimeout(function() {
                clearInterval(interval);

                // สุ่มผู้โชคดีจำนวนที่กำหนด
                while (winners.length < numWinners) {
                    var finalIndex = Math.floor(Math.random() * data.length);
                    var finalPerson = data[finalIndex];

                    // เช็คว่าได้เลือกผู้โชคดีนี้ไปแล้วหรือไม่
                    if (!winners.some(winner => winner.Name === finalPerson.Name)) {
                        winners.push(finalPerson);
                    }
                }

                // แสดงผลผู้โชคดี
                randomNameElement.innerHTML = winners.map(function(winner) {
                    return winner.Name + " <br> <span>📍 " + winner.Location + "</span>";
                }).join("<hr>");

                // ลบผู้โชคดีจากฐานข้อมูล
                winners.forEach(function(winner) {
                    removeWinnerFromDatabase(winner.Name);
                });

                // เพิ่มผู้โชคดีในรายการ
                allResults = allResults.concat(winners);
                updateResultsList();

                // อัพเดตจำนวนผู้โชคดีที่เหลือ
                updateRemainingCount();
            }, 6000);
        }

        // ฟังก์ชันอัพเดตจำนวนผู้โชคดีที่เหลือ
        function updateRemainingCount() {
            var remainingCountElement = document.getElementById("remaining-count");

            // คำนวณจำนวนผู้โชคดีที่เหลือ
            var remaining = data.length - allResults.length;
            remainingCountElement.textContent = remaining > 0 ? remaining : "No more winners!";
        }

        // ฟังก์ชันเพื่ออัพเดตรายการผลผู้โชคดี
        function updateResultsList() {
            var resultsList = document.getElementById("previous-results-list");
            resultsList.innerHTML = "";

            allResults.forEach(function(result) {
                var resultItem = document.createElement("div");
                resultItem.innerHTML = result.Name + "<br><span>" + result.Location + "</span>";
                resultsList.appendChild(resultItem);
            });
        }

        // ฟังก์ชันลบผู้โชคดีจากฐานข้อมูล
        function removeWinnerFromDatabase(winnerName) {
            fetch("delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({ name: winnerName }),
            })
            .then((response) => response.json())
            .then((responseData) => {
                if (responseData.success) {
                    // ลบผู้โชคดีออกจาก array data
                    data = data.filter((person) => person.Name !== winnerName);
                }
            })
            .catch((error) => console.error("Error:", error));
        }
    </script>
</body>
</html>
