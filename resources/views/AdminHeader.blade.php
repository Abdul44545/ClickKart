<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin Panel')</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --sidebar-bg: #1e293b;
      --sidebar-active: #3b82f6;
      --sidebar-hover: #334155;
      --sidebar-text: #e2e8f0;
      --header-bg: #ffffff;
      --header-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      --content-bg: #f8fafc;
      --card-bg: #ffffff;
      --primary: #3b82f6;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --transition: all 0.3s ease;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    
    body {
      display: flex;
      min-height: 100vh;
      background-color: var(--content-bg);
      color: #1e293b;
    }
    
    /* Sidebar */
    .sidebar {
      width: 280px;
      background-color: var(--sidebar-bg);
      color: var(--sidebar-text);
      position: fixed;
      height: 100vh;
      padding: 20px 0;
      transition: var(--transition);
      z-index: 100;
    }
    
    .sidebar-header {
      padding: 0 20px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 20px;
    }
    
    .sidebar-header h2 {
      font-size: 22px;
      font-weight: 600;
      display: flex;
      align-items: center;
    }
    
    .sidebar-header h2 i {
      margin-right: 10px;
      color: var(--sidebar-active);
    }
    
    .sidebar ul {
      list-style: none;
      padding: 0 10px;
    }
    
    .sidebar ul li {
      margin-bottom: 5px;
      border-radius: 8px;
      overflow: hidden;
    }
    
    .sidebar ul li a {
      color: var(--sidebar-text);
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 12px 15px;
      font-size: 15px;
      transition: var(--transition);
    }
    
    .sidebar ul li a i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
      font-size: 18px;
    }
    
    .sidebar ul li:hover {
      background-color: var(--sidebar-hover);
    }
    
    .sidebar ul li.active {
      background-color: var(--sidebar-active);
    }
    
    .sidebar ul li.active a {
      font-weight: 500;
    }
    
    /* Header */
    .header {
      width: calc(100% - 280px);
      height: 70px;
      background-color: var(--header-bg);
      box-shadow: var(--header-shadow);
      position: fixed;
      left: 280px;
      top: 0;
      display: flex;
      align-items: center;
      padding: 0 30px;
      justify-content: space-between;
      z-index: 99;
      transition: var(--transition);
    }
    
    .header .logo {
      font-size: 20px;
      font-weight: 600;
      color: var(--sidebar-bg);
    }
    
    .header .profile {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    
    .header .profile .notification {
      position: relative;
    }
    
    .header .profile .notification i {
      font-size: 20px;
      color: var(--sidebar-bg);
      cursor: pointer;
    }
    
    .header .profile .notification .badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--danger);
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      font-size: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .header .profile .user {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .header .profile .user img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
    }
    
    .header .profile .user .user-info {
      display: flex;
      flex-direction: column;
    }
    
    .header .profile .user .user-info .name {
      font-size: 14px;
      font-weight: 500;
    }
    
    .header .profile .user .user-info .role {
      font-size: 12px;
      color: #64748b;
    }
    
    /* Main Content */
    .main-content {
      margin-left: 280px;
      margin-top: 70px;
      padding: 25px;
      width: calc(100% - 280px);
      transition: var(--transition);
    }
    
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    
    .page-header h1 {
      font-size: 24px;
      font-weight: 600;
    }
    
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
      color: #64748b;
    }
    
    .breadcrumb a {
      color: var(--primary);
      text-decoration: none;
    }
    
    .breadcrumb i {
      font-size: 12px;
    }
    
    /* Cards */
    .card {
      background-color: var(--card-bg);
      border-radius: 10px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 25px;
    }
    
    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .card-header h2 {
      font-size: 18px;
      font-weight: 500;
    }
    
    .card-header .action {
      color: var(--primary);
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
    }
    
    /* Stats Cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 25px;
    }
    
    .stat-card {
      background-color: var(--card-bg);
      border-radius: 10px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      padding: 20px;
      display: flex;
      align-items: center;
      transition: var(--transition);
    }
    
    .stat-card:hover {
      transform: translateY(-3px);
    }
    
    .stat-card .icon {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      font-size: 20px;
      color: white;
    }
    
    .stat-card .icon.primary {
      background-color: var(--primary);
    }
    
    .stat-card .icon.success {
      background-color: var(--success);
    }
    
    .stat-card .icon.warning {
      background-color: var(--warning);
    }
    
    .stat-card .icon.danger {
      background-color: var(--danger);
    }
    
    .stat-card .info h3 {
      font-size: 14px;
      color: #64748b;
      font-weight: 400;
      margin-bottom: 5px;
    }
    
    .stat-card .info p {
      font-size: 22px;
      font-weight: 600;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
      .sidebar {
        width: 80px;
        overflow: hidden;
      }
      
      .sidebar-header h2 span,
      .sidebar ul li a span {
        display: none;
      }
      
      .sidebar ul li a {
        justify-content: center;
      }
      
      .sidebar ul li a i {
        margin-right: 0;
        font-size: 20px;
      }
      
      .header,
      .main-content {
        width: calc(100% - 80px);
        margin-left: 80px;
      }
    }
    
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      
      .sidebar.active {
        transform: translateX(0);
      }
      
      .header,
      .main-content {
        width: 100%;
        margin-left: 0;
      }
      
      .header .menu-toggle {
        display: block;
      }
    }
    
    /* Toggle Button */
    .menu-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      color: var(--sidebar-bg);
      cursor: pointer;
    }
    
    /* Dark Mode Toggle */
    .theme-toggle {
      display: flex;
      align-items: center;
      gap: 10px;
      background: rgba(0, 0, 0, 0.1);
      border-radius: 20px;
      padding: 5px;
      cursor: pointer;
    }
    
    .theme-toggle .toggle-btn {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: white;
      transition: var(--transition);
    }
    
    /* Dark Mode Styles */
    body.dark-mode {
      --sidebar-bg: #0f172a;
      --sidebar-active: #3b82f6;
      --sidebar-hover: #1e293b;
      --sidebar-text: #e2e8f0;
      --header-bg: #1e293b;
      --header-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
      --content-bg: #0f172a;
      --card-bg: #1e293b;
      color: #e2e8f0;
    }
    
    body.dark-mode .header .logo,
    body.dark-mode .header .profile i,
    body.dark-mode .header .profile .user .user-info .name {
      color: #e2e8f0;
    }
    
    body.dark-mode .header .profile .user .user-info .role {
      color: #94a3b8;
    }
    
    body.dark-mode .breadcrumb {
      color: #94a3b8;
    }
    
    body.dark-mode .theme-toggle {
      background: rgba(255, 255, 255, 0.1);
    }
    
    body.dark-mode .theme-toggle .toggle-btn {
      transform: translateX(24px);
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="sidebar-header">
    <h2><i class="fas fa-cog"></i> <span>Admin Panel</span></h2>
  </div>
  <ul>
    <li class="active">
      <a href="{{ route('AdminPanal') }}">
        <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
      </a>
    </li>

    <li class="{{ request()->routeIs('AdminProducts') ? 'active' : '' }}">
      <a href="{{ route('AdminProducts') }}">
        <i class="fas fa-box-open"></i> <span>Products</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-shopping-cart"></i> <span>Orders</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-users"></i> <span>Customers</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-tags"></i> <span>Categories</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-credit-card"></i> <span>Payments</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-star"></i> <span>Reviews</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-envelope"></i> <span>Messages</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="fas fa-cogs"></i> <span>Settings</span>
      </a>
    </li>

    <li>
      <a href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
      </a>
    </li>
  </ul>
</div>


  <!-- Header -->


  <script>
    // Toggle sidebar on mobile
    document.querySelector('.menu-toggle').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('active');
    });
    
    // Toggle dark mode
    document.getElementById('themeToggle').addEventListener('click', function() {
      document.body.classList.toggle('dark-mode');
      
      // Save preference to localStorage
      const isDarkMode = document.body.classList.contains('dark-mode');
      localStorage.setItem('darkMode', isDarkMode);
    });
    
    // Check for saved theme preference
    if (localStorage.getItem('darkMode') === 'true') {
      document.body.classList.add('dark-mode');
    }
  </script>
</body>
</html>