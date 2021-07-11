<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="token" id="token" value="{{ csrf_token() }}">
    {{-- vue css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<!--favicon-->
   
	<link rel="icon" href=" {{ asset('backend/Agile (looping arrow).png') }}" type="image/png" height="16px" width="16px" />
	<!--plugins-->
	<link href=" {{ asset('backend/assets/plugins/notifications/css/lobibox.min.css') }}" rel="stylesheet"/>
	<link href=" {{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	<link href=" {{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href=" {{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href=" {{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href=" {{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src=" {{ asset('backend/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href=" {{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href=" {{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
	<link href=" {{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href=" {{ asset('backend/assets/css/dark-theme.css') }}" />
	<link rel="stylesheet" href=" {{ asset('backend/assets/css/semi-dark.css') }}" />
	<link rel="stylesheet" href=" {{ asset('backend/assets/css/header-colors.css') }}" />
	<title> Inventory--Management</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
      <div id="app">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true" id="sidbar" v-show="$route.path==='/' || $route.path==='/register' ||$route.path==='/forgot' ? false : true" style="display: none;">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('backend/Agile (looping arrow).png') }}" height="25px" width="25px">
				</div>
				<router-link to="/home">
				<div>
					
					<h4 class="logo-text">Dashboard</h4>
				</div>
				</router-link>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<router-link  to="/pos">
						<img src="{{ asset('backend/pos.png') }}" height="20px" width="20px">
						<div class="menu-title">POS</div>
					</router-link>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<img src="{{ asset('backend/professional employee.png') }}" height="20px" width="20px">
						<div class="menu-title">Employee</div>
					</a>
					<ul>
						<li>
							<router-link to="/store-employee"><i class="bx bx-right-arrow-alt"></i>Add Employee</router-link>
						</li>
						<li>
							<router-link to="/employee"><i class="bx bx-right-arrow-alt"></i>All Employee</router-link>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
					<img src="{{ asset('backend/Teamwork.png') }}" height="20px" width="20px">
						<div class="menu-title">Suppliers</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/store-supplier"><i class="bx bx-right-arrow-alt"></i>Add Supplier</router-link>
						</li>
						<li> 
							<router-link to="/supplier"><i class="bx bx-right-arrow-alt"></i>All Suppliers</router-link>
						</li>
						
					</ul>
				</li>
				
				<li>
					<a href="javascript:;" class="has-arrow">
			<img src="{{ asset('backend/hierarchical structure.png') }}" height="20px" width="20px">
						<div class="menu-title">Category</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/store-category"><i class="bx bx-right-arrow-alt"></i>Add Category</router-link>
						</li>
						<li> 
							<router-link to="/category"><i class="bx bx-right-arrow-alt"></i>All Category</router-link>
						</li>
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
		<img src="{{ asset('backend/5-star product quality.png') }}" height="20px" width="20px">
						<div class="menu-title">Products</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/store-product"><i class="bx bx-right-arrow-alt"></i>Add Product</router-link>
						</li>
						<li> 
							<router-link to="/product"><i class="bx bx-right-arrow-alt"></i>All Product</router-link>
						</li>
						
					</ul>
				</li>

					<li>
					<a href="javascript:;" class="has-arrow">
		<img src="{{ asset('backend/Creativity.png') }}" height="20px" width="20px">
						<div class="menu-title">Expense</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/store-expense"><i class="bx bx-right-arrow-alt"></i>Add Expense</router-link>
						</li>
						<li> 
							<router-link to="/expense"><i class="bx bx-right-arrow-alt"></i>All Expense</router-link>
						</li>
						
					</ul>
				</li>


					<li>
					<a href="javascript:;" class="has-arrow">
				<img src="{{ asset('backend/target consumer.png') }}" height="20px" width="20px">
						<div class="menu-title">Customers</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/store-customer"><i class="bx bx-right-arrow-alt"></i>Add Customer</router-link>
						</li>
						<li> 
							<router-link to="/customer"><i class="bx bx-right-arrow-alt"></i>All Customer</router-link>
						</li>
						
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<img src="{{ asset('backend/Time is money.png') }}" height="20px" width="20px">
						<div class="menu-title">Salary</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/given-salary"><i class="bx bx-right-arrow-alt"></i>Add Salary</router-link>
						</li>
						<li> 
							<router-link to="/salary"><i class="bx bx-right-arrow-alt"></i>All Salary</router-link>
						</li>
						
					</ul>
				</li>

					<li>
					<a href="javascript:;" class="has-arrow">
						<img src="{{ asset('backend/Developing Product.png') }}" height="20px" width="20px">
						<div class="menu-title">Orders</div>
					</a>
					<ul>
						
						<li>
							<router-link to="/order"><i class="bx bx-right-arrow-alt"></i>Todays Order</router-link>
						</li>
						<li> 
							<router-link to="/search"><i class="bx bx-right-arrow-alt"></i>Search</router-link>
						</li>
						
					</ul>
				</li>





				<li>
					<router-link  to="/stock">
						<img src="{{ asset('backend/Warehouse.png') }}" height="20px" width="20px">
						<div class="menu-title">Stock</div>
					</router-link>
				</li>

				
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header id="topbar" v-show="$route.path==='/' || $route.path==='/register' ||$route.path==='/forgot' ? false : true" style="display: none;">
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="row row-cols-3 g-3 p-3">
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
											</div>
											<div class="app-title">Teams</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
											</div>
											<div class="app-title">Projects</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
											</div>
											<div class="app-title">Tasks</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
											</div>
											<div class="app-title">Feeds</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
											</div>
											<div class="app-title">Files</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
											</div>
											<div class="app-title">Alerts</div>
										</div>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
												ago</span></h6>
													<p class="msg-info">5 new user registered</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
												ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
												ago</span></h6>
													<p class="msg-info">The pdf files generated</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
												ago</span></h6>
													<p class="msg-info">5.1 min avarage time response</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span
												class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">New customer comments recived</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
												ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class='bx bx-user-pin'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
												ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class='bx bx-door-open'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
												ago</span></h6>
													<p class="msg-info">45% less alerts last 4 weeks</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Notifications</div>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class='bx bx-comment'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Messages</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-message-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src=" {{ asset('backend/assets/images/avatars/avatar-1.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
												ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src=" {{ asset('backend/assets/images/avatars/avatar-2.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
												sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src=" {{ asset('backend/assets/images/avatars/avatar-3.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src=" {{ asset('backend/assets/images/avatars/avatar-4.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
												min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
                                                    
													<img src=" {{ asset('backend/assets/images/avatars/avatar-5.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
												ago</span></h6>
													<p class="msg-info">Duis aute irure dolor in reprehenderit</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
                                                   
													<img src=" {{ asset('backend/assets/images/avatars/avatar-6.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">The passage is attributed to an unknown</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
                                                    
													<img src="{{ asset('backend/assets/images/avatars/avatar-7.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">The point of using Lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
                                                   
													<img src=" {{ asset('backend/assets/images/avatars/avatar-8.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
												ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-9.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-10.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
												ago</span></h6>
													<p class="msg-info">If you are going to use a passage</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
                                                   
													<img src=" {{ asset('bsckend/assets/images/avatars/avatar-11.png') }}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
												ago</span></h6>
													<p class="msg-info">All the Lorem Ipsum generators</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Messages</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            
							<img src="{{ asset('backend/assets/images/avatars/pro_pic.jpg') }}" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">shahriar Shuvo</p>
								<p class="designattion mb-0">Developer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							
							<li><router-link to="/logout" class="dropdown-item"><i class='bx bx-log-out-circle'></i><span>Logout</span></router-link>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->

		<!--start page wrapper -->
		<div class="page-wrapper">
            <router-view></router-view>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
			<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved by <a href="https://www.facebook.com/sadiq.shahriar/" target="_blank">Shahriar</a></p>
		</footer>

	</div>
 </div>
	<!--end wrapper-->
	<!--start switcher-->

	<!--end switcher-->
    <script src=" {{ asset('js/app.js') }}"></script>

	<!-- Bootstrap JS -->
	<script src=" {{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src=" {{ asset('backend/assets/js/jquery.min.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src=" {{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script>
		let token=localStorage.getItem('token');
		if(token){
			$('#sidbar').css("display","");
			$('#topbar').css("display","");
		}
	</script>


	<script src=" {{ asset('backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
	<!--notification js -->
	<script src=" {{ asset('backend/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src=" {{ asset('backend/assets/plugins/notifications/js/notifications.min.js') }}"></script>
	<script src=" {{ asset('backend/assets/js/index.js') }}"></script>
	<!--app JS-->
	<script src=" {{ asset('backend/assets/js/app.js') }}"></script>
</body>

</html>