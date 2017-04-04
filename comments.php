<?php 
	// Do not delete these lines	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))		
	die ('Please do not load this page directly. Thanks!');	
	if (!empty($post->post_password)) { 
	// if there's a password		
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  
	// and it doesn't match the cookie
?>		
		

	<p class="nocomments" style="margin-bottom:30px;"><?php echo __('This post is password protected. Enter the password to view comments.', 'crunchpress'); ?></p>						
		
<?php 
	return;		
		}	
	}
?>
<div class="comment-box">
    <h3>Total <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></h3>

<?php if ($comments) : ?>        
	
        <ul class="comments-list">
        <?php foreach ($comments as $comment) : ?>   
            <li>
            
                <?php if ($comment->comment_approved == '0') : ?>                                        
                <?php comment_reply_link( array('reply_text' => '<i class="fa fa-reply"></i>Reply'), comment_ID(), the_ID() ); ?>                                   
                <?php endif; ?>  
                
                <div class="comm-holder">
                    <div class="b-post-img">
                        <?php echo get_avatar( $comment, 60 ); ?>
                    </div>
                    <div class="b-post-detail">
                        <em class="author-det"><?php echo __('Written by', 'crunchpress'); ?>&nbsp;<span><?php comment_author_link(); ?></span> on <?php comment_date('jS F, Y') ?></em>
                        <p><?php comment_text() ?></p>
                    </div>
                </div>
               
            </li>
        <?php endforeach; /* end for each comment */ ?>
        </ul>                                           
                    

<?php endif; ?>



<?php if ('open' == $post->comment_status) : ?>                                                    

       		 <?php if ( get_option('comment_registration') && !$user_ID ) : ?>                                    

        		<p><?php echo __('You must be', 'crunchpress'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo __('logged in', 'crunchpress'); ?> </a>
       			<?php echo __('to post a comment.', 'crunchpress'); ?>                                   
        		</p>                                    

        	<?php else : ?>                                    
  
            <h3 class="comment-form-title"><?php echo __('Leave a comment', 'crunchpress'); ?></h3>
            <hr>
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form" id="comment"> 
                <ul>
                       
            <?php if ( $user_ID ) : ?> 
             <li>
                <p>
					<?php echo __('Logged in as', 'crunchpress'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?> </a>.                                     
        			<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php echo __('Log out', 'crunchpress'); ?> &raquo; </a>
        		</p> 
              <li>      
            <?php else : ?>  
                    <li><input type="text" name="Name"  required pattern="[a-zA-Z ]+"> <label>Name<span>*</span></label></li>
                    <li><input type="text" name="email" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$"> <label>E-mail<span>*</span></label></li>
                    <li><input type="text" name="website" required > <label>Website<span>*</span></label></li>
            <?php endif; ?>	
                    <li><textarea name="comment" id="comment detailed_comment" Placeholder="Enter comment" cols="10" rows="10"></textarea></li>
                    <li><input type="submit" id="submit" name="submit" value="Send Comments"></li>
                    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />                                    
                    <?php do_action('comment_form', $post->ID); ?>   
                </ul>
            </form> 
                                            
</div>
        	<?php endif; // If registration required and not logged in ?>                                              

<?php endif; // if you delete this the sky will fall on your head ?>                           