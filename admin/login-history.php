<?php
include('includes/header.php');
global $conn;


$sql = "
    SELECT 
        login_history.admin_id, 
        admin.nama AS admin_nama, 
        login_history.login_time, 
        login_history.logout_time 
    FROM 
        login_history 
    JOIN 
        admin 
    ON 
        login_history.admin_id = admin.id
    ORDER BY 
        login_history.login_time DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login History</title>
    
    </style>
</head>

<body>
    <h1>Login History</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Admin Name</th>
                <th>Login Time</th>
                <th>Logout Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["admin_nama"]); ?></td>
                    <td><?php echo htmlspecialchars($row["login_time"]); ?></td>
                    <td>
                        <?php
                        if ($row["logout_time"] === NULL) {
                            echo "Masih Di Dalam Akun";
                        } else {
                            echo htmlspecialchars($row["logout_time"]);
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        </div>
    <?php else: ?>
        <p style="text-align: center;">0 results</p>
    <?php endif; ?>
</body>

</html>