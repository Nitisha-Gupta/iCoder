<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
    function showLoginForm() {
        var modal = document.getElementById("loginModal");
        modal.style.display = "block";
    }

    function closeLoginForm() {
        var modal = document.getElementById("loginModal");
        modal.style.display = "none";
    }

    function login() {
        var enteredUsername = document.getElementById("username").value;
        var enteredPassword = document.getElementById("password").value;


        var secondUsername = "admin";
        var secondPassword = "password123"; 

        if (enteredUsername === secondUsername && enteredPassword === secondPassword) {
            window.location.href = "admin.php";
        } else {
            alert("Invalid username or password. Please try again.");
        }

        closeLoginForm();
    }
    </script>

</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <a class="navbar-brand" href="#">Logo</a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
            <!-- Search Form -->
            <form class="form-inline ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- added -->
    <!-- <div style="margin-top: 20px;"></div>  -->

    <div class="container">
        <h1 class="mt-5">Welcome to Our Resource Sharing Platform</h1>
        <p>Share and discover resources with ease.</p>

        <!-- Image -->
        <!-- <img src="" alt="Image" class="img-fluid"><br><br> -->

        <form action="upload.php" method="POST" enctype="multipart/form-data" class="form">
            <a href="viewfiles.php" class="btn btn-primary">Explore</a>
        </form>

        <button class="btn btn-primary mt-3" onclick="showLoginForm();">Go to Admin Page</button>
        
        <!-- Add space here -->
        <div style="margin-top: 20px;"></div>

        <!-- Modal for the login form -->
        <div id="loginModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <span class="close" onclick="closeLoginForm()">&times;</span>
                    <h2 class="modal-title">Admin Login</h2>
                    <form onsubmit="login(); return false;">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" class="form-control" required>
                        </div>

                        <input type="submit" value="Login" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <br><br><br><br><br><br><br><br><br><br><footer class="bg-light text-center py-3">
        <p>&copy; 2023 Website Name. All rights reserved.</p>
    </footer>
    
    <!-- Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
