<?php
    include_once 'header.php';

    require_once 'includes/functions.inc.php';
    check_login();
?>

<section class="vh-50" style="background-color: #f4f5f7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 px-5 text-center border-end">
                <img src="Assets/profileAvatar.png" alt="Avatar" width="100" class="img-fluid mt-4">
                <h5 class="mt-5"><?php echo $_SESSION["userUID"]; ?></h5>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#modal">
                    <i class="fa fa-edit mb-5 text-center"></i>
                </button>
                <div class="modal fade" id="modal">
                    <div class="modal-dialog dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Edit Profile</h3>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="form" class="needs-validation" action="includes/updateProfile.inc.php" method="post" novalidate>
                                    <input type="hidden" name="customer_id" value="<?php echo $_SESSION["userID"]; ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="customer_name" value="<?php if (isset($_SESSION['userName'])){echo $_SESSION['userName'];} ?>" required>
                                        <label for="name">Name</label>
                                        <div class="invalid-feedback">Please enter your name</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="customer_email" value="<?php if (isset($_SESSION['userEmail'])){echo $_SESSION['userEmail'];} ?>" required>
                                        <label for="name">Email</label>
                                        <div class="invalid-feedback">Please enter your email</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="customer_phone" min="0" value="<?php if (isset($_SESSION['userPhone'])){echo $_SESSION['userPhone'];} ?>" required>
                                        <label for="name">Phone Number</label>
                                        <div class="invalid-feedback">Please enter your phone number</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="customer_address" style="height: 100px" required><?php if (isset($_SESSION['userAddress'])){echo $_SESSION['userAddress'];} ?></textarea>
                                        <label for="name">Address</label>
                                        <div class="invalid-feedback">Please enter your address</div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Name</h6>
                    <p class="text-muted"><?php echo $_SESSION["userName"]; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $_SESSION["userEmail"]; ?></p>
                  </div>
                </div>
                <h6>Extra Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Phone Number</h6>
                    <p class="text-muted"><?php
                    if (isset($_SESSION["userPhone"])){
                        echo $_SESSION["userPhone"];
                    }
                    ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Address</h6>
                    <p class="text-muted"><?php
                    if (isset($_SESSION["userAddress"])){
                        echo $_SESSION["userAddress"];
                    }
                    ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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