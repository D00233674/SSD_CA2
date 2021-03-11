<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get bikes for selected category
$queryRecords = "SELECT * FROM bikes
WHERE categoryID = :category_id
ORDER BY bikeID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$bikes = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php

include('includes/header.php');
?>
<h1>Bike Shop</h1>

<aside>
<!-- display a list of categories -->
<h2>Categories</h2>
<nav>
<ul id="category-list">
<?php foreach ($categories as $category) : ?>
<li class="button"><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of bikes -->
<h2><?php echo $category_name; ?></h2>
<table>
<thead>
<th>Image</th>
<th>Name</th>
<th>Engine Size</th>
<th>Price</th>
<th>Last Service</th>
<th>Delete</th>
<th>Edit</th>
</thead>
<tbody>
<?php foreach ($bikes as $bike) : ?>
<tr>
<td><img src="image_uploads/<?php echo $bike['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $bike['name']; ?></td>
<td><?php echo $bike['engineSize']; ?></td>
<td class="right"><?php echo $bike['price']; ?></td>
<td><?php echo $bike['lastService']; ?></td>
<td><form action="delete_bike.php" method="post"
id="delete_bike_form">
<input type="hidden" name="bike_id"
value="<?php echo $bike['bikeID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $bike['categoryID']; ?>">
<input class="red-button" type="submit" value="Delete">
</form></td>
<td><form action="edit_bike_form.php" method="post"
id="delete_bike_form">
<input type="hidden" name="bike_id"
value="<?php echo $bike['bikeID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $bike['categoryID']; ?>">
<input class="green-button" type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<p class="margin-bottom"><a class="add-button" href="add_bike_form.php">Add Bike</a></p>
<p><a class="manage-button" href="category_list.php">Manage Categories</a></p>
</section>
<?php
include('includes/footer.php');
?>