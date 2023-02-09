<?php
require_once '../admin/inc/functions/config.php';

if (!isset($_GET['trx-id'])) header("Location: ./index");
$id = $_GET['trx-id'];
$title = "History - $id";

// Get transaction details
$real_id = explode("-r", $id)[1];

$details = executeQuery("SELECT * FROM transactions WHERE id = $real_id");
$user_id = $details['user_id'];
$user = executeQuery("SELECT * FROM users WHERE id = '$user_id'");

require_once 'inc/header.php';

?>
<!-- END Header -->
<style>
  th {
    max-width: 250px;
    font-weight: 500;
    text-align: left;
    border-right: 1px solid #ccc !important;
  }
</style>

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <h2 class="content-heading">
      <i class="fa fa-angle-right text-muted mr-1"></i> Transactions Details [<?= $id ?>]</h2>
    </h2>

    <div class="row">
      <div class="col-lg-12">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Transaction</h3>
            <button class="btn btn-info btn-sm shadow" id="printBtn">Print Statement</button>
          </div>

          <div class="block-content">
            <!-- All Products Table -->
            <div class="table-responsive">
              <table class="table table-borderless table-striped" style="table-layout: auto !important;">
                <tbody>
                  <tr>
                    <th>Transaction ID</th>
                    <td><?= $id ?></td>
                  </tr>

                  <tr>
                    <th>Account Name</th>
                    <td><?= $user['fullname'] ?></td>
                  </tr>

                  <tr>
                    <th>Account Number</th>
                    <td><?= $details['account_num'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Amount</th>
                    <td><?= $details['amount'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Beneficiary Name</th>
                    <td><?= $details['beneficiary'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Beneficiary Account</th>
                    <td><?= $details['to_user'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Bank Name</th>
                    <td><?= $details['bank_name'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Swift Code</th>
                    <td><?= $details['swift_code'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Transaction Type</th>
                    <td><?= $details['type'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Transaction Kind</th>
                    <td><?= $details['kind'] ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Transaction Date</th>
                    <td><?= date("D d, M Y", strtotime($details['created_at'])) ?? "<i>NULL</i>" ?></td>
                  </tr>

                  <tr>
                    <th>Description</th>
                    <td><?= $details['description'];  ?></td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- END All Products Table -->

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php' ?? "<i>NULL</i>" ?>
<script src="js/get_recipent.js"></script>