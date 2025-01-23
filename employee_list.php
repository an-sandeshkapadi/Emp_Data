<?php
$servername = "localhost";
$username = "root";
$password = "punenexus123";
$dbname = "employee_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
      <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
            color: #333;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover td {
            background-color: #e9f5e9;
            cursor: pointer;
        }

        tr td:last-child {
            font-weight: bold;
        }

    </style>
</head>
<body>


<table border="1">
    <tr>
        <th>Employee Name</th>
        <th>Email</th>
        <th>Birth Date</th>
        <th>Age</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // echo $row['birth_date'];
            $birth_date = $row['birth_date'];
            $age = calculate_age($birth_date);
            echo "<tr>
                    <td>{$row['emp_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['birth_date']}</td>
                    <td>{$age}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No employees found</td></tr>";
    }

    $conn->close();
    $today=0;
    function calculate_age($birth_date) {
        $birth_date = new DateTime($birth_date);
        $today = new DateTime('today');
        return $birth_date->diff($today)->y;
    }
    ?>

</table>

</body>
</html>
