<?php
/*
Template Name: Browse page
*/
get_header(); ?>

	<div class="small-12 large-8 columns" role="main">
	
	<?php do_action('foundationPress_before_content'); ?>
	
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<?php do_action('foundationPress_page_before_entry_content'); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				
				<!-- list the categories -->
				
				<ul class="category-listing">
				
					<?php $categories = get_categories(); 
				
					/*$category->term_id
					$category->name
					$category->slug
					$category->term_group
					$category->term_taxonomy_id
					$category->taxonomy
					$category->description
					$category->parent
					$category->count
					$category->cat_ID
					$category->category_count
					$category->category_description
					$category->cat_name
					$category->category_nicename
					$category->category_parent*/
				
				 	foreach($categories as $category) { 
						if ( $category->parent ==0 && $category->name!='Uncategorized') {
							echo '<li><div class="category-name"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name;
							echo " (" . $category->count . ")</a>";
							echo "</div>";
						
							// nested categories
							$args = "child_of=" . $category->cat_ID;
							$subcats = get_categories($args);
							if ( count( $subcats )>0) {
								echo "<ul>";
								foreach ($subcats as $subcat) {
									echo '<li><div class="sub-category-name"><a href="' . get_category_link( $subcat->term_id ) . '">' . $subcat->name . ' (' . $subcat->count . ')</a></div></li>';
									
								}
								echo "</ul>";
							}
						
							echo '</li>';
						}
						
					}
						
					 
					 
					 
					 
				    /*echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
				    echo '<p> Description:'. $category->description . '</p>';
				    echo '<p> Post Count: '. $category->count . '</p>';  } */
				?>
				
			</ul>
				
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			
			
		</article>
	<?php endwhile;?>

	<?php do_action('foundationPress_after_content'); ?>

	</div>
	<?php get_sidebar(); ?>
		
<?php get_footer(); ?>