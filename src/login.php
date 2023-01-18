<?php
include_once 'header.php';
?>
  
  <div class="container">
    <?php
    if (isset($_GET["error"])){
      if ($_GET["error"] == "none"){
        echo "
            <div id='alert' class='alert alert-success alert-dismissible fade show mt-3' role='alert'>
                <h6 class='text-center lead'>Account created.</h6>
                <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
            </div>
        ";
      }
    }
    ?>
        <div class="row mt-5">
            <div class="col-lg-4 bg-white m-auto rounded-top border-top border-3 border-success">

            <?php
            if (isset($_GET["error"])){
              if ($_GET["error"] == "wrongLogin"){
                echo "
                    <div id='alert' class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                        <h6 class='text-center lead'>Account does not exist!</h6>
                        <h6 class='text-center lead'>Please create an account.</h6>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                    </div>
                ";
              }
            }
            if (isset($_GET["error"])){
              if ($_GET["error"] == "wrongPassword"){
                echo "
                    <div id='alert' class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                        <h6 class='text-center lead'>Wrong Password!</h6>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                    </div>
                ";
              }
            }
            ?>

                <h2 class="text-center pt-3">Login To Buy</h2>
                <form class="needs-validation" action="includes/login.inc.php" method="post" novalidate>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                      <div class="invalid-feedback">Please enter username</div>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      <input type="password" class="form-control" name="pwd" placeholder="Enter Password" required>
                      <div class="invalid-feedback">Please enter password</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-success mb-3">Login</button>
                        <p class="text-center">
                            Does not have an account ? <a href="signup.php">Register here</a>
                        </p>
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