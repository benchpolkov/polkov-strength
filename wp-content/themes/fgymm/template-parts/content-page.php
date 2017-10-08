<?php
/**
 * The default template for displaying page content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-content">
		<?php echo '<h1 class="entry-title">'.get_the_title().'</h1>'; ?>
		<?php fgymm_the_content_single(); ?>
	</div>
	<div class="page-after-content">
		
		<?php if ( ! post_password_required() ) : ?>

	<?php if ('open' == $post->comment_status) : ?>
			<span class="comments-icon">
				<?php comments_popup_link(__( 'No Comments', 'fgymm' ), __( '1 Comment', 'fgymm' ), __( '% Comments', 'fgymm' ), '', __( 'Comments are closed.', 'fgymm' )); ?>
			</span>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'fgymm' ), '<span class="edit-icon">', '</span>' ); ?>

<?php endif; ?>
	</div>
</article>
