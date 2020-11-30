<?php
if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWMA_front')) {

    class OCWMA_front {

        protected static $instance;


          function get_adress_book_endpoint_url( $address_book ) {
              $url = wc_get_endpoint_url( 'edit-address', 'shipping', get_permalink() );
              return add_query_arg( 'address-book', $address_book, $url );
          }

        
          function wc_address_book_add_to_menu( $items ) {
              foreach ( $items as $key => $value ) {
                  if ( 'edit-address' === $key ) {
                      $items[ $key ] = __( 'Address Book', 'woo-address-book' );
                  }
              }
              return $items;
          } 


          function ocwqv_popup_div_footer(){
          ?>
              <div id="ocwma_billing_popup" class="ocwma_billing_popup_class">
              </div>
              <div id="ocwma_shipping_popup" class="ocwma_shipping_popup_class">
              </div>
              <?php         
          }
              
          function misha_my_account_endpoint_content(){  
               $user_id       = get_current_user_id();
               global $wpdb;
               $tablename=$wpdb->prefix.'ocwma_billingadress';  
               $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='billing' AND userid=".$user_id);
                echo '<div class="ocwma_table_custom">';
                 echo '<div class="ocwma_table_bill">';
                if(!empty($user)){    
                  echo "<table width='100%'>"; 
                  echo "<tbody>";  
                  echo '<table class="ocwma_bill_table">';
                    foreach($user as $row){    
                      $userdata_bil=$row->userdata;
                      $user_data = unserialize($userdata_bil);     
                      echo '<tr><td><button class="form_option_edit" data-id="'.$user_id.'"  data-eid-bil="'.$row->id.'">edit</button></td><td><a href="?action=delete_ocma&did='.$row->id.'">Delete</a></td></tr>';
                      echo '<tr>';
                      echo '<td >' .$user_data['reference_field'] .'</td>';
                      echo '</tr>';  
                      echo '<tr>';
                      echo '<td >'.$user_data['billing_first_name'] .'&nbsp'.$user_data['billing_last_name'] .'</td>';
                      echo '</tr>';
                      echo '<td>' .$user_data['billing_company'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['billing_address_1'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['billing_address_2'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['billing_city'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['billing_country'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['billing_postcode'] .'</td>'; 
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['billing_state'] .'</td>';
                      echo '</tr>';
                      echo '</tr>';
                    }
                      echo '</table>';
                      
                }
                echo '</div>';
                $user_shipping = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='shipping' AND userid=".$user_id);
                   echo '<div class="ocwma_table_ship">';
                if(!empty($user_shipping)){    
                    echo "<table width='100%'>"; 
                    echo "<tbody>";    
                    echo '<table class="ocwma_ship_table">'; 
                    foreach($user_shipping as $row){    
                      $userdata_ship=$row->userdata;
                      $user_data = unserialize($userdata_ship);   
                      echo '<tr><td><button class="form_option_ship_edit" data-id="'.$user_id.'"  data-eid-ship="'.$row->id.'">edit</button></td><td><a href="?action=delete-ship&did-ship='.$row->id.'">Delete</a></td></tr>';
                      echo '<tr>';
                      echo '<td >'.$user_data['reference_field'] .'</td>';
                      echo '</tr>';  
                      echo '<tr>';
                      echo '<td >'.$user_data['shipping_first_name'] .'&nbsp'.$user_data['shipping_last_name'] .'</td>';
                      echo '</tr>';
                      echo '<td>' .$user_data['shipping_company'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['shipping_address_1'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['shipping_address_2'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['shipping_city'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['shipping_country'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['shipping_postcode'] .'</td>';
                      echo '</tr>';
                      echo '<tr>';
                      echo '<td>' .$user_data['shipping_state'] .'</td>';
                      echo '</tr>';
                      echo '</tr>';
                      }   
                      echo '</table>';     
                   }
                    echo '</div>';   
                    echo '</div>'; 
              
               ?>
            <div class="cus_menu">
                <div class="billling-button">
                  <button class="form_option_billing" data-id="<?php echo $user_id; ?>" style="background-color: <?php echo get_option( 'ocwma_btn_bg_clr' ) ?>; color: <?php echo get_option( 'ocwma_font_clr' ) ?>; padding: <?php echo get_option( 'ocwma_btn_padding' )?>; font-size: <?php echo get_option( 'ocwma_font_size' )."px" ?>;"><?php echo get_option( 'ocwma_head_title' );?></button>
                </div>
                <div class="shipping-button">
                  <button class="form_option_shipping" data-id="<?php echo $user_id; ?>" style="background-color: <?php echo get_option( 'ocwma_btn_bg_clr' ) ?>; color: <?php echo get_option( 'ocwma_font_clr' ) ?>; padding: <?php echo get_option( 'ocwma_btn_padding' )?>; font-size: <?php echo get_option( 'ocwma_font_size' )."px" ?>;"><?php echo get_option( 'ocwma_head_title_ship' );?></button>
                </div>
            </div>
              <?php      
          }

          function ocwma_billing_popup_open() {

                  $user_id = sanitize_text_field($_REQUEST['popup_id_pro']);
                  $edit_id =sanitize_text_field( $_REQUEST['eid-bil']);
                
                    global $wpdb;
                    $tablename=$wpdb->prefix.'ocwma_billingadress'; 
                    if(empty($edit_id)){

                    $user = $wpdb->get_results( "SELECT count(*) as count FROM {$tablename} WHERE type='billing'  AND userid=".$user_id );   
                    $save_adress=$user[0]->count;
                    $max_count= get_option('ocwma_max_adress');
                      if($save_adress >= $max_count){
                        echo '<div class="ocwma_modal-content">';
                        echo '<span class="ocwma_close">&times;</span>';     
                        echo "<h3 class='ocwma_border'>you add maximum  ".get_option('ocwma_max_adress')." address ! !</h3>";   
                        echo '</div>';
                        echo '</div>';

                      }else{
                        echo '<div class="ocwma_modal-content">';
                        echo '<span class="ocwma_close">&times;</span>'; 
                        
                          $address_fields = wc()->countries->get_address_fields(get_user_meta(get_current_user_id(), 'billing_country', true));
                  
                          ?>
                            <form method="post">
                                <div class="ocwma_woocommerce-address-fields">
                                    <div class="ocwma_woocommerce-address-fields_field-wrapper">
                                        
                                           <input type="hidden" name="type"  value="billing">
                                            <b>reference name:</b> <input type="text" name="referece_filed">
                                        <?php
                                          foreach ($address_fields as $key => $field) {   
                                            woocommerce_form_field($key, $field, wc_get_post_data_by_key($key));
                                          }
                                        ?>
                                    </div>
                                    <p>
                                     <button type="submit" name="add_billing" class="button" value="ocwqv_save_option"><?php esc_html_e('save address', 'fr-address-book-for-woocommerce') ?></button>   
                                    </p>
                                </div>
                            </form>
                          <?php    
                        echo '</div>';
                        echo '</div>';
                      }
                   }else{
                      // echo $edit_id;
                      echo '<div class="ocwma_modal-content">';
                      echo '<span class="ocwma_close">&times;</span>'; 
                      $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='billing' AND userid=".$user_id." AND id=".$edit_id);
                      $user_data = unserialize($user[0]->userdata);
                        $address_fields = wc()->countries->get_address_fields(get_user_meta(get_current_user_id(), 'billing_country', true));
                        ?>
                          <form method="post">
                              <div class="ocwma_woocommerce-address-fields">
                                  <div class="ocwma_woocommerce-address-fields_field-wrapper">
                                         <input type="hidden" name="userid"  value="<?php echo $user_id ?>">
                                         <input type="hidden" name="edit_id"  value= "<?php echo  $edit_id ?>">
                                         <input type="hidden" name="type"  value="billing">
                                          <b>reference name:</b> <input type="text" name="referece_filed" value="<?php echo $user_data['reference_field'] ?>">
                                      <?php
                                        foreach ($address_fields as $key => $field) {  
                                              woocommerce_form_field($key, $field, $user_data[$key]);
                                        }
                                      ?>
                                  </div>
                                  <p>
                                   <button type="submit" name="add_billing_edit" class="button" value="ocwqv_save_option"><?php esc_html_e('Add address', 'fr-address-book-for-woocommerce') ?></button>   
                                  </p>
                              </div>
                          </form>
                        <?php    
                      echo '</div>';
                      echo '</div>';
                  }
              die();   
          }

          function ocwma_shipping_popup_open() {

            $user_id =sanitize_text_field( $_REQUEST['popup_id_pro']);
            $edit_id = sanitize_text_field($_REQUEST['eid-ship']);
          //echo $edit_id;
            global $wpdb;
                $tablename=$wpdb->prefix.'ocwma_billingadress'; 
            if(empty($edit_id)){
              $user = $wpdb->get_results( "SELECT count(*) as count FROM {$tablename} WHERE type='shipping'  AND userid=".$user_id );   
                  $save_adress=$user[0]->count;
                  $max_count= get_option('ocwma_max_adress');
                  if($save_adress >= $max_count){
                    echo '<div class="ocwma_modal-content">';
                    echo '<span class="ocwma_close">&times;</span>';     
                    echo "<h3 class='ocwma_border'>you add maximum  ".get_option('ocwma_max_adress')." address ! !</h3>";
                    echo '</div>';
                    echo '</div>';
                  }else{
                    echo '<div class="ocwma_modal-content">';
                    echo '<span class="ocwma_close">&times;</span>'; 
                      $countries = new WC_Countries();
                        if ( ! isset( $country ) ) {
                          $country = $countries->get_base_country();
                        }
                        if ( ! isset( $user_id ) ) {
                          $user_id = get_current_user_id();
                        }
                        $address_fields = WC()->countries->get_address_fields( $country, 'shipping_' );
                      ?>
                        <form method="post">
                            <div class="ocwma_woocommerce-address-fields">
                                <div class="ocwma_woocommerce-address-fields_field-wrapper">
                                        <input type="hidden" name="type"  value="shipping">
                                        <b>reference name:</b> <input type="text" name="referece_filed">
                                      <?php
                                      foreach ($address_fields as $key => $field) {  
                                         woocommerce_form_field($key, $field, wc_get_post_data_by_key($key));         
                                      }
                                    ?>
                                </div>
                                <p>
                                 <button type="submit" name="add_shipping" class="button" value="ocwqv_save_optionn"><?php esc_html_e('save address', 'address-book-for-woocommerce') ?></button>   
                                </p>
                            </div>
                        </form>
                      <?php    
                    echo '</div>';
                    echo '</div>'; 
                  }  
            }else{
              echo '<div class="ocwma_modal-content">';
              echo '<span class="ocwma_close">&times;</span>'; 
              $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='shipping' AND userid=".$user_id." AND id=".$edit_id);
              $user_data = unserialize($user[0]->userdata);
              $countries = new WC_Countries();
                  if ( ! isset( $country ) ) {
                    $country = $countries->get_base_country();
                  }
                  if ( ! isset( $user_id ) ) {
                    $user_id = get_current_user_id();
                  }
                  $address_fields = WC()->countries->get_address_fields( $country, 'shipping_' );
                ?>
                  <form method="post">
                      <div class="ocwma_woocommerce-address-fields">
                          <div class="ocwma_woocommerce-address-fields_field-wrapper">
                                <input type="hidden" name="type"  value="shipping">
                                    <input type="hidden" name="userid"  value="<?php echo $user_id ?>">
                                  <input type="hidden" name="edit_id"  value= "<?php echo $edit_id ?>">
                                  <b>reference name:</b> <input type="text" name="referece_filed" value="<?php echo $user_data['reference_field'] ?>">
                                <?php
                                foreach ($address_fields as $key => $field) { 
                                 woocommerce_form_field($key, $field, $user_data[$key]);
                                }
                              ?>
                          </div>
                          <p>
                           <button type="submit" name="add_shipping_edit" class="button" value="ocwqv_save_optionn"><?php esc_html_e('save address', 'address-book-for-woocommerce') ?></button>   
                          </p>
                      </div>
                  </form>
                <?php    
              echo '</div>';
              echo '</div>';  
                  }       
            die();
          }
           /* billigdata */
          function ocwma_billing_data_select(){
            $user_id = get_current_user_id();
            $select_id = sanitize_text_field($_REQUEST['sid']);
            global $wpdb;
              $tablename=$wpdb->prefix.'ocwma_billingadress'; 
              $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='billing' AND userid=".$user_id." AND id=".$select_id);
              $user_data = unserialize($user[0]->userdata);
             echo json_encode($user_data);
             exit();
          }
          /* shipping */
            function ocwma_shipping_data_select(){
            $user_id = get_current_user_id();
            $select_id = sanitize_text_field($_REQUEST['sid']);
            global $wpdb;
              $tablename=$wpdb->prefix.'ocwma_billingadress'; 
              $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='shipping' AND userid=".$user_id." AND id=".$select_id);
              $user_data = unserialize($user[0]->userdata);
             echo json_encode($user_data);
             exit();
          }
      
      
          

          function OCWMA_all_billing_address(){
            $user_id  = get_current_user_id();
            global $wpdb;
            $tablename=$wpdb->prefix.'ocwma_billingadress';  
           ?>
           <select class="ocwma_select">
            <option>...choose address...</option>
            <?php
               $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='billing' AND userid=".$user_id);
                     foreach($user as $row){    
                      $userdata_bil=$row->userdata;
                      $user_data = unserialize($userdata_bil);

                      ?> <option value="<?php echo $row->id ?>">  <?php echo $user_data['reference_field'] ?></option><?php }
                      ?>
            </select>
            <button class="form_option_billing" data-id="<?php echo $user_id; ?>" style="background-color: <?php echo get_option( 'ocwma_btn_bg_clr' ) ?>; color: <?php echo get_option( 'ocwma_font_clr' ) ?>; padding: <?php echo get_option( 'ocwma_btn_padding' )?>; font-size: <?php echo get_option( 'ocwma_font_size' )."px" ?>;"><?php echo get_option( 'ocwma_head_title' );?></button>
 
            <?php
          }
        

          function   OCWMA_all_shipping_address(){
            $user_id  = get_current_user_id();
            global $wpdb;
            $tablename=$wpdb->prefix.'ocwma_billingadress';  
          ?>
           <select class="ocwma_select_shipping">
            <option>...choose address...</option>
            <?php
               $user = $wpdb->get_results( "SELECT * FROM {$tablename} WHERE type='shipping' AND userid=".$user_id);
                     foreach($user as $row){    
                      $userdata_bil=$row->userdata;
                      $user_data = unserialize($userdata_bil);

                      ?> <option value="<?php echo $row->id ?>">  <?php echo $user_data['reference_field'] ?></option><?php }
                      ?>
            </select>
            <button class="form_option_shipping" data-id="<?php echo $user_id; ?>" style="background-color: <?php echo get_option( 'ocwma_btn_bg_clr' ) ?>; color: <?php echo get_option( 'ocwma_font_clr' ) ?>; padding: <?php echo get_option( 'ocwma_btn_padding' )?>; font-size: <?php echo get_option( 'ocwma_font_size' )."px" ?>;"><?php echo get_option( 'ocwma_head_title_ship' );?></button>
 
            <?php
          }

          function OCWMA_save_options(){
              global $wpdb; 
              $tablename=$wpdb->prefix.'ocwma_billingadress';
              if(isset($_REQUEST['add_billing'])) {
                  $ocwma_userid= get_current_user_id();   
                  $billing_data=array('reference_field' =>sanitize_text_field($_REQUEST['referece_filed']),
                      'billing_first_name' =>sanitize_text_field($_REQUEST['billing_first_name']),
                      'billing_last_name' =>sanitize_text_field($_REQUEST['billing_last_name']),
                      'billing_company' =>sanitize_text_field($_REQUEST['billing_company']),
                      'billing_country' =>sanitize_text_field($_REQUEST['billing_country']),
                      'billing_address_1' =>sanitize_text_field($_REQUEST['billing_address_1']),
                      'billing_address_2' =>sanitize_text_field($_REQUEST['billing_address_2']),
                      'billing_city' =>sanitize_text_field($_REQUEST['billing_city']),
                      'billing_state' =>sanitize_text_field($_REQUEST['billing_state']),
                      'billing_postcode' =>sanitize_text_field($_REQUEST['billing_postcode']),
                      'billing_phone' =>sanitize_text_field($_REQUEST['billing_phone']),
                      'billing_email' =>sanitize_text_field($_REQUEST['billing_email'] ));
                       $billing_data_serlized=serialize( $billing_data );
                       $wpdb->insert($tablename, array(
                      'userid' =>$ocwma_userid,
                      'userdata' =>$billing_data_serlized,
                      'type' =>sanitize_text_field($_REQUEST['type']), 
                  )); 
                  // exit();   
              } 
              if(isset($_REQUEST['add_shipping'])) {
                  $ocwma_userid= get_current_user_id();   
                  $shipping_data=array('reference_field' =>sanitize_text_field($_REQUEST['referece_filed']),
                      'shipping_first_name' =>sanitize_text_field($_REQUEST['shipping_first_name']),
                      'shipping_last_name' =>sanitize_text_field($_REQUEST['shipping_last_name']),
                      'shipping_company' =>sanitize_text_field($_REQUEST['shipping_company']),
                      'shipping_country' =>sanitize_text_field($_REQUEST['shipping_country']),
                      'shipping_address_1' =>sanitize_text_field($_REQUEST['shipping_address_1']),
                      'shipping_address_2' =>sanitize_text_field($_REQUEST['shipping_address_2']),
                      'shipping_city' =>sanitize_text_field($_REQUEST['shipping_city']),
                      'shipping_state' =>sanitize_text_field($_REQUEST['shipping_state']),
                      'shipping_postcode' =>sanitize_text_field($_REQUEST['shipping_postcode']));
                       $shipping_data_serlized=serialize( $shipping_data );
                       $wpdb->insert($tablename, array(
                      'userid' =>$ocwma_userid,
                      'userdata' =>$shipping_data_serlized,
                      'type' =>sanitize_text_field($_REQUEST['type']), 
                  ));   
              } 
              

            
              if(isset($_REQUEST['add_billing_edit'])) {

                $edit_id = sanitize_text_field($_REQUEST['edit_id']);
                $ocwma_userid= get_current_user_id();     
                $billing_data=array(
                  'reference_field' =>sanitize_text_field($_REQUEST['referece_filed']),
                  'billing_first_name' =>sanitize_text_field($_REQUEST['billing_first_name']),
                  'billing_last_name' =>sanitize_text_field($_REQUEST['billing_last_name']),
                  'billing_company' =>sanitize_text_field($_REQUEST['billing_company']),
                  'billing_country' =>sanitize_text_field($_REQUEST['billing_country']),
                  'billing_address_1' =>sanitize_text_field($_REQUEST['billing_address_1']),
                  'billing_address_2' =>sanitize_text_field($_REQUEST['billing_address_2']),
                  'billing_city' =>sanitize_text_field($_REQUEST['billing_city']),
                  'billing_state' =>sanitize_text_field($_REQUEST['billing_state']),
                  'billing_postcode' =>sanitize_text_field($_REQUEST['billing_postcode']),
                  'billing_phone' =>sanitize_text_field($_REQUEST['billing_phone']),
                  'billing_email' =>sanitize_text_field($_REQUEST['billing_email'] ));
                  $billing_data_serlized=serialize( $billing_data );  
                  $condition=array(
                          'id'=>$edit_id,
                          'userid' =>$ocwma_userid,
                          'type' =>sanitize_text_field($_REQUEST['type'])
                        );  
                      $wpdb->update($tablename,array( 
                      'userdata' =>$billing_data_serlized),$condition);  

              }   
              if( isset($_REQUEST['action']) && $_REQUEST['action']=="delete_ocma"){
                  $delete_id=sanitize_text_field($_REQUEST['did']);
                  $sql = "DELETE  FROM {$tablename} WHERE id='".$delete_id."'" ;
                  $wpdb->query($sql);
                  wp_safe_redirect( wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' ) ) );
                  exit;
              }  
               if(isset($_REQUEST['add_shipping_edit'])) {
                 $edit_id = sanitize_text_field($_REQUEST['edit_id']);
                 $ocwma_userid= get_current_user_id();     
                 $shipping_data=array(
                   'reference_field' =>sanitize_text_field($_REQUEST['referece_filed'] ),
                   'shipping_first_name' =>sanitize_text_field($_REQUEST['shipping_first_name']),
                   'shipping_last_name' =>sanitize_text_field($_REQUEST['shipping_last_name']),
                   'shipping_company' =>sanitize_text_field($_REQUEST['shipping_company']),
                   'shipping_country' =>sanitize_text_field($_REQUEST['shipping_country']),
                   'shipping_address_1' =>sanitize_text_field($_REQUEST['shipping_address_1']),
                   'shipping_address_2' =>sanitize_text_field($_REQUEST['shipping_address_2']),
                  'shipping_city' =>sanitize_text_field($_REQUEST['shipping_city']),
                  'shipping_state' =>sanitize_text_field($_REQUEST['shipping_state']),
                   'shipping_postcode' =>sanitize_text_field($_REQUEST['shipping_postcode']));
                 
                  $shipping_data_serlized=serialize( $shipping_data );  
                
                   $condition=array(
                          'id'=>$edit_id,
                          'userid' =>$ocwma_userid,
                          'type' =>sanitize_text_field($_REQUEST['type'])
                       );  
                     $wpdb->update($tablename,array( 
                      'userdata' =>$shipping_data_serlized),$condition);  

              }   
              if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete-ship"){
                  $delete_id=sanitize_text_field($_REQUEST['did-ship']);
                  $sql = "DELETE  FROM {$tablename} WHERE id='".$delete_id."'" ;
                  // echo $sql;
                  // exit();
                  $wpdb->query($sql);
                  wp_safe_redirect( wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' ) ) );
                  exit;
              }             
          }
          
          function init() {
            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();
            $tablename = $wpdb->prefix.'ocwma_billingadress'; 
            $sql = "CREATE TABLE $tablename (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                userid TEXT NOT NULL,
                userdata TEXT NOT NULL,
                type TEXT NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_filter( 'woocommerce_account_menu_items', array( $this, 'wc_address_book_add_to_menu' ),10);
            add_action( 'woocommerce_account_edit-address_endpoint',array( $this, 'misha_my_account_endpoint_content'));
            add_action('wp_footer', array( $this, 'ocwqv_popup_div_footer' ));   
            add_action('wp_ajax_productscommentsbilling', array( $this, 'ocwma_billing_popup_open' ));
            add_action('wp_ajax_nopriv_productscommentsbilling', array( $this, 'ocwma_billing_popup_open'));
            add_action('wp_ajax_productscommentsshipping', array( $this, 'ocwma_shipping_popup_open' ));
            add_action('wp_ajax_nopriv_productscommentsshipping', array( $this, 'ocwma_shipping_popup_open'));
            add_action('woocommerce_before_checkout_billing_form', array( $this, 'OCWMA_all_billing_address'));
            add_action('woocommerce_before_checkout_shipping_form', array( $this, 'OCWMA_all_shipping_address'));
            add_action('wp_ajax_productscommentsbilling_select', array( $this, 'ocwma_billing_data_select' ));
            add_action('wp_ajax_nopriv_productscommentsbilling_select', array( $this,'ocwma_billing_data_select'));
            add_action('wp_ajax_productscommentsshipping_select', array( $this, 'ocwma_shipping_data_select' ));
            add_action('wp_ajax_nopriv_productscommentsshipping_select', array( $this,'ocwma_shipping_data_select'));
            
            
            add_action( 'init',  array($this, 'OCWMA_save_options'));
          }
          

          public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
            return self::$instance;
          } 
    }

 OCWMA_front::instance();
}