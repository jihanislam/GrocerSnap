<?php require_once('inc/header.php'); ?>
<?php
    require('core/connection.php');
    // Handle Update and Delete actions
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Update action
        if (isset($_GET['update']) && $_GET['update'] === 'user') {
            // Validate and sanitize inputs
            $id = intval($_GET['id']);
            $name = $conn->real_escape_string($_GET['name']);
            $phone = $conn->real_escape_string($_GET['phone']);
            $user = $conn->real_escape_string($_GET['user']);
            $pass = $conn->real_escape_string($_GET['pass']);
            $address = $conn->real_escape_string($_GET['address']);

            // Perform update query
            $sql = "UPDATE `users` SET `name` = ?, `phone` = ?, `user` = ?, `pass` = ?, `address` = ? WHERE `id` = ?";
            $status = $conn->prepare($sql);
            $status->bind_param("sssssi", $name, $phone, $user, $pass, $address, $id);

            if ($status->execute()) {
                echo "<script>
                        window.location.href = 'index.php?success=User Update Successfully';
                    </script>";
            } else {
                echo "<script>
                        window.location.href = 'index.php?success=User Update Unsuccessfully';
                    </script>";
            }
            $status->close();
        }

        // Delete action
        if (isset($_GET['name']) && $_GET['name'] === 'delete') {
            $id = intval($_GET['id']);

            // Perform delete query
            $sql = "DELETE FROM `users` WHERE `id` = ?";
            $status = $conn->prepare($sql);
            $status->bind_param("i", $id);

            if ($status->execute()) {
                echo "<script>
                        window.location.href = 'index.php?success=User Deleted Successfully';
                    </script>";
            } else {
                echo "<script>
                        window.location.href = 'index.php?error=User Delete unsuccessfully';
                    </script>";
            }
            $status->close();
        }
    }
    $sql = "SELECT * FROM `users`";
    $result = $conn->query($sql);
?>
<div class="row">
    <div class="container-fluid">
        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>phone</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result->num_rows > 0) {
                // Fetch and display data
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <form action="" method="GET">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <tr class="<?php if($row['userType'] == 'admin'){echo 'bg-info';} ?>">
                            <td>
                                <input type="text" name="name" class="form-control" value="<?php echo $row['name'];?>">
                            </td>
                            <td>
                                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];?>">
                            </td>
                            <td>
                                <input type="text" name="user" class="form-control" value="<?php echo $row['user'];?>">
                            </td>
                            <td>
                                <input type="text" name="pass" class="form-control" value="<?php echo $row['pass'];?>">
                            </td>
                            <td>
                                <input type="text" name="address" class="form-control" value="<?php echo $row['address'];?>">
                            </td>
                            <td style="display:flex;">
                                <button class="btn btn-success" type="submit" name="update" value="user">Update</button>
                                <?php 
                                    if($row['userType']=='admin'){ continue;}
                                ?>
                                <a href="index.php?id=<?php echo $row['id'];?>&name=delete" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    </form>
            <?php
                }
            } else {
                echo '<tr><th colspan="5" class="text-center">No Records Found</th></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once('inc/footer.php'); ?>