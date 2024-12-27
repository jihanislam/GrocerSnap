<?php require_once('inc/header.php'); ?>
<?php
    require('core/connection.php');
    // Add New 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
        $productName = trim($conn->real_escape_string($_POST['name']));
        $categoryId = intval($_POST['categoryId']);
        $description = trim($conn->real_escape_string($_POST['des']));
        $price = floatval($_POST['price']);
        $imageName = '';
    
        // Handle image upload
        if (isset($_FILES['imgLink']) && $_FILES['imgLink']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $imageName = basename($_FILES['imgLink']['name']);
            $uploadFile = $uploadDir . $imageName;
    
            if (!move_uploaded_file($_FILES['imgLink']['tmp_name'], $uploadFile)) {
                echo "<script>alert('Failed to upload image');</script>";
            }
        }
    
        // Insert into database
        $sql = "INSERT INTO `products` (`name`, `categoryId`, `des`, `price`, `imgLink`) VALUES (?, ?, ?, ?, ?)";
        $status = $conn->prepare($sql);
        $status->bind_param("sisds", $productName, $categoryId, $description, $price, $imageName);
    
        if ($status->execute()) {
            echo "<script>
                    window.location.href = 'product.php?success=Product added successfully';
                  </script>";
        } else {
            echo "<script>
                    window.location.href = 'product.php?error=Product added Not successfully';
                  </script>";
        }
        $status->close();
    }
    // Delete 
    if (isset($_GET['name']) && $_GET['name'] === 'delete') {
        $id = intval($_GET['id']);

        // Delete query
        $sql = "DELETE FROM `products` WHERE `id` = ?";
        $status = $conn->prepare($sql);
        $status->bind_param("i", $id);

        if ($status->execute()) {
            echo "<script>
                    window.location.href = 'product.php?success=Product Delete successfully';
                  </script>";
        } else {
            echo "<script>
                    window.location.href = 'product.php?error=Product Not Deleted';
                  </script>";
        }
        $status->close();
    }
    // Update 
    if (isset($_GET['update']) && $_GET['update'] === 'productUpdate') {
        // Sanitize and validate inputs
        $id = intval($_GET['id']);
        $name = $conn->real_escape_string($_GET['name']);
        $categoryId = intval($_GET['categoryId']);
        $des = $conn->real_escape_string($_GET['des']);
        $price = $conn->real_escape_string($_GET['price']);
        $imgLink = $conn->real_escape_string($_GET['imgLink']); // Assuming image update is not required

        // Update query
        $sql = "UPDATE `products` 
                SET `name` = ?, `categoryId` = ?, `des` = ?, `price` = ?, `imgLink` = ? 
                WHERE `id` = ?";
        $status = $conn->prepare($sql);
        $status->bind_param("sisssi", $name, $categoryId, $des, $price, $imgLink, $id);

        if ($status->execute()) {
            echo "<script>
                    window.location.href = 'product.php?success=Product Update successfully';
                  </script>";
        } else {
            echo "<script>
                    window.location.href = 'product.php?error=Product Update Unsuccessfully';
                  </script>";
        }
        $status->close();
    }



    $sql = "SELECT p.*, c.name AS category_name FROM products p JOIN category c ON p.categoryId = c.id;";
    $result = $conn->query($sql);
    $csql = "SELECT * FROM category";
    $cResult = $conn->query($csql);
    $categories = [];
        while ($crow = $cResult->fetch_assoc()) {
            $categories[] = $crow;
    }
?>
<div class="row">
    <div class="container-fluid">
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addCategoryModal">
        Add Product
    </button>
    <div id="addCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 p-0">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Select Category</label>
                                <select name="categoryId" id="categoryName" class="form-control">
                                    <?php foreach ($categories as $crow) { ?>
                                        <option value="<?php echo $crow['id']; ?>"><?php echo $crow['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="des" class="form-label">Product Description</label>
                                <textarea name="des" id="des" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Select a image</label>
                                <input type="file" name="imgLink" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="action" value="add_product" class="btn btn-success waves-effect waves-light">Add PRoduct</button>
                        </div>                            
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
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
                        <tr>
                            <td>
                                <input type="text" name="name" class="form-control" value="<?php echo $row['name'];?>">
                            </td>
                            <td>
                                <label class="form-label">
                                    <select name="categoryId" id="categoryName" class="form-control">
                                        <option selected value="<?php echo $row['categoryId'];?>"><?php echo $row['category_name'];?></option>
                                        <?php foreach ($categories as $crow) { ?>
                                            <option value="<?php echo $crow['id']; ?>"><?php echo $crow['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </label>
                            </td>
                            <td>
                                <input type="text" name="des" class="form-control" value="<?php echo $row['des'];?>">
                            </td>
                            <td>
                                <input type="text" name="price" class="form-control" value="<?php echo $row['price'];?>">
                            </td>
                            <td>
                                <input type="hidden" name="imgLink" value="<?php echo $row['imgLink'];?>">
                                <img src="uploads/<?php echo $row['imgLink'];?>" style="width:50px;">
                            </td>

                            <td style="display:flex;">
                                <button class="btn btn-success" type="submit" name="update" value="productUpdate">Update</button>
                                <a href="product.php?id=<?php echo $row['id'];?>&name=delete" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    </form>
            <?php
                }
            } else {
                echo '<tr><th colspan="6" class="text-center">No Records Found</th></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once('inc/footer.php'); ?>