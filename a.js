setTimeout(function() {
    clearInterval(interval); // หยุดการหมุน
    var finalName = generateRandomName(); // ชื่อสุดท้ายที่สุ่ม
    randomNameElement.textContent = finalName; // แสดงชื่อสุดท้าย
    randomNameElement.style.opacity = 1; // ทำให้ชื่อแสดง
    luckySpin.textContent = "You're Lucky! Your Random Name is...";
}, 10000); // หมุน 10 วินาที
