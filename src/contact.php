<?php
    include_once 'header.php';
?>
  
  <div class="container">
  <?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "none"){
                echo "
                    <div id='alert' class='alert alert-info alert-dismissible fade show mt-3' role='alert'>
                        <h5 class='text-center display-6'>Your Feedback has been send.</h5>
                        <p class='text-center lead'>Thanks for the comment.</p>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                    </div>
                ";
            }
        }
    ?>
        <div class="row mt-5">
            <div class="col-lg-4 bg-white m-auto rounded-top border-top border-3 border-primary">
                <h2 class="text-center pt-3">Feedback</h2>
                <form class="needs-validation" action="includes/contact_feedback.inc.php" method="post" novalidate>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="customer_name" placeholder="Enter name" value="<?php if (isset($_SESSION['userID'])){echo $_SESSION['userName'];} ?>" required>
                        <div class="invalid-feedback">Please enter username</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="customer_email" placeholder="Enter email" value="<?php if (isset($_SESSION['userID'])){echo $_SESSION['userEmail'];} ?>" required>
                        <div class="invalid-feedback">Please enter email</div>
                    </div>
                    <div class="input-group mb-3">
                        <textarea class="form-control w-100" placeholder="Leave your comment here!" name="customer_comment" rows=7 required></textarea>
                        <div class="invalid-feedback">Input comment</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary mb-4">Comment</button>
                    </div>
                  </form>
            </div>
        </div>

      </div>

    <script>
      const form = document.querySelector("form");

      form.addEventListener('submit', e =>{
          if (!form.checkValidity()){
              e.preventDefault();
          }
          form.classList.add('was-validated');
      })
    </script>

<?php
include_once 'footer.php';
?>