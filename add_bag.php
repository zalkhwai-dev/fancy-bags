
   <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name        = $_POST['name'];
    $brand       = $_POST['brand'];
    $category    = $_POST['category'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $image       = $_POST['image'];

    $conn = new mysqli("localhost", "root", "root", "bagstoredatabase");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO bag (name, brand, category, description, price, image)
                            VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssds", $name, $brand, $category, $description, $price, $image);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: bags_collection.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fancy Bags - Add a bag</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fffafc;
      color: #333;
    }

    header {
      background-color: #e2b4c3;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .form-container {
      max-width: 600px;
      margin: 40px auto;
      background: #fceef4;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 28px;
      font-weight: bold;
      color: #a04e69;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    .note {
      font-size: 12px;
      color: #777;
      margin-top: 4px;
    }

    .submit-button {
      background-color: #d4af37;
      color: white;
      padding: 12px 25px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      font-weight: bold;
    }

    .submit-button:hover {
      background-color: #e67e22;
    }

    footer {
      background-color: #e2b4c3;
      text-align: center;
      padding: 20px;
      color: white;
      margin-top: 40px;
    }
  </style>

<body>
    <div class="form-container">
        <h2>Add a bag</h2>
        <form action="add_bag.php" method="POST">
            <div class="form-group">
<?php
$bag = ['name' => '', 'category' => '', 'description' => '', 'price' => '', 'image' => ''];
?>

                <label for="name">Bag Name:</label>
<input type="text" id="name" name="name" value="<?php echo ($bag['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand:</label>
  <input type="text" id="brand" name="brand" placeholder="e.g. Gucci, Prada" required />
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Handbag" <?php if ($bag['category'] == 'Handbag') echo 'selected'; ?>>Handbag</option>
                    <option value="Crossbody" <?php if ($bag['category'] == 'Crossbody') echo 'selected'; ?>>Crossbody</option>
                    <option value="Backpack" <?php if ($bag['category'] == 'Backpack') echo 'selected'; ?>>Backpack</option>
                    <option value="Tote" <?php if ($bag['category'] == 'Tote') echo 'selected'; ?>>Tote</option>
                    <option value="Clutch" <?php if ($bag['category'] == 'Clutch') echo 'selected'; ?>>Clutch</option>
                    <option value="Shoulder Bag" <?php if ($bag['category'] == 'Shoulder Bag') echo 'selected'; ?>>Shoulder Bag</option>
                    <option value="Other" <?php if ($bag['category'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Details of the Bag:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">The Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="image">Image URL:</label>
                <input type="text" id="image" name="image" placeholder="e.g. images/handbag.jpg">
                <small class="note">Provide the image URL.</small>

            </div>

            <button type="submit" class="submit-button">Add Bag</button>
        </form>
    </div>
</body>
</html>
