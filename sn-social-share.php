<?php
/**
* Plugin Name: SN Social Share
* Plugin URI: https://github.com/suhiminain/sn-social-share
* Description: simple social share icon for genesis framework
* Version: 1.0.0
* Author: Suhimi Nain
* Author URI: https://www.suhiminain.com/
*
* Text Domain: sn-social-share
* @license  http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
**/

if ( ! defined( 'ABSPATH' ) ) {
	die( esc_html__( 'Sorry, you are not allowed to access this page directly.', 'sn-social-share' ) );
}

define( 'SN_SOCIAL_SHARE_VERSION', '1.0.0' );
define( 'SN_SOCIAL_SHARE_PATH', plugin_dir_path( __FILE__ ) );
define( 'SN_SOCIAL_SHARE_INC', plugin_dir_path( __FILE__ ) . '/includes/' );
define( 'SN_SOCIAL_SHARE_URL', plugins_url( '', __FILE__ ) );

class sn_social_share_plugin {

    /* add */
	function __construct() {

        add_action( 'admin_menu', array( $this, 'sn_social_share_menu' ));
        add_action( 'admin_init', array( $this, 'register_sn_social_share_settings' ));

		add_action( 'init', array( $this, 'genesis_sp_share_style' ), 5 );

		add_action( 'genesis_entry_header', array( $this, 'sn_social_share' ), 15 );
		add_action( 'genesis_entry_content', array( $this, 'sn_social_share_bottom' ), 11 );
 
	}
	
	
    /* social share - style */
	function genesis_sp_share_style() {
	
    if(get_option( 'sn_social_share_style' )=="default"){	
		wp_register_style('sn-share-style', SN_SOCIAL_SHARE_URL.'/assets/style.css',array(),SN_SOCIAL_SHARE_VERSION);
    }
	
    if(get_option( 'sn_social_share_style' )=="small"){	
		wp_register_style('sn-share-style', SN_SOCIAL_SHARE_URL.'/assets/style-small.css',array(),SN_SOCIAL_SHARE_VERSION);
    }
		wp_register_style('sn-share-font', SN_SOCIAL_SHARE_URL.'/assets/fonts/snflaticon.css',array(),SN_SOCIAL_SHARE_VERSION);
		wp_enqueue_style('sn-share-font');
		wp_enqueue_style('sn-share-style');
	
	}
 
     /* social share - top */
	function sn_social_share() { 
	
		if ( ! is_singular ( 'post' ) ) {
			return;
		}
	
		if ( get_option( 'sn_social_share_top' )!="on" ) {
			return;
		}
	
		echo "<div class=\"sn-social-sharer top\">";
		if ( get_option( 'sn_social_share_fb_enable' )=="on" ) {
			echo "<a href=\"https://www.facebook.com/sharer.php?u=".get_permalink()."\" class=\"fb-share\" rel=\"nofollow\"><span>";
			if ( get_option('sn_social_share_fb_text')) { echo get_option( 'sn_social_share_fb_text' );} else{ echo "Facebook";};
			echo "</span></a>";
		}
		if ( get_option( 'sn_social_share_tw_enable' )=="on" ) {
		    echo "<a href=\"https://twitter.com/intent/tweet?text=".get_the_title()."&url=".get_permalink()."\" class=\"tw-share\" rel=\"nofollow\"><span>";
		    if ( get_option('sn_social_share_tw_text')) { echo get_option( 'sn_social_share_tw_text' );} else{ echo "Twitter";};
		    echo "</span></a>";
		}
		if ( get_option( 'sn_social_share_ws_enable' )=="on" ) {
		    echo "<a href=\"https://api.whatsapp.com/send?text=".get_permalink()."\" class=\"ws-share\" rel=\"nofollow\"><span>";
		    if ( get_option('sn_social_share_ws_text')) { echo get_option( 'sn_social_share_ws_text' );} else{ echo "Whatsapp";};
		    echo "</span></a>";
		}
		echo "</div>";
	
	}

    /* social share - bottom */
	function sn_social_share_bottom() {
	
		if ( ! is_singular ( 'post' ) ) {
			return;
		}
		
		if ( get_option( 'sn_social_share_bottom' )!="on" ) {
			return;
		}
	
		echo "<div class=\"sn-social-sharer top\">";
		if ( get_option( 'sn_social_share_fb_enable' )=="on" ) {
			echo "<a href=\"https://www.facebook.com/sharer.php?u=".get_permalink()."\" class=\"fb-share\" rel=\"nofollow\"><span>";
			if ( get_option('sn_social_share_fb_text')) { echo get_option( 'sn_social_share_fb_text' );} else{ echo "Facebook";};
			echo "</span></a>";
		}
		if ( get_option( 'sn_social_share_tw_enable' )=="on" ) {
		    echo "<a href=\"https://twitter.com/intent/tweet?text=".get_the_title()."&url=".get_permalink()."\" class=\"tw-share\" rel=\"nofollow\"><span>";
		    if ( get_option('sn_social_share_tw_text')) { echo get_option( 'sn_social_share_tw_text' );} else{ echo "Twitter";};
		    echo "</span></a>";
		}
		if ( get_option( 'sn_social_share_ws_enable' )=="on" ) {
		    echo "<a href=\"https://api.whatsapp.com/send?text=".get_permalink()."\" class=\"ws-share\" rel=\"nofollow\"><span>";
		    if ( get_option('sn_social_share_ws_text')) { echo get_option( 'sn_social_share_ws_text' );} else{ echo "Whatsapp";};
		    echo "</span></a>";
		}
		echo "</div>";
	
	}
	
