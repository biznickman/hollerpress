			<?php if ( have_comments() ) : ?>
			<h3>Archived Comments</h3>
			<ol class="commentlist">
			<?php
				wp_list_comments();
			?>
			</ol>
			<?php endif; ?>