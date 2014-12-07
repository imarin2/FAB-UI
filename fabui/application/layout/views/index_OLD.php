<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<?php echo $_layout_meta_tag ?>
		<title><?php echo $_layout_title ?></title>
		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?php echo base_url() ?>application/layout/assets/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url() ?>application/layout/assets/img/favicon/favicon.ico" type="image/x-icon">
		<!-- CSS -->
		<?php echo $_css_files ?>
		<!-- JS HEADER -->
		<?php echo $_header_js_files; ?>
		<!-- CSS IN PAGE -->
		<?php echo $_css_in_page; ?>
	</head>
	<body class="<?php echo $_skin; ?> <?php echo isset($_SESSION['user']['layout']) ? $_SESSION['user']['layout'] : '' ?> ">
		<header id="header">
			<div id="logo-group">
				<span id="logo">
					<img src="<?php echo base_url(); ?>application/layout/assets/img/<?php  echo $_skin == 'smart-style-0' ? 'logo-0.png' : 'logo-3.png'?>" />
				</span>
				<?php //$_update_list = myfab_update_list(); 
                        $_update_list = array();
                ?>
					<span id="activity" class="activity-dropdown">
						<i class="fa fa-user">
						</i>
						<b class="badge">
							<?php echo count($_update_list); ?>
						</b>
					</span>
					<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
					<div class="ajax-dropdown">
						<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
						<div class="btn-group btn-group-justified" data-toggle="buttons">
							<label class="btn btn-default update-list  notification">
								<input type="radio" name="activity" id="<?php echo site_url('controller/updates') ?>">
								<span>Updates (<?php echo isset($_SESSION['updates']['number']) ? $_SESSION['updates']['number']: 0 ?>)</span>
							</label>
							
							<label class="btn btn-default task-list notification">
								<input type="radio"  name="activity" id="<?php echo module_url('controller').'ajax/tasks.php' ?>">
								<span>Tasks (0)</span>
							</label>
						</div>
						<!-- notification content -->
						<div class="ajax-notifications custom-scroll">
							<div class="alert alert-transparent">
							</div>
							
						</div>
						<!-- end notification content -->
						<!-- footer: refresh area -->
						<span>
							<!-- Last updated on: 12/12/2013 9:43AM -->
							<button id="refresh-notifications" type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
								<i class="fa fa-refresh">
								</i>
							</button>
						</span>
						<!-- end footer -->
					</div>
					<!-- END AJAX-DROPDOWN -->
			</div>
			<div class="pull-right">
				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span>
						<a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i> </a>
					</span>
				</div>
				<!-- end collapse menu -->
				<!-- PROFILE BUTTON -->
				<div class="btn-header transparent pull-right">
					<span>
						<?php echo anchor( 'profile', '<i class="fa fa-user"></i>', 'title="Profile" style="cursor: pointer !important"'); ?>
					</span>
				</div>
				<!-- PLUGIN BUTTON -->
				<!--
				<div class="btn-header transparent pull-right">
					<span>
						<?php echo anchor( 'plugin', '<i class="fa fa-plug"></i>', 'title="Plugins" style="cursor: pointer !important"'); ?>
					</span>
				</div>
				-->
				
				
				<!-- LOGOUT BUTTON -->
				<div id="logout" class="btn-header transparent pull-right">
					<span>
						<?php echo anchor( 'login/out', '<i class="fa fa-power-off"></i>', 'title="Power Off" data-user-name="'.$_SESSION['user']['first_name'].'" data-logout-msg="What do you want to do?" data-action="userLogout" style="cursor: pointer !important"'); ?>
					</span>
				</div>
				<!-- multiple lang dropdown : find all flags in the image folder -->
                <!--
                <div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
                -->
            
				<!--
				<ul class="header-dropdown-list hidden-xs">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                        <img class="flag flag-<?php echo $_language['code'];  ?>" src="<?php echo base_url() ?>application/layout/assets/img/blank.gif" alt="United States" />
						  <span> <?php echo strtoupper($_language['code']);  ?> </span> <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a class="language" href="javascript:void(0);" data-value="english">
                                    <img class="flag flag-us" src="<?php echo base_url() ?>application/layout/assets/img/blank.gif" alt="English" /> English
                                </a>
							</li>
                            <li>
								<a class="language" href="javascript:void(0);" data-value="italian">
                                    <img class="flag flag-it" src="<?php echo base_url() ?>application/layout/assets/img/blank.gif" alt="Italiano" /> Italiano
                                </a>
							</li>
                            <li>
								<a class="language" href="javascript:void(0);" data-value="german">
                                    <img class="flag flag-de" src="<?php echo base_url() ?>application/layout/assets/img/blank.gif" alt="Italiano" /> Deutsch
                                </a>
							</li>
							 
						</ul>
					</li>
				</ul>
                
                
                
                <form id="lang_form" action="<?php echo site_url('controller/language')?>" method="POST">
                    <input type="hidden" name="lang" id="lang" value="" />
                    <input type="hidden" name="back_url" value="<?php echo uri_string(); ?>" />
                    <input type="hidden" id="actual_lang" value="<?php echo $_language['name']; ?>" />
                </form>
               
				<!-- end multiple lang -->
				
				
				
			</div>
		</header>
		<!-- END HEADER -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">
			<!-- User info -->
			<div class="login-info">
				<span>
					<!-- User image size is adjusted inside CSS, it should stay as it -->
					<a href="<?php echo site_url('profile') ?>" id="">
						<img id="user-avatar" src="<?php echo $_SESSION['user']['avatar'] != '' ?  $_SESSION['user']['avatar'] : base_url().'application/layout/assets/img/male.png';?>"  />
						<span id="user_basic_info"><?php echo $_SESSION['user']['first_name'];; ?> <?php echo $_SESSION['user']['last_name']; ?> </span>
					</a>
				</span>
			</div>
			<!-- end user info -->
			<nav>
				<ul>
					<?php echo $_sidebar_menu_items; ?>
				</ul>
			</nav>
			<span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>
		</aside>
		<!-- END NAVIGATION -->
		<!-- MAIN PANEL -->
		<div id="main" role="main">
			<!-- RIBBON -->
			<div id="ribbon">
                <?php //if(is_internet_avaiable()): ?>
				<span class="ribbon-button-alignment internet" style="display:none">
					<span class="btn btn-ribbon "  rel="tooltip" data-placement="bottom" data-original-title="Connected to internet"
					data-html="true"><i class="fa fa-globe "></i>
					</span>
				</span>
                <?php //endif; ?>
                <span class="ribbon-button-alignment">
					<span id="refresh" data-action="resetWidgets" class="btn btn-ribbon" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings."
					data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>
				<?php echo $_breadcrumbs ?>
				
				<?php echo $_custom_ribbon; ?>
				
			</div>
			<!-- END RIBBON -->
			<!-- MAIN CONTENT -->
			<div id="content" class=" ">
				<?php echo $_controller_view ?>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN PANEL -->
		
		<!-- FOOTER -->
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					
					
					
					<button data-toggle="modal" data-backdrop="static" data-target=".bug-modal" class="btn btn-xs bg-color-orange txt-color-white pull-right internet" style="margin-left: 5px;display:none" > 
						<i class="fa fa-bug"></i>&nbsp;<span class="hidden-mobile">Report a bug</span>
					</button>
					<button data-toggle="modal" data-backdrop="static" data-target=".suggestion-modal" class="btn btn-xs bg-color-blue txt-color-white pull-right internet" style="display:none">
						<i class="fa fa-stack-overflow"></i>&nbsp;<span class="hidden-mobile">Request for a feature</span>
					</button>
					<span class="txt-color-white ">FAB UI <em class="font-xs txt-color-orangeDark">beta</em></span>
				</div>
			</div>	

		</div>
		
		<div class="modal fade suggestion-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
		      		<div class="modal-header">
		      			<h4 class="modal-title"><i class="fa fa-stack-overflow"></i> Request for a feature</h4>
		      		</div>
		      		<div class="modal-body">
		      			<div class="row">
		      				<div class="col-md-12">
		      					<h5>Help us to improve even more your FABtotum experience</h5>
		      					<div class="form-group">
		      						<input id="suggestion-title" class="form-control" type="text" placeholder="Subject">
		      					</div>
		      					<div class="form-group">
		      						<textarea id="suggestion-text" class="form-control" placeholder="Content" rows="5"></textarea>
		      					</div>
		      				</div>
		      			</div>
		      		</div>
		      		<div class="modal-footer">
		      			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      			<button id="send-suggestion" type="button" class="btn btn-primary"> <i class="fa fa-envelope-o"></i> Send </button>
		      		</div>
				</div>
			</div>
		</div>
		
		
		<div class="modal fade bug-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
		      		<div class="modal-header">
		      			<h4 class="modal-title"><i class="fa fa-bug"></i> Report a bug</h4>
		      		</div>
		      		<div class="modal-body">
		      			<div class="row">
		      				
		      				<div class="col-md-12">
		      					<h6>Please first make sure FABUI is updated to the last version</h6>
		      					<h5>Our support forum is now live. Visit <a target="_blank" href="http://support.fabtotum.com/tickets/">http://support.fabtotum.com/tickets/</a></h5>
		      					<div class="form-group">
		      						<input id="bug-title" class="form-control" type="text" placeholder="Subject">
		      					</div>
		      					<div class="form-group">
		      						<textarea id="bug-text" class="form-control" placeholder="" rows="5"></textarea>
		      					</div>
		      				</div>
		      			</div>
		      		</div>
		      		<div class="modal-footer">
		      			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      			<button id="send-bug" type="button" class="btn btn-primary"> <i class="fa fa-envelope-o"></i> Send </button>
		      		</div>
				</div>
			</div>
		</div>
		
		<form id="lock-screen-form" action="<?php echo site_url('login/lock')?>" method="POST"></form>
		<div id="power-off-img" style="display:none;"><img class="img-responsive" src="/assets/img/power-off.png"></div>
		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<!--<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo base_url() ?>/application/layout/assets/js/plugin/pace/pace.min.js">
		</script>-->
		<!-- JAVASCRIPT FILE INLCUSIONS -->
        <script type="text/javascript">
            var number_updates = <?php echo isset($_SESSION['updates']['number']) ? $_SESSION['updates']['number']: 0 ?>; 
            var number_tasks = 0;
            var number_notifications = 0;
            var sound_folder = '<?php echo base_url().'application/layout/assets/sound/' ?>';
            var max_idle_time = <?php echo isset($_SESSION['user']['lock-screen']) ? $_SESSION['user']['lock-screen'] : 0 ?>;
            var setup_wizard = <?php echo $_setup_wizard == true && (isset($_SESSION['ask_wizard']) && $_SESSION['ask_wizard'] == true) ? 'true' : 'false' ?>;
        </script>
		<?php echo $_js_files ?>
		<!-- JAVASCRIPT IN PAGE -->
		<?php echo $_js_in_page; ?>
	</body>
</html>