<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: cadetblue;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .button {
            background-color: cadetblue;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .button:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <h1>Report</h1>
    <table>
        <thead>
            <tr>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "slots";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Get all column names from the database table
                $sql = "SHOW COLUMNS FROM cn";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<th>" . $row["Field"] . "</th>";
                    }
                }

                $conn->close();
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reconnect to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get all rows from the database table
            $sql = "SELECT * FROM cn";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <button class="button" onclick="calculateTotalAttendance()">Total Attendance</button>
</body>
</html>
