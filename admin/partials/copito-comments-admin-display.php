<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://copitosystem.com
 * @since      1.0.0
 *
 * @package    Copito_Comments
 * @subpackage Copito_Comments/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
<h1>Copito Comments</h1>
<strong style="font-style:italic;"><?php _e("Move all your comments to your site.", 'copito-comments'); ?></strong>

<br><br>
<div class="copito-content">

<div class="copito-tabs"><!-- Start tabs -->
<h2 class="nav-tab-wrapper" >
    <a class="nav-tab nav-tab-active" href="#tabs-1"><?php _e("Add comments", 'copito-comments'); ?></a>
    <a class="nav-tab" href="#tabs-2"><?php _e("About", 'copito-comments'); ?></a>
</h2>
<br>

<div class="tab-panel" id="tabs-1">
    <b><?php _e("Fill in the form to create a comment.", 'copito-comments'); ?></b>
    <p><?php _e("Just write the name of the person who is posting the comment and the content of it. Keep in mind that it's not necesary that the person is registered to do it. Select the post you want to comment and you are done.", 'copito-comments'); ?></p>
    
    <form method="POST">
    <?php wp_nonce_field('user_info', 'user_info_nonce', true, true); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row" style="width: 10%;"><?php _e("Name", 'copito-comments'); ?></th>
        <td><input type="text" name="name" value="" /></td>
        </tr>

        <tr valign="top">
        <th scope="row" style="width: 10%;"><?php _e("Email", 'copito-comments'); ?></th>
        <td><input type="email" name="email" value="" />
            <br><?php _e("Optional", 'copito-comments'); ?>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><?php _e("Comment", 'copito-comments'); ?></th>
        <td><textarea type="text" name="comment" placeholder="<?php _e('Insert your content here...', 'copito-comments'); ?>" rows="6" cols="50"></textarea></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php _e("Post", 'copito-comments'); ?></th>
        <td>
            <select name="post-id">
                <?php $posts = array(
                    'posts_per_page'   => 50,
                    'offset'           => 0,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'suppress_filters' => true 
                    );
                    $posts_array = get_posts( $posts );
                foreach ($posts_array as $post) {
                    setup_postdata( $post );
                    echo '<option value="'.$post->ID.'">';
                    the_title();
                    echo '</option>';
                }
                ?>
            </select>
            <br><?php _e("Only last 50 being displayed", 'copito-comments'); ?> 
        </td>
        </tr>

    </table>
    <?php submit_button( __('Add comment', 'copito-comments') ); ?>
	</form>
    <br>
</div>

<div class="tab-panel" id="tabs-2" style="display: none;">
    <h2><?php _e("About the plugin", 'copito-comments'); ?></h2>
    <p><?php _e("Be able to copy your social media comments or private messages to your website.", 'copito-comments'); ?></p>
    <p><?php _e("This plugin allows you to convert each message to comments by hand and migrate them all to your website. Just select the post you want to place the comment, write a name and copy the content.", 'copito-comments'); ?></p>
    <p><?php _e("If you have any problem or need a detailed explanation of how to use this plugin, click the button below and we will contact you soon.", 'copito-comments'); ?></p>
    <p><b><?php _e("Made by", 'copito-comments'); ?> <a href="http://copitosystem.com">CopitoSystem.com</a></b></p>
    <br>
    <a class="button button-primary button-large" href="https://goo.gl/forms/fkNLOW3iIg1XbW2H3" target="_blank"><?php _e("Learn More", 'copito-comments'); ?></a>
    <a class="copito-go-premium-tabs" onclick="alert(' <?php _e("Comming soon!", 'copito-comments'); ?> ');" href="#"><?php _e("Go Premium", 'copito-comments'); ?></a>
    <br><br>
    <hr>
    <br>
    <h2><?php _e("Give us your feedback or make a donation", 'copito-comments'); ?></h2>
    <p><?php _e("We focus on creating a great product, and the best way we can achieve that is by taking our user's feedbacks.", 'copito-comments'); ?></p>
    <p><?php _e("If you really liked this plugin, feel free to send me a little donation (I need a new pc :)", 'copito-comments'); ?></p>
    <br>
    <div style="display: inline-flex;">
    <a class="button button-primary button-large" href="https://goo.gl/forms/RTW29CzGOm2gvxLw1" target="_blank"><?php _e("Give Your Feedback", 'copito-comments'); ?></a>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="9G29TRL393USG">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://i1.wp.com/www.paypalobjects.com/en_US/i/scr/pixel.gif?resize=1%2C1&ssl=1" width="1" height="1">
    </form>
    </div>

</div>

<!-- End tabs --></div>

<div class="copito-ads"><h2 style="color: #ed2665;"><?php _e("Copito System news", 'copito-comments'); ?></h2>
<?php _e("Find the best coding tutorials", 'copito-comments'); ?>
<br><hr><br>
<div class="sidebar"><strong><?php _e("Services", 'copito-comments'); ?></strong>
    <p><?php _e("Would you like to learn how to code?", 'copito-comments'); ?> <a href="" target="_blank"><?php _e("Let's us teach you in a simple and easy way!", 'copito-comments'); ?></a></p><a href="http://copitosystem.com" target="_blank">
    <img width="261" height="152" src="<?php echo plugins_url( 'copito-ad.png', __FILE__ ); ?>"></a>
</div>
</div>

</div></div>