    /* default setting value */
    function install_sn_social_share() {
        $kn_plugin="sn_social_share";
        add_option( $kn_plugin."_fb_text", "" );
        add_option( $kn_plugin."_fb_enable", "on" );
        add_option( $kn_plugin."_tw_text", "" );
        add_option( $kn_plugin."_tw_enable", "on" );
        add_option( $kn_plugin."_ws_text", "" );
        add_option( $kn_plugin."_ws_enable", "on" );
        add_option( $kn_plugin."_style", "default" );
        add_option( $kn_plugin."_top", "on" );
        add_option( $kn_plugin."_bottom", "on" );
    }

     /* add sub-menu */
	function sn_social_share_menu() {
		add_submenu_page('options-general.php', 'SN Social Share', 'SN Social Share', 'administrator', 'sn_social_share_settings', array($this,'sn_social_share_page'));
	}
	
     /* settings */
    function register_sn_social_share_settings() {
        register_setting( 'sn_social_share_group', 'sn_social_share_fb_enable' );
        register_setting( 'sn_social_share_group', 'sn_social_share_fb_text' );
        register_setting( 'sn_social_share_group', 'sn_social_share_tw_enable' );
        register_setting( 'sn_social_share_group', 'sn_social_share_tw_text' );
        register_setting( 'sn_social_share_group', 'sn_social_share_ws_enable' );
        register_setting( 'sn_social_share_group', 'sn_social_share_ws_text' );
        register_setting( 'sn_social_share_group', 'sn_social_share_style' );
    	register_setting( 'sn_social_share_group', 'sn_social_share_top' );
    	register_setting( 'sn_social_share_group', 'sn_social_share_bottom' );
    }
    
    /* settings page */
    function sn_social_share_page() {
    ?>
    <div class="wrap">
    	<h2>SN Social Share Settings</h2>
    	<form method="post" action="options.php">
    		<?php settings_fields( 'sn_social_share_group' ); ?>
    		<?php do_settings_sections( 'sn_social_share_group' ); ?>
    		
    <table class="form-table">
    	<tbody>
    		<!-- visibility -->
    		<tr>
    			<th scope="row"><label for="blogname">Social Share Button Style</label></th>
    			<td>
    			<select name="sn_social_share_style">
    			     <option value="default" <?php if(get_option( 'sn_social_share_style' )=="default"){ echo "selected"; } ?>>Default</option>
    			     <option value="small" <?php if(get_option( 'sn_social_share_style' )=="small"){ echo "selected"; } ?>>Small</option>
    			</select>
    			</td>
    		</tr>
    		<!-- location -->
    		<tr>
    			<th scope="row"><label for="blogname">Social Share Button Location</label></th>
    			<td>
    			<fieldset>
    					<label for="sn_social_share_top">
    						<input name="sn_social_share_top" type="checkbox" id="sn_social_share_top" <?php if(get_option( 'sn_social_share_top' )=="on"){ echo "checked='checked'"; } ?>> Show SN Social Share On Top of pages.
    					</label>
    					<br>
    					<label for="sn_social_share_bottom">
    						<input name="sn_social_share_bottom" type="checkbox" id="sn_social_share_bottom" <?php if(get_option( 'sn_social_share_bottom' )=="on"){ echo "checked='checked'"; } ?>> Show SN Social Share On Bottom of pages.
    					</label>
    			</fieldset>
    			</td>
    		</tr>
    		<!-- text -->
    		<tr>
    			<th scope="row"><label for="sn_social_share_fb_text">Social Network</label></th>
    			<td>
                        <p>
    					<label for="sn_social_share_fb_enable">
    						<input name="sn_social_share_fb_enable" type="checkbox" id="sn_social_share_fb_enable" <?php if(get_option( 'sn_social_share_fb_enable' )=="on"){ echo "checked='checked'"; } ?> > Facebook :
    					</label>
                        <input name="sn_social_share_fb_text" type="text" id="sn_social_share_fb_text" value="<?php if(get_option( 'sn_social_share_fb_text' )){ echo get_option( 'sn_social_share_fb_text' ); } ?>">
                        </p>
                        <p>
    					<label for="sn_social_share_tw_enable">
    						<input name="sn_social_share_tw_enable" type="checkbox" id="sn_social_share_tw_enable" <?php if(get_option( 'sn_social_share_tw_enable' )=="on"){ echo "checked='checked'"; } ?> > Twitter :
    					</label>
    			        <input name="sn_social_share_tw_text" type="text" id="sn_social_share_tw_text" value="<?php if(get_option( 'sn_social_share_tw_text' )){ echo get_option( 'sn_social_share_tw_text' ); } ?>">
                        </p>
                        <p>
    					<label for="sn_social_share_ws_enable">
    						<input name="sn_social_share_ws_enable" type="checkbox" id="sn_social_share_ws_enable" <?php if(get_option( 'sn_social_share_ws_enable' )=="on"){ echo "checked='checked'"; } ?> > Whatsapp :
    					</label>
    			        <input name="sn_social_share_ws_text" type="text" id="sn_social_share_ws_text" value="<?php if(get_option( 'sn_social_share_ws_text' )){ echo get_option( 'sn_social_share_ws_text' ); } ?>">
                        </p>

    			</td>
    		</tr>

    	</tbody>
    </table>
    		<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    	</form>
    </div>
    <?php }  
	
}


if ( class_exists( 'sn_social_share_plugin' ) ) {

	$sn_social_share_plugin = new sn_social_share_plugin();
}

/* plugin activation */
register_activation_hook(__FILE__,array($sn_social_share_plugin,'install_sn_social_share'));
