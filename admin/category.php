<?php require_once('inc/header.php'); ?>
<?php
    require('core/connection.php');
    // Handle Update and Delete actions
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Update action
        if (isset($_GET['update']) && $_GET['update'] === 'categoryUpdate') {
            // Validate and sanitize inputs
            $id = intval($_GET['id']);
            $name = $conn->real_escape_string($_GET['name']);

            // Perform update query
            $sql = "UPDATE `category` SET `name` = ? WHERE `id` = ?";
            $status = $conn->prepare($sql);
            $status->bind_param("si", $name, $id);

            if ($status->execute()) {
                echo "<script>
                        window.location.href = 'category.php?success=User Update Successfully';
                    </script>";
            } else {
                echo "<script>
                        window.location.href = 'category.php?success=User Update Unsuccessfully';
                    </script>";
            }
            $status->close();
        }

        // Delete action
        if (isset($_GET['name']) && $_GET['name'] === 'delete') {
            $id = intval($_GET['id']);

            // Perform delete query
            $sql = "DELETE FROM `category` WHERE `id` = ?";
            $status = $conn->prepare($sql);
            $status->bind_param("i", $id);

            if ($status->execute()) {
                echo "<script>
                        window.location.href = 'category.php?success=User Deleted Successfully';
                    </script>";
            } else {
                echo "<script>
                        window.location.href = 'category.php?error=User Delete unsuccessfully';
                    </script>";
            }
            $status->close();
        }

        if (isset($_GET['action']) && $_GET['action'] === 'add_category') {
            $categoryName = trim($conn->real_escape_string($_GET['name']));
    
            if (!empty($categoryName)) {
                $sql = "INSERT INTO `category` (`name`) VALUES (?)";
                $status = $conn->prepare($sql);
                $status->bind_param("s", $categoryName);
    
                if ($status->execute()) {
                    echo "<script>
                            window.location.href = 'category.php?success=Category Create Successfully';
                          </script>";
                } else {
                    echo "<script>
                    window.location.href = 'category.php?error=Category Create Unsuccessfully';
                  </script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Category name cannot be empty!');</script>";
            }
        }

    }
    $sql = "SELECT * FROM `category`";
    $result = $conn->query($sql);
?>
<div class="row">
    <div class="container-fluid">
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addCategoryModal">
            Add Category
        </button>
        <div id="addCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 p-0">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" action="" method="GET">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" name="name" id="categoryName" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="action" value="add_category" class="btn btn-success waves-effect waves-light">Add Category</button>
                            </div>                            
                        </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result->num_rows > 0) {
                // Fetch and display data
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <form action="" method="get">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <tr>
                            <td>
                                <input type="text" name="name" class="form-control" value="<?php echo $row['name'];?>">
                            </td>

                            <td style="display:flex;">
                                <button class="btn btn-success" type="submit" name="update" value="categoryUpdate">Update</button>
                                <a href="category.php?id=<?php echo $row['id'];?>&name=delete" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    </form>
            <?php
                }
            } else {
                echo '<tr><th colspan="2" class="text-center">No Records Found</th></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once('inc/footer.php'); ?>