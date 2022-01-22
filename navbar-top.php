		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							SISTEM INFORMASI COVID 19 DESA KAMPUNG PINANG 
						</small>
					</a>
					
					<ul class="nav ace-nav pull-right">
						<li class="grey">
							

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-ok"></i>
									3 Master Data Referensi
								</li>

								<li>
									<a  href="javascript:void(0)" onclick="swapContent('master_ref/user/user')">
										<div class="clearfix">
											<span class="pull-left"> User</span>
										</div>
									</a>
								</li>
								
								<li>
									<a href="javascript:void(0)" onclick="swapContent('master_ref/posko/posko')">
										<div class="clearfix">
											<span class="pull-left">Posko</span>
										</div>
									</a>
								</li>
								
								<li>
									<a href="javascript:void(0)" onclick="swapContent('master_ref/vaksin/vaksin')">
										<div class="clearfix">
											<span class="pull-left">vaksin</span>
										</div>
									</a>
								</li>
								
							</ul>
						</li>
	
						<li class="purple">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<?php $foto = 'master_ref/user/img_user/'.$_SESSION['foto_user']; ?>
								<img class="nav-user-photo" src="<?php  echo $foto;?>" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $_SESSION['s_nama']?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>								
									<a  href="javascript:void(0)" onclick="swapContent('user/user')" > 
										<i class="icon-user"></i>
										Profile
									</a>
								</li>
							
								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>