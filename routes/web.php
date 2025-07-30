<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContrller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ShopPageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SellerPaymetnController;
use App\Http\Controllers\SellerMessageController;
// Admin      ////////////////////////

Route::get('login', [UserContrller::class, 'login'])->name('login');
Route::get('Registar', [UserContrller::class, 'Registar'])->name('Registar');
Route::get('logout', [UserContrller::class, 'logout'])->name('logout');
Route::post('/register', [UserContrller::class, 'store'])->name('register.store');
Route::post('loginS', [UserContrller::class, 'loginChek'])->name('login.submit');
Route::get('AdminPanal', [AdminController::class, 'AdminPanal'])->name('AdminPanal');
Route::get('AdminProducts', [ProductsController::class, 'AdminProductsF'])->name('AdminProducts');
Route::post('ProductsAddAdmin', [ProductsController::class, 'ProductsAddAdmin'])->name('productStoreAdmin');
Route::delete('/delete-product/{id}', [ProductsController::class, 'delete'])->name('productDeleteAdmin');
Route::get('/AdminProductView/{id}', [ProductsController::class, 'view'])->name('AdminProductView');
Route::get('/AdminProductEid/{id}', [ProductsController::class, 'AdminProductEid'])->name('AdminProductEid');
Route::get('/productupdateAdmin/{id}', [ProductsController::class, 'productupdateAdmin'])->name('productupdateAdmin');
Route::put('/AdminUpdateForm/{id}', [ProductsController::class, 'update'])->name('AdminProductUpdate');
Route::get('/admin/products/search', [ProductsController::class, 'search'])->name('admin.products.search');
Route::post('/product/update/{id}', [ProductsController::class, 'updateProduct'])->name('product.update');





// Seller      ///////////////////////////////////

Route::get('SellerPanal', [SellerController::class, 'SellerPanal'])->name('SellerPanal');
Route::get('SellerProducts', [ProductsController::class, 'SellerProducts'])->name('SellerProducts');
Route::get('SellerOrders', [SellerOrderController::class, 'SellerOrders'])->name('SellerOrders');
Route::get('SellerComeleteOrders', [SellerOrderController::class, 'SellerComeleteOrders'])->name('SellerComeleteOrders');
Route::get('SellerUnComeleteOrders', [SellerOrderController::class, 'SellerUnComeleteOrders'])->name('SellerUnComeleteOrders');
Route::get('SellerpaidOrders', [SellerOrderController::class, 'SellerpaidOrders'])->name('SellerpaidOrders');
Route::post('/order/mark-shipped', [SellerOrderController::class, 'markAsShipped'])->name('markAsShipped');
Route::get('Viewproductbtn/{id}', [SellerOrderController::class, 'Viewproductbtn'])->name('SellletViewOrder');
Route::get('asseing_shiper/{id}', [SellerOrderController::class, 'asseing_shiper'])->name('asseing_shiper');
Route::post('/submit-tracking', [SellerOrderController::class, 'submitTracking'])->name('submit.tracking');
Route::get('putAction/{id}', [SellerOrderController::class, 'putAction'])->name('putAction');
Route::post('updateOrderStatus', [SellerOrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');
Route::post('/update-status', [SellerOrderController::class, 'updateStatus'])->name('updatestatus');
Route::get('/seller/chart-data', [SellerOrderController::class, 'getChartData'])->name('seller.chart.data');
Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');
Route::get('SellerCustomer', [CustomerController::class, 'SellerCustomer'])->name('SellerCustomer.view');
Route::get('/seller/customers/search', [CustomerController::class, 'searchCustomers'])->name('seller.customers.search');
Route::get('customerOrderview/{id}', [CustomerController::class, 'customerOrderview'])->name('customerOrderview');
Route::post('/SendMailTeacher', [SellerOrderController::class, 'SendMailTeacherF'])->name('send.mail');


// Selle Payment Method    ////////////////////

Route::get('SellerPaymentPage', [SellerPaymetnController::class, 'SellerPaymentPage'])->name('SellerPaymentPage.view');
Route::post('/seller/payment-method/store', [SellerPaymetnController::class, 'store'])->name('seller.payment_method.store');
Route::delete('/paymentDelete/{id}', [SellerPaymetnController::class, 'paymentDelete'])->name('paymentDelete');
Route::get('/updatePaymentMethodbtn/{id}', [SellerPaymetnController::class, 'updatePaymentMethodbtn'])->name('updatePaymentMethodbtn');
Route::put('/pageupdate/{id}', [SellerPaymetnController::class, 'pageupdate'])->name('pageupdate');




// Website      //////////////////////////////
Route::get('Click_Kard.com', [WebsiteController::class, 'Click_Kard'])->name('Click_Kard.view');
Route::get('Shop.com', [ShopPageController::class, 'Shop'])->name('Shop.view');
Route::post('/add-to-cart', [ShopPageController::class, 'addToCart'])->name('add.to.cart');
Route::get('/search-products', [ShopPageController::class, 'search'])->name('search.products');
Route::get('/SellectCardPage', [ShopPageController::class, 'SellectCardPage'])->name('SellectCardPage.products');
Route::post('/update-cart', [ShopPageController::class, 'updateQuantity'])->name('cart.update');
Route::post('/remove-cart', [ShopPageController::class, 'removeFromCart'])->name('remove.from.cart');
Route::get('/checkout-verify', [ShopPageController::class, 'verify'])->name('checkout.verify');
Route::get('/checkout', [ShopPageController::class, 'show'])->name('checkout');
Route::post('/place.order/{id}', [ShopPageController::class, 'Orderplace'])->name('place.order');
Route::get('/PaymentProssess/{id}', [YourController::class, 'show'])->name('PaymentProssess');



///  Selller Payment Panal      ///////////////////////////////////
Route::post('/paymentPage', [PaymentController::class, 'paymentPage'])->name('submitPayment');
Route::get('/OderPage', [OrderController::class, 'OderPage'])->name('OderPage');
Route::post('/orders/{order}/send-message', [OrderController::class, 'sendMessage'])->name('orders.send-message');




////// Seller Messages Panal


Route::get('/SellerMessagePanal', [SellerMessageController::class, 'SellerMessagePanal'])->name('SellerMessagePanal.view');
Route::get('MessageViewSeller/{id}', [SellerMessageController::class, 'MessageViewSeller'])->name('MessageViewSeller');