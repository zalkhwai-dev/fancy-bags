    
<?php
session_start();

$conn = new mysqli('localhost', 'root', 'root', 'bagstoredatabase');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['bag_id'])) {
    $bag_id = $_POST['bag_id'];

    $stmt = $conn->prepare("DELETE FROM bag WHERE bag_id = ?");
    $stmt->bind_param("i", $bag_id);

    if ($stmt->execute()) {
        header("Location: bags_collection.php");
        exit();
    } else {
        echo "Error deleting bag: " . $conn->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM bag";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <header>
        <h1> Fancy Bags - Shop Bags </h1>
        <nav>
            <ul>
                 <li><a href="index.html">Home</a></li>
                 <li><a href="bags_collection.php">Shop Bags</a></li>
                 <li><a href="about_us.php">Who We Are</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
        </nav>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Fancy Bags - Shop Bags</title>
    <link rel="stylesheet" href="css/styles2.css">

<style>
  .button {
        background-color: #d4af37;
        color: white;
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 6px;
        font-size: 1.1em;
        font-weight: bold;
        transition: background-color 0.3s ease;
      }

      .button:hover {
        background-color: #e67e22;
      }

</style>
</head>

    </header>
    
    <div class="add-bag-container">

        <a href="add_bag.php" class="button">Add New Bag</a>


    </div>
    
    <section class="catalog">
        <h2>Our Collection of Bags</h2>
        <div class="bag-collection">
            <?php
            $conn = new mysqli('localhost', 'root', 'root', 'bagstoredatabase');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM bag";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='bag'>";
echo "<img src='" . $row['image'] . "' alt='Image of a bag " . $row['name'] . "'>";

                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p><strong>Type:</strong> " . $row['category'] . "</p>";
                    echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
                    
                    // Modified View Details button with bag_id as a GET parameter.
echo "<button class='view-details-button' onclick='showBagDetails(" . json_encode($row) . ")'>View Details</button>";
                    
                    // Delete Book button (opens a confirmation modal)
                    echo "<button type='button' class='delete-button' onclick='openModal(" . $row['bag_id'] . ")'>delete bag</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No bags available at the moment.</p>";
            }

            $conn->close();
            ?>
        </div>
    </section>
    
    <footer>
        <p>&copy; 2025 Fancy Bags. All rights reserved.</p>
    </footer>

<form id="deleteForm" action="bags_collection.php" method="POST" style="display:none;">
        <input type="hidden" name="bag_id" id="deleteBagId">
    </form>

    <div class="modal-overlay" id="confirmModal">
        <div class="modal-content">
            <h3>Confirm Deletion</h3>
            <p>Do you really want to remove this bag from your collection?</p>
            <div class="modal-buttons">
                <button class="remove-button" onclick="confirmDelete()">Yes remove the bag</button>
                <button class="cancel-button" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
<!-- Modal to show bag info -->
<div id="bagModal" class="modal-overlay" style="display: none;">
  <div class="modal-content">
    <h3 id="modalName"></h3>
    <p><strong>Brand:</strong> <span id="modalBrand"></span></p>
    <p><strong>Category:</strong> <span id="modalCategory"></span></p>
    <p><strong>Description:</strong> <span id="modalDescription"></span></p>
    <p><strong>Price:</strong> $<span id="modalPrice"></span></p>
    <img id="modalImage" src="" alt="Bag Image" style="max-width: 100%; height: auto;" />
    <br><br>
<button onclick="closeBagModal()">Close</button>
<button onclick="goToEditPage()">Update Info</button>
  </div>
</div>

<script>
let currentBagId = null;

  function showBagDetails(bag) {
  currentBagId = bag.bag_id;
    document.getElementById('modalName').textContent = bag.name;
    document.getElementById('modalBrand').textContent = bag.brand;
    document.getElementById('modalCategory').textContent = bag.category;
    document.getElementById('modalDescription').textContent = bag.description;
    document.getElementById('modalPrice').textContent = bag.price;
    document.getElementById('modalImage').src = bag.image;

    document.getElementById('bagModal').style.display = 'block';
  }


  function closeBagModal() {
    document.getElementById('bagModal').style.display = 'none';
  }

  function closeConfirmModal() {
    document.getElementById('confirmModal').style.display = 'none';
  }
function goToEditPage() {
  if (currentBagId !== null) {
    window.location.href = "view_bag.php?bag_id=" + currentBagId;
  }
}

</script>
    <script src="js/collection.js"></script>
</body>
</html>
