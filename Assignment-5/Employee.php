<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./style.css">
    <script type="text/javascript">
        function validate(action) {
            if (action !== "Delete" && action !== "Display") {
                if (document.f1.t1.value == "") {
                    alert("Please Enter Employee ID");
                    return false;
                }
                if (document.f1.t2.value == "") {
                    alert("Please Enter Employee Name");
                    return false;
                }
                if (document.f1.t3.value == "") {
                    alert("Please Enter Employee Salary");
                    return false;
                }
                if (document.f1.t4.value == "") {
                    alert("Please Enter Employee City");
                    return false;
                }
                if (document.f1.t5.value == "") {
                    alert("Please Enter Employee Address");
                    return false;
                }
                if (document.f1.t6.value == "") {
                    alert("Please Enter Employee State");
                    return false;
                }
                if (document.f1.t7.value == "") {
                    alert("Please Enter Employee Email");
                    return false;
                }
            }
            return true;
        }
    </script>
</head>

<body>
    <form name="f1" method="POST">
        <table>
            <tr>
                <td>Employee ID</td>
                <td><input type="number" name="t1" /></td>
            </tr>
            <tr>
                <td>Employee Name</td>
                <td><input type="text" name="t2" /></td>
            </tr>
            <tr>
                <td>Employee Salary</td>
                <td><input type="text" name="t3" /></td>
            </tr>
            <tr>
                <td>Employee City</td>
                <td><input type="text" name="t4" /></td>
            </tr>
            <tr>
                <td>Employee Address</td>
                <td><input type="text" name="t5" /></td>
            </tr>
            <tr>
                <td>Employee State</td>
                <td><input type="text" name="t6" /></td>
            </tr>
            <tr>
                <td>Employee Email</td>
                <td><input type="text" name="t7" /></td>
            </tr>
        </table>
        <input type="submit" name="b1" value="Add" onclick="return validate('Add')" />
        <input type="submit" name="b2" value="Update" onclick="return validate('Update')" />
        <input type="submit" name="b3" value="Delete" onclick="return validate('Delete')" />
        <input type="submit" name="b4" value="Display" onclick="return validate('Display')" />
    </form>

    <?php
    // Database Connection
    $conn = new mysqli("localhost", "root", "1234", database: "Employee_Data");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    if (isset($_POST['b1'])) {
        // Insert
        $emp_id = $_POST['t1'];
        $emp_name = $_POST['t2'];
        $emp_salary = $_POST['t3'];
        $emp_city = $_POST['t4'];
        $emp_address = $_POST['t5'];
        $emp_state = $_POST['t6'];
        $emp_email = $_POST['t7'];

        // Check if ID already exists
        $checkSql = "SELECT * FROM Employee WHERE id='$emp_id'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            echo "Error: Employee ID already exists.";
        } else {
            $sql = "INSERT INTO Employee (id, name, salary, city, address, state, email) 
                    VALUES ('$emp_id', '$emp_name', '$emp_salary', '$emp_city', '$emp_address', '$emp_state', '$emp_email')";

            if ($conn->query($sql) === TRUE) {
                echo "Employee data inserted successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }


    if (isset($_POST['b2'])) {
        // Update
        $emp_id = $_POST['t1'];
        $emp_name = $_POST['t2'];
        $emp_salary = $_POST['t3'];
        $emp_city = $_POST['t4'];
        $emp_address = $_POST['t5'];
        $emp_state = $_POST['t6'];
        $emp_email = $_POST['t7'];
        $sql = "UPDATE  Employee 
                SET name='$emp_name', salary='$emp_salary', city='$emp_city', address='$emp_address', state='$emp_state', email='$emp_email' 
                WHERE id='$emp_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Employee data updated successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['b3'])) {
        // Delete
        $emp_id = $_POST['t1'];
        $sql = "DELETE FROM  Employee WHERE id='$emp_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Employee data deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['b4'])) {
        // Display
        $sql = "SELECT * FROM  Employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>Email</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["salary"] . "</td>
                        <td>" . $row["city"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td>" . $row["state"] . "</td>
                        <td>" . $row["email"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No  Employee found.";
        }
    }

    $conn->close();
    ?>
</body>

</html>