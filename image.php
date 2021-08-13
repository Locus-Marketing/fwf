<?php //Hide image pages for SEO purposes
if ($post->post_parent >= 1) {
		wp_redirect(get_permalink($post->post_parent));
	} else {
		wp_redirect(home_url());
	}
?>