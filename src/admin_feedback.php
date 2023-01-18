<?php
    include_once 'admin_nav.php';
    require_once 'includes/functions.inc.php';
    isAdmin();
?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col">
                <h2 class="border border-2 border-dark text-danger text-center">Feedback</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-3">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Comment</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        <?php

                            require_once 'includes/dbh.inc.php';
                            require_once 'includes/functions.inc.php';

                            // Retrieve feedback
                            $feedbacks = displayFeedback($conn);
                            foreach($feedbacks as $feedback) {
                            ?>
                        <tr class="align-middle text-center">
                            <th scope="row"><?php echo $feedback['id']; ?></th>
                            <td><?php echo $feedback['customer_name']; ?></td>
                            <td><?php echo $feedback['customer_email']; ?></td>
                            <td><?php echo $feedback['customer_comment']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php'
?>