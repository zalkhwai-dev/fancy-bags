<?php
$conn = new mysqli("localhost", "root", "root", "bagstoredatabase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bag_id = $_GET['bag_id'] ?? null;
$message = '';
$bag = [
    'bag_id' => '',
    'name' => '',
    'brand' => '',
    'category' => '',
    'description' => '',
    'price' => '',
    'image' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bag_id = $_POST['bag_id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("UPDATE bag SET name=?, brand=?, category=?, description=?, price=?, image=? WHERE bag_id=?");
    $stmt->bind_param("ssssdsi", $name, $brand, $category, $description, $price, $image, $bag_id);

    if ($stmt->execute()) {
        $message = "Bag updated successfully!";
    } else {
        $message = "Error updating bag: " . $conn->error;
    }
    $stmt->close();
}

if ($bag_id) {
    $stmt = $conn->prepare("SELECT * FROM bag WHERE bag_id = ?");
    $stmt->bind_param("i", $bag_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $bag = $result->fetch_assoc();
    } else {
        echo "<p>Bag not found.</p>";
        exit;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bag Information</title>
 <style>
     {
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
</head>
<body>
  <div class="form-container">
    <h2>Bag Details</h2>

    <?php if (!empty($message)) { echo '<p class="message">' . htmlspecialchars($message) . '</p>'; } ?>

    <form action="view_bag.php?bag_id=<?php echo htmlspecialchars($bag_id); ?>" method="POST">
      <input type="hidden" name="bag_id" value="<?php echo htmlspecialchars($bag['bag_id']); ?>">

      <div class="form-group">
        <label for="name">Bag Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($bag['name']); ?>" required>
      </div>

      <div class="form-group">
        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($bag['brand']); ?>" required>
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
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($bag['description']); ?></textarea>
      </div>

      <div class="form-group">
        <label for="price">Price ($):</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($bag['price']); ?>" required>
      </div>

      <div class="form-group">
        <label for="image">Image Path:</label>
        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($bag['image']); ?>" required>
      </div>

      <button type="submit" class="submit-button">Update Bag</button>
    </form>
  </div>
</body>
</html>
