<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Store</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
     <style>
        :root {
            --primary-color: #3572EF;
            --secondary-color: #0056b3;
            --light-color: #e9f4fe;
        }
        .navbar {
            background-color: var(--primary-color);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .jumbotron {
            background-color: var(--primary-color);
            color: white;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        footer {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body>



 <!--Pet Store Header -->
<div class="jumbotron text-center" style="background-color: #A7E6FF;">
    <h1 class="display-4">Welcome to Our Pet Store</h1>
    <p class="lead">Find high-quality pet foods, accessories, and toys for your furry friends.</p>
</div>

<!-- Product Section-->
<div class="container my-5">
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">
        <?php
        // Sample product list
        $products = [
            [
                "image" => "assets/images/pt1.jpg",
                "name" => "Prem. Puppy Food",
                "price" => "$25.99",
                "description" => "Nutritious and delicious food for your dog."
            ],
            [
                "image" => "assets/images/pt2.jpg",
                "name" => "Prem. Adult Dog Food",
                "price" => "$25.99",
                "description" => "Nutritious and delicious food for your dog."
            ],
            [
                "image" => "assets/images/pt3.jpg",
                "name" => "Interactive Cat Toy",
                "price" => "$12.99",
                "description" => "Keep your cat active and entertained for hours."
            ],
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
            [
                "image" => "assets/images/pt4.jpg",
                "name" => "Cat Cage",
                "price" => "$45.99",
                "description" => "Spacious and safe cage for your birds."
            ],
            
        ];

        // Render products dynamically
        foreach ($products as $product) {
            echo '
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="' . $product["image"] . '" class="card-img-top img-fluid" alt="' . $product["name"] . '" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">' . $product["name"] . '</h5>
                        <p class="card-text">' . $product["description"] . '</p>
                        <p class="text-primary font-weight-bold">' . $product["price"] . '</p>
                        <button class="btn btn-success btn-block">Add to Cart</button>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

<!<!-- JavaScript Libraries -->  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

