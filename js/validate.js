function validateForm() {
  var errors = [];
  var name = document.getElementById('name').value.trim();
  var email = document.getElementById('email').value.trim();
  var message = document.getElementById('message').value.trim();

  if (name === "") {
    errors.push("Name is required.");
  }

  if (email === "") {
    errors.push("Email is required.");
  } else {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      errors.push("Invalid email format.");
    }
  }

  if (message === "") {
    errors.push("Message is required.");
  }

  if (errors.length > 0) {
    alert("Please fix the following errors:\n" + errors.join("\n"));
    return false;
  }

  return true;
}
