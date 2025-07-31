@include('SellerHeader')

<?php
$dataPoints = array();
$index = 1;

foreach($graphOrders as $order) {

    if ($order->product) {
        $dataPoints[] = [
            "x" => $index++,
            "y" => (float)$order->product->Price * $order->quantity
        ];
    }
}
?>
<div class="header">
    <button class="menu-toggle"><i class="fas fa-bars"></i></button>
    <div class="logo">
        <span>Seller Dashboard</span>
    </div>
    <div class="profile">
      <div class="user">

        <img src="{{asset('storage/'.Auth::user()->image_path)}}" alt="User" class="user-avatar">
        <div class="user-info">
          <span class="name">{{Auth::user()->name}}</span>
          <span class="role">{{Auth::user()->role}}</span>
        </div>
      </div>
    </div>
</div>

<div class="main-content">
    <div class="page-header">
      <div class="header-content">
       <strong><p class="welcome-message">Welcome back, {{Auth::user()->name}}! Here's what's happening with your store today.</p></strong>        
      </div>
      <div class="breadcrumb">
      </div>
    </div>
    
    <div class="stats-grid">
      <div class="stat-card">
        <div class="icon primary">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="info">
          <h3>Total Orders</h3>
          <p class="stat-value">{{ number_format($gettotalOrders) }}</p>
          <div class="progress-container">
            <div class="progress-bar" style="width: 72%; background: #4e73df;"></div>
          </div>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="icon success">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="info">
          <h3>Total Revenue</h3>
          <p class="stat-value">${{ number_format($Revenue) }}</p>
          <div class="progress-container">
            <div class="progress-bar" style="width: 65%; background: #1cc88a;"></div>
          </div>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="icon warning">
          <i class="fas fa-users"></i>
        </div>
        <div class="info">
          <h3>Customers</h3>
          <p class="stat-value">{{ number_format($totalcustamers) }}</p>
          <div class="progress-container">
            <div class="progress-bar" style="width: 58%; background: #f6c23e;"></div>
          </div>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="icon danger">
          <i class="fas fa-box-open"></i>
        </div>
        <div class="info">
          <h3>Products</h3>
          <p class="stat-value">{{ number_format($gettotalProducts) }}</p>
          <div class="progress-container">
            <div class="progress-bar" style="width: 45%; background: #e74a3b;"></div>
          </div>
        </div>
      </div>
    </div>
    
<div class="content-row">
  <div class="card wide chart-card">
    <div class="card-header">
      <h2>Revenue Analytics</h2>
      <div class="header-actions">

        
      </div>
    </div>
    <div class="chart-container">
      <div id="stylishChart" style="height: 380px; width: 100%;"></div>
    </div>
    <div class="chart-footer">
      <div class="chart-legend">
        <div class="legend-item">
          <span class="legend-color" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></span>
          <span class="legend-label">Revenue</span>
        </div>
        <div class="legend-item">
          <span class="legend-color" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"></span>
          <span class="legend-label">Orders</span>
        </div>
      </div>
      <div class="chart-summary">
        <div class="summary-item">
          <span class="summary-value">${{ number_format($Revenue) }}</span>
          <span class="summary-label">Total Revenue</span>
        </div>
        <div class="summary-item">
          <span class="summary-value">{{ number_format($gettotalOrders) }}</span>
          <span class="summary-label">Total Orders</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add these CDN links in your head -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

  const revenueData = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
  
  const amounts = revenueData.map(item => item.y);
  
  // Create stylish chart
  const options = {
    series: [{
      name: 'Revenue',
      data: amounts,
      color: '#667eea'
    }],
    chart: {
      type: 'area',
      height: 350,
      toolbar: {
        show: true,
        tools: {
          download: true,
          selection: true,
          zoom: true,
          zoomin: true,
          zoomout: true,
          pan: true,
          reset: true
        }
      },
      animations: {
        enabled: true,
        easing: 'easeinout',
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350
        }
      }
    },
    stroke: {
      curve: 'smooth',
      width: 3,
      colors: ['#667eea']
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.3,
        stops: [0, 90, 100]
      }
    },
    dataLabels: {
      enabled: false
    },
    markers: {
      size: 5,
      colors: ['#667eea'],
      strokeColors: '#fff',
      strokeWidth: 2,
      hover: {
        size: 7
      }
    },
    xaxis: {
   
      labels: {
        style: {
          colors: '#6b7280',
          fontSize: '12px'
        }
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      labels: {
        formatter: function(value) {
          return '$' + value.toLocaleString();
        },
        style: {
          colors: '#6b7280',
          fontSize: '12px'
        }
      }
    },
    grid: {
      borderColor: '#f3f4f6',
      strokeDashArray: 4,
      padding: {
        top: 20,
        right: 20,
        bottom: 0,
        left: 20
      }
    },
    tooltip: {
      y: {
        formatter: function(value) {
          return '$' + value.toLocaleString()
        }
      },
      style: {
        fontSize: '14px'
      },
      marker: {
        show: true
      }
    }
  };

  const chart = new ApexCharts(document.querySelector("#stylishChart"), options);
  chart.render();

  // Filter buttons functionality
  document.querySelectorAll('.btn-filter').forEach(button => {
    button.addEventListener('click', function() {
      document.querySelectorAll('.btn-filter').forEach(btn => {
        btn.classList.remove('active');
      });
      this.classList.add('active');
      
      // Here you would typically make an AJAX call to get filtered data
      // For demo, we'll just update the chart with sample data
      const filter = this.dataset.filter;
      let newData = [];
      
      if(filter === 'weekly') {
        newData = amounts.slice(0, 7);
      } else if(filter === 'monthly') {
        newData = amounts.slice(0, 30);
      } else {
        newData = amounts;
      }
      
      chart.updateSeries([{
        data: newData
      }]);
    });
  });
});

