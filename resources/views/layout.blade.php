
<style>
        :root {
            --primary-color: #3ABEF9;
            --secondary-color: #0056b3;
            --card-bg-color: #f7f7f7;
            --card-hover-color: #e0f7ff;
        }

        .jumbotron {
            background-color: var(--primary-color);
            color: white;
            padding: 50px 20px;
            border-bottom: 4px solid var(--secondary-color);
        }

        #gallery {
            padding: 50px 0;
        }

        .pet-card {
            background-color: var(--card-bg-color);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: 0.3s ease;
        }

        .pet-card:hover {
            background-color: var(--card-hover-color);
            transform: translateY(-5px);
        }

        .pet-card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-bottom: 4px solid var(--primary-color);
        }

        .pet-card h5 {
            font-weight: bold;
            color: var(--secondary-color);
            margin: 15px 0;
        }

        .custom-image {
            width: 100%;
            height: 70%;
            object-fit: cover;
            border-radius: 5px;
        }

        #scrollToTopBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #0c71b8;
            color: white;
            border: none;
            outline: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease;
            z-index: 1000;
        }

        #scrollToTopBtn:hover {
            background-color: lightskyblue;
            transform: scale(1.1);
        }

        #scrollToTopBtn i {
            font-size: 20px;
        }
    </style>

    @stack('styles')
</head>
<body>

    @yield('content')

    <!-- Scroll Button -->
    <button id="scrollToTopBtn" class="btn btn-primary">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script>
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");
        window.onscroll = () => {
            scrollToTopBtn.style.display = (document.documentElement.scrollTop > 100) ? "block" : "none";
        };
        scrollToTopBtn.onclick = () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

