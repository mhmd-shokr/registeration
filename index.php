<?php
include("./connect.php");
include_once("./validation.php");  // تضمين ملف الـ validation

$message = ""; // متغير لتخزين الرسالة

if (isset($_POST['add'])) {
    // الحصول على البيانات من النموذج
    $name = mysqli_real_escape_string($con, $_POST['nameCustomer']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $address = mysqli_real_escape_string($con, $_POST['Address']);
    $telephone = mysqli_real_escape_string($con, $_POST['Telephone']);
    $date = mysqli_real_escape_string($con, $_POST['Date']);

    // التحقق من المدخلات
    $errors = validate_input($name, $email, $address, $telephone, $date);

    if (count($errors) > 0) {
        // إذا كانت هناك أخطاء في المدخلات، عرض الأخطاء
        $message = "<p class='error'>" . implode("<br>", $errors) . "</p>";
    } else {
        // التحقق من وجود العميل في قاعدة البيانات باستخدام البريد الإلكتروني أو الهاتف
        $check_sql = "SELECT * FROM Customer WHERE Email = '$email' OR Telephone = '$telephone'";
        $check_result = mysqli_query($con, $check_sql);
        if (mysqli_num_rows($check_result) > 0) {
            // إذا كانت البيانات موجودة بالفعل
            $message = "<p class='error'>Customer with this email or telephone already exists.</p>";
        } else {
            // إذا كانت المدخلات صحيحة، إضافة البيانات إلى قاعدة البيانات
            $sql = "INSERT INTO Customer(nameCustomer, Email, Address, Telephone, Date) 
                    VALUES ('$name', '$email', '$address', '$telephone', '$date')";
            if (mysqli_query($con, $sql)) {
                $message = "<p>Data added successfully</p>";
            } else {
                $message = "<p class='error'>Failed to add data: " . mysqli_error($con) . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <title>Booking</title>
</head>
<body>
    <div id="message-box">
        <?php if (isset($message)) echo $message; ?>
    </div>

    <div class="container">
        <form action="index.php" method="POST">
            <nav>
                <img src="./booking.jpg" alt="Booking Image">
                <h3>Reservation</h3>
                <label for="name">Name Customer</label><br>
                <input type="text" id="name" name="nameCustomer" required autocomplete="off"><br>

                <label for="email">Email</label><br>
                <input type="email" id="email" name="Email" required autocomplete="off"><br>

                <label for="address">Address</label><br>
                <input type="text" id="address" name="Address" required autocomplete="off"><br>

                <label for="telephone">Telephone</label><br>
                <input type="text" id="telephone" name="Telephone" required autocomplete="off"><br>

                <label for="date">Date</label><br>
                <input type="date" id="date" name="Date" required autocomplete="off"><br>

                <button type="reset" name="reset">Reset</button>
                <button type="submit" name="add">Add</button>
            </nav>
        </form>
        <div class="info-wrapper">
        <div class="info">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Date</th>
                </tr>
                <?php
                // عرض البيانات في الجدول
                $sql = "SELECT * FROM Customer";
                $result = mysqli_query($con, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nameCustomer']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
    </div>
</body>
</html>