</script>

  
<style>
/* Add these CSS improvements to your existing styles */
:root {
  --primary: #4e73df;
  --primary-light: rgba(78, 115, 223, 0.1);
  --success: #1cc88a;
  --success-light: rgba(28, 200, 138, 0.1);
  --warning: #f6c23e;
  --warning-light: rgba(246, 194, 62, 0.1);
  --danger: #e74a3b;
  --danger-light: rgba(231, 74, 59, 0.1);
  --dark: #5a5c69;
  --light: #f8f9fc;
  --gray: #dddfeb;
  --gray-dark: #7a7f9a;
}

body {
  font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  background-color: #f5f7fb;
  color: #333;
}

.header {
  background: #fff;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.logo {
  font-weight: 800;
  color: var(--primary);
}
.logo-img {
  height: 30px;
  margin-right: 10px;
}

.profile .user {
  padding: 0.5rem;
  border-radius: 50rem;
  transition: all 0.3s;
}
.profile .user:hover {
  background: var(--primary-light);
}
.user-avatar {
  border: 2px solid var(--primary-light);
}
.notification-badge {
  position: relative;
  margin-right: 1rem;
  cursor: pointer;
}
.badge-count {
  position: absolute;
  top: -5px;
  right: -5px;
  background: var(--danger);
  color: white;
  border-radius: 50%;
  width: 18px;
  height: 18px;
  font-size: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.page-header {
  margin-bottom: 1.5rem;
}
.welcome-message {
  color: var(--gray-dark);
  margin-top: 0.5rem;
}
.breadcrumb {
  font-size: 0.85rem;
}
.breadcrumb .active {
  color: var(--primary);
  font-weight: 600;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}
.stat-card {
  background: #fff;
  border-radius: 0.35rem;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
  padding: 1rem;
  display: flex;
  transition: transform 0.3s, box-shadow 0.3s;
}
.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
}
.stat-card .icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  margin-right: 1rem;
}
.stat-card .icon.primary {
  background: var(--primary-light);
  color: var(--primary);
}
.stat-card .icon.success {
  background: var(--success-light);
  color: var(--success);
}
.stat-card .icon.warning {
  background: var(--warning-light);
  color: var(--warning);
}
.stat-card .icon.danger {
  background: var(--danger-light);
  color: var(--danger);
}
.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0.5rem 0;
}
.stat-change {
  font-size: 0.8rem;
}
.stat-change.positive {
  color: var(--success);
}
.stat-change.negative {
  color: var(--danger);
}
.progress-container {
  height: 4px;
  background: var(--light);
  border-radius: 2px;
  margin: 0.5rem 0;
}
.progress-bar {
  height: 100%;
  border-radius: 2px;
}

.content-row {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}
@media (max-width: 1200px) {
  .content-row {
    grid-template-columns: 1fr;
  }
}

.card {
  background: #fff;
  border-radius: 0.35rem;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
  margin-bottom: 1.5rem;
}
.card.wide {
  grid-column: span 1;
}
.card-header {
  padding: 1rem 1.35rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.card-header h2 {
  font-size: 1.25rem;
  margin: 0;
  color: var(--dark);
}
.action {
  color: var(--primary);
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}
.action:hover {
  text-decoration: underline;
}
.header-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.search-box {
  position: relative;
}
.search-box input {
  padding: 0.375rem 0.75rem 0.375rem 2rem;
  border-radius: 0.35rem;
  border: 1px solid var(--gray);
  font-size: 0.85rem;
  transition: all 0.3s;
}
.search-box input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}
.search-box i {
  position: absolute;
  left: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  color: var(--gray-dark);
}

