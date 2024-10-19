<?php
/**
 * The template for displaying all single posts.
 *
 * @package Theme Freesia
 * @subpackage Idyllic
 * @since Idyllic 1.0
 */
get_header();
	$idyllic_settings = idyllic_get_theme_options();
	?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php global $idyllic_settings;
			while( have_posts() ) {
				the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
				<?php $idyllic_entry_meta_single = $idyllic_settings['idyllic_entry_meta_single']; ?>
				<header class="entry-header">
					<?php if($idyllic_entry_meta_single=='show'){ ?>
					<div class="entry-meta">
						<?php $format = get_post_format();
							if ( current_theme_supports( 'post-formats', $format ) ) {
								printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
									sprintf( ''),
									esc_url( get_post_format_link( $format ) ),
									esc_html(get_post_format_string( $format ))
								);
							} 
							if ( is_singular( 'post' ) ) {?>
								<span class="cat-links">
									<?php the_category(', '); ?>
								</span>
								<!-- end .cat-links -->
								<?php $tag_list = get_the_tag_list( '', __( ', ', 'idyllic' ) );
								if(!empty($tag_list)){ ?>
									<span class="tag-links">
									<?php   echo get_the_tag_list( '', __( ', ', 'idyllic' ) ); ?>
									</span> <!-- end .tag-links -->
								<?php }
							}else{ ?>
							<nav id="image-navigation" class="navigation image-navigation">
								<div class="nav-links">
									<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'idyllic' ) ); ?></div>
									<div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'idyllic' ) ); ?></div>
								</div><!-- .nav-links -->
							</nav><!-- .image-navigation -->
						<?php	} ?>
					</div>
					<?php } ?>
					<h1 class="entry-title"><?php the_title();?></h1> <!-- end.entry-title -->
					<?php if($idyllic_entry_meta_single=='show'){ ?>
					<div class="entry-meta">
						<span class="author vcard"><?php esc_html_e('Post By','idyllic');?><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_author(); ?> </a></span>
						<span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>"> <i class="fa-regular fa-calendar"></i>
						<?php esc_html(the_time( get_option( 'date_format' ) )); ?> </a></span>
						<?php if ( comments_open() ) { ?>
						<span class="comments"><i class="fa-regular fa-comment"></i>
						<?php comments_popup_link( __( 'No Comments', 'idyllic' ), __( '1 Comment', 'idyllic' ), __( '% Comments', 'idyllic' ), '', __( 'Comments Off', 'idyllic' ) ); ?> </span>
						<?php } ?>
					</div><!-- end .entry-meta -->
					<?php } ?>
				</header>
				<!-- end .entry-header -->
					<div class="entry-content">
							<?php the_content(); ?>			
					</div><!-- end .entry-content -->
				</article><!-- end .post -->
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation( array(
								'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'idyllic' ),
							) );
				} elseif ( is_singular( 'post' ) ) {
				the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'idyllic' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'idyllic' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'idyllic' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'idyllic' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );
				}
			} ?>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php
get_sidebar();
?>
</div><!-- end .wrap -->
<?php
get_footer();