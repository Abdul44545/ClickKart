
@include('AdminHeader')

  <div class="header">
    <button class="menu-toggle"><i class="fas fa-bars"></i></button>
    <div class="logo">Dashboard</div>
    <div class="profile">

   
      <div class="user">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
        <div class="user-info">
          <span class="name">Sarah Johnson</span>
          <span class="role">Administrator</span>
        </div>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="page-header">
      <h1>Dashboard Overview</h1>
      <div class="breadcrumb">
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <i class="fas fa-chevron-right"></i>
        <span>Dashboard</span>
      </div>
    </div>
    
    <div class="stats-grid">
      <div class="stat-card">
        <div class="icon primary">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="info">
          <h3>Total Orders</h3>
          <p>1,245</p>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="icon success">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="info">
          <h3>Total Revenue</h3>
          <p>$34,546</p>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="icon warning">
          <i class="fas fa-users"></i>
        </div>
        <div class="info">
          <h3>New Customers</h3>
          <p>89</p>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="icon danger">
          <i class="fas fa-box-open"></i>
        </div>
        <div class="info">
          <h3>Products</h3>
          <p>356</p>
        </div>
      </div>
    </div>
    
    <div class="card">
      <div class="card-header">
        <h2>Recent Orders</h2>
        <div class="action">View All</div>
      </div>
      <p>Order list table would go here...</p>
    </div>
    
    <div class="card">
      <div class="card-header">
        <h2>Sales Overview</h2>
        <div class="action">View Report</div>
      </div>
      <p>Sales chart would go here...</p>
    </div>
  </div>
