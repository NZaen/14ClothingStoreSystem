<?php
include_once 'header.php';
?>
  
  <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white m-auto rounded-top border-top border-3 border-success">
            <?php
            if (isset($_GET["error"])){
              if ($_GET["error"] == "invalidUID"){
                echo "
                    <div id='alert' class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                        <h6 class='text-center lead'>Invalid Username Input!</h6>
                        <h6 class='text-center lead'>Please input other username.</h6>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                    </div>
                ";
              }
              if ($_GET["error"] == "passwordNotMatch"){
                echo "
                    <div id='alert' class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                        <h6 class='text-center lead'>Password does not match!</h6>
                        <h6 class='text-center lead'>Please confirm your password.</h6>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                    </div>
                ";
              }
              if ($_GET["error"] == "usernameTaken"){
                echo "
                    <div id='alert' class='alert alert-warning alert-dismissible fade show mt-2' role='alert'>
                        <h6 class='text-center lead'>Username / Email taken!</h6>
                        <h6 class='text-center lead'>Please choose other username.</h6>
                        <button class='btn-close' aria-label='close' data-bs-dismiss='alert'></button>
                    </div>
                ";
              }
            }
            ?>
                <h2 class="text-center pt-3">Signup Now</h2>
                <form class="needs-validation" action="includes/signup.inc.php" method="post" novalidate>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
                      </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter Email" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      <input type="password" class="form-control" name="pwd" placeholder="Enter Password" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      <input type="password" class="form-control" name="pwdRepeat" placeholder="Confirm Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-success mb-3">Register</button>
                        <p class="text-center">
                            Already have an account ? <a href="login.php">Login here</a>
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