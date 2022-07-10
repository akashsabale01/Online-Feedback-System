<?php include 'inc/header.php' ?>

<?php
// Set vars to empty values
$name = $email = $body = $phoneNo = '';
$nameErr = $emailErr = $bodyErr = $phoneNoErr = '';



// Form submit
if (isset($_POST['name'])) {
  // Validate name
  if (empty($_POST['name'])) {
    $nameErr = 'Name is Required';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'email is Required';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  // Validate body
  if (empty($_POST['body'])) {
    $bodyErr = 'Feedback is Required';
  } else {
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  // Validate Phone Number
  if (empty($_POST['phoneNo']) || !preg_match('/^[0-9]{10}+$/', $_POST['phoneNo'])) {
    $phoneNoErr = 'Phone Number is Required';
  } else {
    $phoneNo = filter_input(INPUT_POST, 'phoneNo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  $date_attended = filter_input(INPUT_POST, 'date_attended', FILTER_SANITIZE_SPECIAL_CHARS);


  if (empty($nameErr) && empty($emailErr) && empty($bodyErr) && empty($phoneNoErr)) {
    echo "phone no-" . $_POST['phoneNo'];
    // Add to database when no errors found
    $sql = "INSERT INTO feedback(name,email,body,date_attended,phoneNo) VALUES ('$name', '$email', '$body','$date_attended','$phoneNo')";

    if (mysqli_query($conn, $sql)) {
      // Success
      header('Location: feedback.php');
    } else {
      // Error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>

<!-- here we display header -->

<img src="img/Amdocs-logo.png" class="img-thumbnail mb-3 rounded-circle" alt="" />
<h2>Feedback</h2>
<p class="lead text-center">Leave feedback for Guess Lecture about Career in IT by Amdocs</p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="name" placeholder="Enter your name" />
    <div class="invalid-feedback">
      <?php echo $nameErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="name@example.com" />
    <div class="invalid-feedback">
      <?php echo $emailErr; ?>
    </div>
  </div>

  <div class="mb-3">
    <label for="phoneNo" class="form-label">Phone Number</label>
    <input type="tel" class="form-control  <?php echo $phoneNoErr ? 'is-invalid' : null; ?>" id="phoneNo" name="phoneNo" placeholder="Enter your Phone Number" />
    <div class="invalid-feedback">
      <?php echo $phoneNoErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="date_attended" class="form-label">Date Attended</label>
    <input type="date" class="form-control" id="date_attended" name="date_attended" value="2020-07-22" />
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null; ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
    <div class="invalid-feedback">
      <?php echo $bodyErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100" />
  </div>
</form>

<!-- Afer form We display footer -->

<?php include 'inc/footer.php' ?>