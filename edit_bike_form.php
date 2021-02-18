<?php
require('database.php');

$bike_id = filter_input(INPUT_POST, 'bike_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM bikes
          WHERE bikeID = :bike_id';
$statement = $db->prepare($query);
$statement->bindValue(':bike_id', $bike_id);
$statement->execute();
$bikes = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1>
        <form action="edit_bike.php" method="post" enctype="multipart/form-data"
              id="edit_bike_form">
            <input type="hidden" name="original_image" value="<?php echo $bikes['image']; ?>" />
            <input type="hidden" name="bike_id"
                   value="<?php echo $bikes['bikeID']; ?>">

            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $bikes['categoryID']; ?>">
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $bikes['name']; ?>">
            <br>

            <label>Engine Size:</label>
            <input type="input" name="EngineSize"
                   value="<?php echo $bikes['EngineSize']; ?>">
            <br>

            <label>List Price:</label>
            <input type="input" name="price"
                   value="<?php echo $bikes['price']; ?>">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>            
            <?php if ($bikes['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $bikes['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>