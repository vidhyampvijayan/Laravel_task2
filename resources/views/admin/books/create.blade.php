<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Responsive Admin Dashboard | CodingLab</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .home-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
         
        }
        .home-content form {
            width: 80%;
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .home-content form div {
            margin-bottom: 10px;
        }
        .home-content form label {
            font-weight: bold;
        }
        .home-content form input[type="text"],
        .home-content form textarea,
        .home-content form input[type="number"],
        .home-content form select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .home-content form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .home-content form button:hover {
            background-color: #45a049;
        }
        .alert-success{
            color:green;
        }
        .logout-dropdown {
    display: none;
    position: absolute;
    top: 50px; /* Adjust as needed */
    right: 0;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ccc;
    z-index: 100;
}

.logout-dropdown a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
}

.logout-dropdown a:hover {
    background-color: #f5f5f5;
}


    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxl-c-plus-plus'></i>
        <span class="logo_name">Book cart</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ route('dashboard') }}" >
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.books.create') }}">
                <i class='bx bx-box'></i>
                <span class="links_name">Add books</span>
            </a>
        </li>
    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Dashboard</span>
        </div>
        <div class="profile-details">
    <img src="{{ asset('assets/images/profile.jpeg')}}" alt="">
    <span class="admin_name">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @else
            <div class="alert alert-success">
                Admin
            </div>
        @endif
    </span>
    <i class='bx bx-chevron-down' id="dropdown-arrow"></i>
    <div class="logout-dropdown" id="logout-dropdown">
        <a href="{{ route('logout') }}">Logout</a>
    </div>
</div>

    </nav>

   
    <div class="home-content">
        <br><br>
    <div  id="message">
    </div> 
        <h1>Add Book</h1>
        <form id="addBookForm" action="{{ route('admin.books.store') }}"  method="POST">
            @csrf
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div>
                <label for="description">Short Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Available">Available</option>
                    <option value="Not Available">Not Available</option>
                </select>
            </div>
            <button type="button" onclick="addBook()">Add Book</button>
        </form>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dropdown-arrow').click(function() {
            $('#logout-dropdown').toggle();
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('#dropdown-arrow').length && !$(e.target).closest('#logout-dropdown').length) {
                $('#logout-dropdown').hide();
            }
        });

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }

       
        window.addBook = function() {
            var formData = new FormData(document.getElementById('addBookForm'));

            $.ajax({
                url: $('#addBookForm').attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#message').html('<div class="alert alert-success">'+response.message+'</div>');
                    $('#addBookForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
</body>
</html>
