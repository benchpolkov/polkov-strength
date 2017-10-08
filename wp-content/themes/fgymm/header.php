<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="body-content-wrapper">
			<header id="header-main-fixed">
				<div id="header-content-wrapper">
					<div id="header-top">
						<ul class="header-social-widget">
							<?php fgymm_show_social_sites(); ?>
						</ul>
					</div>
					<div class="clear">
					</div>
					<div id="header-logo">
						<?php fgymm_show_website_logo_image_and_title(); ?>
					</div>
					<nav id="navmain">
						<?php wp_nav_menu( array(
												  
												  
												  'theme_location'  => 'primary',
											  ) ); ?>
					</nav>
					
					<div class="clear">
					</div>
				</div>
			</header>
			<div id="header-spacer">
				&nbsp;
			</div>
