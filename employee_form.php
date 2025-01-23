<?php
$servername = "localhost";
$username = "root";
$password = "punenexus123";
$dbname = "employee_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_name = $_POST['emp_name'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];

    // $sql = "INSERT INTO employees (emp_name, email, birth_date)
    //         VALUES ('$emp_name', '$email', '$birth_date')";
    $stmt = $conn->prepare("INSERT INTO employees (emp_name, email, birth_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $emp_name, $email, $birth_date);

    // if ($conn->query($sql) === TRUE) {
    //     echo "";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    if ($stmt->execute()) {
        echo "Record added successfully!";
        header("Location: employee_list.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="date"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Employee Data Form</h2>
        <form method="POST" action="employee_list.php">
            <div class="form-group">
                <label for="emp_name">Employee Name:</label>
                <input type="text" id="emp_name" name="emp_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>

</body>
</html>

