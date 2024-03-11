<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .sidebar {
          
        }
        .nav-links {
         
        }
        .profile-details {
      
            position: relative;
        }
        .logout-dropdown {
            display: none;
            position: absolute;
            top: 100%;
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
            <a href="#" class="active">
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
        <div class="profile-details" id="profileDetails">
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
            <i class='bx bx-chevron-down arrow-down'></i>
            <div class="logout-dropdown" id="logoutDropdown">
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>
    <div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Books</div>
                <div class="number">{{ \App\Models\Book::count() }}</div>
            </div>
        </div>
    </div>
</div>

</section>

<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
            sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
        } else {
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }

 
    let arrowDown = document.querySelector(".arrow-down");
    let logoutDropdown = document.getElementById("logoutDropdown");
    arrowDown.onclick = function() {
        logoutDropdown.style.display = (logoutDropdown.style.display === "none") ? "block" : "none";
    }
</script>
</body>
</html>
