<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Register Page</title>
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <style>
    .register-box {
      max-width: 400px;
      margin: 50px auto;
    }
    .register-logo a {
      font-size: 2rem;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">

<div class="container">
  <div class="register-box mx-auto">
    <div class="text-center register-logo mb-4">
      <a href="#"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
      <div class="card-body">
        <p class="text-center">Register a new membership</p>

        <form action="customer/register" method="post">
          <div class="form-group">
            <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
          </div>
          <div class="form-group">
            <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="row align-items-center">
            <div class="col-8">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <div class="col-4 text-right">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>

        <div class="text-center my-3">
          <p>- OR -</p>
          <button class="btn btn-primary btn-block">
            <i class="fab fa-facebook mr-2"></i> Sign up using Facebook
          </button>
          <button class="btn btn-danger btn-block">
            <i class="fab fa-google-plus mr-2"></i> Sign up using Google+
          </button>
        </div>

        <div class="text-center">
          <a href="login.html">I already have a membership</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
