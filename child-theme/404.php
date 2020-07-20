<?php get_header();?>
	<div class="wrapper_404">
		<div class="container_vertical_wrapper">
			<div class="container a-center">
				<h1 class="number_404"><?php echo esc_html__('404', 'oconnor'); ?></h1>
				<h1><?php echo esc_html__('Page Not Found.', 'oconnor'); ?></h1>
				<p><?php echo esc_html__('Use the Search Form below or return to the')?>
					<a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home Page', 'oconnor'); ?></a>.
				</p>
				<div class="gt3_404_search">
					<?php get_search_form(); ?>
				</div>
				<div class="gt3_module_button  button_alignment_inline">
					<a class="button_size_normal text-uppercase" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take me home', 'oconnor'); ?></a>
				</div>
				
			</div>
		</div>
	</div>
<?php get_footer(); ?>