.chart-card {
  display: flex;
  flex-direction: column;
  width: 1170px;
}
.chart-container {
  padding: 1rem;
  height: 300px;
  position: relative;
}
.chart-footer {
  padding: 1rem;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.chart-legend {
  display: flex;
  gap: 1rem;
}
.legend-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.85rem;
}
.legend-color {
  width: 12px;
  height: 12px;
  border-radius: 3px;
}
.chart-summary {
  display: flex;
  gap: 2rem;
}
.summary-item {
  text-align: right;
}
.summary-value {
  font-size: 1.25rem;
  font-weight: 700;
  display: block;
}
.summary-value.positive {
  color: var(--success);
}
.summary-label {
  font-size: 0.85rem;
  color: var(--gray-dark);
}

.time-filter {
  display: flex;
  gap: 0.5rem;
}
.time-filter button {
  padding: 0.25rem 0.75rem;
  border-radius: 0.35rem;
  border: 1px solid var(--gray);
  background: transparent;
  font-size: 0.75rem;
  cursor: pointer;
  transition: all 0.3s;
}
.time-filter button.active {
  background: var(--primary);
  color: white;
  border-color: var(--primary);
}
.time-filter button:hover:not(.active) {
  background: var(--light);
}
.export-btn {
  padding: 0.25rem 0.75rem;
  border-radius: 0.35rem;
  border: 1px solid var(--gray);
  background: transparent;
  font-size: 0.75rem;
  cursor: pointer;
  margin-left: 1rem;
  transition: all 0.3s;
}
.export-btn:hover {
  background: var(--light);
}

.top-products .product-list {
  padding: 0.5rem;
}
.product-item {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  border-radius: 0.35rem;
  transition: all 0.3s;
}
.product-item:hover {
  background: var(--light);
}
.product-rank {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: var(--primary);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 700;
  margin-right: 1rem;
}
.product-item:nth-child(2) .product-rank {
  background: var(--success);
}
.product-item:nth-child(3) .product-rank {
  background: var(--warning);
}
.product-image {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 0.35rem;
  margin-right: 1rem;
}
.product-info h4 {
  margin: 0;
  font-size: 0.95rem;
  font-weight: 600;
}
.product-info p {
  margin: 0.25rem 0;
  font-size: 0.8rem;
  color: var(--gray-dark);
}
.product-meta {
  display: flex;
  gap: 1rem;
  font-size: 0.75rem;
  color: var(--gray-dark);
}
.product-sales {
  margin-left: auto;
  font-weight: 700;
  color: var(--primary);
}

.recent-orders .table-responsive {
  overflow-x: auto;
}
.orders-table {
  width: 100%;
  border-collapse: collapse;
}
.orders-table th {
  padding: 0.75rem 1rem;
  text-align: left;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--gray-dark);
  background: var(--light);
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}
.orders-table td {
  padding: 1rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  font-size: 0.9rem;
}
.orders-table tr:last-child td {
  border-bottom: none;
}
.orders-table tr:hover td {
  background: var(--light);
}
.customer {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
.customer-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  object-fit: cover;
}
.order-id {
  font-weight: 600;
  color: var(--primary);
}
.date {
  color: var(--gray-dark);
  font-size: 0.85rem;
}
.amount {
  font-weight: 600;
}
.badge {
  display: inline-block;
  padding: 0.35em 0.65em;
  font-size: 0.75em;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
}
.badge.processing {
  color: #fff;
  background-color: var(--warning);
}
.badge.shipped {
  color: #fff;
  background-color: var(--primary);
}
.badge.delivered {
  color: #fff;
  background-color: var(--success);
}
.badge.cancelled {
  color: #fff;
  background-color: var(--danger);
}
.action-buttons {
  display: flex;
  gap: 0.5rem;
}
.btn-view, .btn-more {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s;
}
.btn-view {
  color: var(--primary);
  background: var(--primary-light);
}
.btn-view:hover {
  background: var(--primary);
  color: white;
}
.btn-more {
  color: var(--gray-dark);
}
.btn-more:hover {
  background: var(--light);
}

.table-footer {
  padding: 1rem;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.showing-entries {
  font-size: 0.85rem;
  color: var(--gray-dark);
}
.pagination {
  display: flex;
  gap: 0.25rem;
}
.page-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid var(--gray);
  background: transparent;
  cursor: pointer;
  transition: all 0.3s;
}
.page-btn:hover:not(.active):not(.disabled) {
  background: var(--light);
}
.page-btn.active {
  background: var(--primary);
  color: white;
  border-color: var(--primary);
}
.page-btn.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
