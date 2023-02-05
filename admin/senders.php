<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';
require_once "../user/inc/banks.php";

$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);
$ACCOUNTS = mysqli_fetch_all(returnQuery("SELECT * FROM accounts"), MYSQLI_ASSOC);

if (isset($_POST['generate'])) {
  $bank = sanitize($_POST['bank']);
  $account = sanitize($_POST['account']);
  $user = sanitize($_POST['user']);
  $error = sanitize($_POST['error']);

  $notSuccessful = returnQuery("INSERT INTO allowed (user_id, account, bank, error) VALUES ('$user', '$account', '$bank', '$error')");

  if (!$notSuccessful) {
    echo "<script>alert(`Something went wrong. Please try again.`)</script>";
  } else {
    echo "<script>alert(`Configuration set successfully!`)</script>";
  }
}
?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <div class="row row-deck">
      <div class="col-12">
        <form action="" class="w-100" method="post">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="user">User</label>
                <select name="user" class="form-control" id="user">
                  <option value="" selected disabled>Select User</option>
                  <?php foreach ($USERS as $user) : ?>
                    <option value="<?= $user['id']; ?>">
                      <?= $user['fullname']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="account">Allowed Account Number</label>
                <input type="date" class="form-control" name="account" id="account">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="bank">Allowed Bank</label>
                <input type="date" class="form-control" name="bank" id="bank">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="error">Error Message</label>
                <input type="date" class="form-control" name="error" id="error">
              </div>
            </div>
            <div class="col-12">
              <div class="mt-3">
                <button type="submit" name="generate" class="btn btn-primary">Set config</button>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
</main>
<script src="./js/get_recipent.js"></script>
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>