<?php
/**
 * @package Modern QRCode Generator
	@version 1.0
 */

    class ModernQrCode extends WP_Widget {
        public function __construct(){
            $widget_options = [
                'classname'=>'modern_qr_code_class',
                'description'=>'Modern QRCode Generator'
            ];
            parent::__construct('modern_qr_code_main_id', 'Modern QRCode Generator', $widget_options);
        }

   // The widget form (for the backend )
        public function form( $instance ) {

            // Set widget defaults
            $defaults = [
                'link'=>'http://www.sumon-it.com/',
                'size'=>200
            ];

            // Parse current settings with defaults
            extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

			<?php // Web site Link for generate qr code ?>
            <p style="color:red">
                <?php
                    if(isset($instance['error'])){
                        echo $instance['error'];
                    }
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('link'))?>"><?php _e('Web Site Link/URL','qrcode');?></label>
                <input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('link'));?>" id="<?php echo esc_attr($this->get_field_id('link'));?>" value="<?php echo esc_attr($link);?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('size'))?>"><?php _e('Enter Image Height','qrcode');?></label>
                <input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('size'));?>" id="<?php echo esc_attr($this->get_field_id('size'));?>" value="<?php echo esc_attr($size);?>">
            </p>

        <?php }

        public function update( $new_instance, $old_instance ) {
           // $instance = $old_instance;
            $instance['size']   = isset( $new_instance['size'] ) ? wp_strip_all_tags( $new_instance['size'] ) : '';

            if($new_instance['link']!='http://www.sumon-it.com/'){
                $instance['error'] = "Please".'<a href="http://www.sumon-it.com/"> Buy </a>'."Premium Version for Update Link";

            }else{
                $instance['link']   = isset( $new_instance['link'] ) ? wp_strip_all_tags( $new_instance['link'] ) : '';
                $instance['size']   = isset( $new_instance['size'] ) ? wp_strip_all_tags( $new_instance['size'] ) : '';
            }
            return $instance;
        }

        public function widget($args, $instance){
            $link     = isset( $instance['link'] ) ? $instance['link'] : '';
            $size     = isset( $instance['size'] ) ? $instance['size'] : '';
         ?>

                <?php
                if (class_exists('QRcode')){
                    echo QRcode::svg("$link", 'qr.svg','M','0','0'); // creates file
                }
                ?>
            <?php
            echo $args['before_widget'];
            echo $args['before_title'];
            echo "QR Code Generator";
            echo $args['after_title'];
            ?>

               <span id="imagesize">
                    <img  src="qr.svg" alt="" srcset="">
               </span>
            <style>
                #imagesize img{width: auto;height: <?php echo $size;?>px}
            </style>
            <?php  echo $args['after_widget'];?>

<?php }
    }
?>