<?php
//include auth_session.php file on all user panel pages
// include("api/auth_session.php");
// session_start();
include('api/listpendingpayment.php');

 if(!isset($_SESSION["userid"])) {
        echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
        exit;
  }

  if($_SESSION["member_admin"] == 0) {
        echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
        exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, stylesheets, and other head elements -->
    <title>Authorize Payment</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/custom.css"> <!-- Your custom styles -->
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html"><img src="images/logo.png"></a>
        <!-- ... -->
    </nav>

    <!-- Content Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Pending Payments Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Payment By</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Payment Source</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php if (is_array($fetchPending)) {
                                foreach ($fetchPending as $data) { ?>
                                    <tr>
                                        <td><?php echo $data['member_name'] ?? ''; ?></td>
                                        <td><?php echo $data['payment_amount'] ?? ''; ?></td>
                                        <td><?php echo $data['payment_date'] ?? ''; ?></td>
                                        <td><?php echo $data['payment_source'] ?? ''; ?></td>
                                        <td class="d-flex justify-content-end">
                    <form action="api/approvePayment.php" method="POST">
                        <input type="hidden" name="payment_id" value="<?php echo $data['payment_id']; ?>">
                        <input type="hidden" name="username" value="<?php echo $data['member_id'] ?? ''; ?>">
                        <input type="hidden" name="payment_amount" value="<?php echo $data['payment_amount'] ?? ''; ?>">
                        <button class="btn btn-primary">Approve</button>
                    </form>
                </td>
                <td class="d-flex justify-content-end">
                    <form action="api/rejectPayment.php" method="POST">
                        <input type="hidden" name="payment_id" value="<?php echo $data['payment_id']; ?>">
                        <input type="hidden" name="username" value="<?php echo $data['member_id'] ?? ''; ?>">
                        <input type="hidden" name="payment_amount" value="<?php echo $data['payment_amount'] ?? ''; ?>">
                        <button class="btn btn-primary">Reject</button>
                    </form>
                </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5">No pending payments</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pending Contributions Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Pending Contributions
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Pending Amount</th>
                                    <th>Pending Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php if (is_array($fetchOverdue)) {
                        foreach ($fetchOverdue as $data) { ?>
                            <tr>
                                <td><?php echo $data["member_name"] ?? ""; ?></td>
                                <td><?php echo $data["pending_amount"] ?? ""; ?></td>
                                <td><?php echo $data["pending_date"] ?? ""; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="3">No pending payments</td>
                        </tr>
                    <?php } ?>
                            </tbody>
                        </table>
                        <h3>Update pending payments</h3>
                        <form action="api/updatePendingPayments.php" method="POST">
                            <button class="btn btn-primary">Update Pending Payments</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scripts.js"></script> <!-- Your custom scripts -->
</body>
</html>
