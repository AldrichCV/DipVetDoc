<body class="index-page">
<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

<a href="{{ url('HomePage') }}" class="logo d-flex align-items-center me-auto me-xl-0">
  <!-- Logo Image -->
  <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Dipvet Logo" style="height: 40px; width: auto; margin-right: 10px;">
  
  <!-- Site Name -->
  <h1 class="sitename mb-0" style="font-size: 1.5rem;">Dipolog Veterinary Doctors</h1>
</a>

<nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('home') }}#who-we-are">About</a></li>
    <li><a href="{{ route('home') }}#our-clinic">Clinic</a></li>
    <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
    <li><a href="{{ route('home') }}#Contact">Reviews</a></li>

<button
  type="button"
  onclick="window.location.href='{{ route('login') }}'"
  class="btn-custom"
>
  Login
</button>

      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>

<style>
  /* Image size and spacing */
  .img-xs {
    width: 60px;
    height: 60px;
    margin-left: 10px; /* Space to the left */
    margin-right: 10px; /* Space to the right */
    border-radius: 50%; /* Perfectly rounded */
  }

  /* Button styles */
.btn-custom {
    background-color: #0d47a1;
    border-color: #0d47a1;
    color: white; /* Readable text */
    border-radius: 30px; /* Adjust as needed */
    padding: 0.5rem 1.5rem; /* optional: match previous py-2 px-6 */
    font-weight: 600; /* optional: match font-semibold */
    transition: all 0.3s ease-in-out; /* smooth hover transition */
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1); /* subtle shadow */
  }

  .btn-custom:hover {
    background-color: #ffffff; /* White on hover */
    border-color: #ffffff;
    color: #0d47a1; /* Dark text on hover */
    transform: scale(1.05); /* subtle scale effect on hover */
    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* stronger shadow on hover */
  }
</style>

<script>
  document.querySelector('a[href="#Home"]').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default jump
    window.scrollTo({
      top: 0,
      behavior: 'smooth' // Smooth scroll effect
    });
  });
</script>
