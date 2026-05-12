

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fancy Bags - Contact Us</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
    
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

nav ul {
  list-style: none;
  padding: 0;
  margin: 10px 0 0;
  display: flex;
  justify-content: center;
  gap: 20px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}

nav ul li a:hover {
  text-decoration: underline;
}

.section {
  padding: 40px 20px;
  text-align: center;
  max-width: 600px;
  margin: auto;
}

.contact-form {
  background: #fceef4;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.form-group {
  margin-bottom: 20px;
  text-align: left;
}

label {
  display: block;
  margin-bottom: 6px;
  font-weight: 600;
}

input[type="text"],
input[type="email"],
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

.modern-button {
  background-color: #d4af37;
  color: white;
  padding: 12px 25px;
  font-size: 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.modern-button:hover {
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
    <header>
        <h1>Fancy Bags - Contact Us</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="bags_collection.php">Shop Bags</a></li>
                <li><a href="about_us.php">Who We Are</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
   <section class="section">
      <h2>Get in Touch</h2>
      <div class="contact-form">
        <form id="contactForm" onsubmit="return validateForm();">
          <div class="form-group">
            <label for="name">Your Full Name:</label>
             <input type="text" id="name" name="name" placeholder="e.g. Noor Ali" />

          </div>

          <div class="form-group">

            <label for="email">Your Email Address:</label>
           <input type="email" id="email" name="email" placeholder="e.g. you@example.com" />
          </div>

          <div class="form-group">
            <label for="message">Your Message:</label>
          <textarea id="message" name="message" placeholder="How can we help you?"></textarea>

          </div>
          <button type="submit" class="modern-button">Send Message</button>
        </form>
      </div>
    </section>

    <footer>

      <div class="container">
   

    <footer>
        <p>&copy; 2025 Fancy Bags. All rights reserved.</p>
    </footer>
    <script src="js/validate.js"></script>

</body>
</html>
