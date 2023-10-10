<?php

/**
 * Footer CONTACT FORM
 *
 * Send mail to client - AJAX function - contact form
 */
function contact_form(){

    $return_data = array();
    $return_data['status']	= 0;

    //get post data
    $subject    =	clean_variable($_POST['contact-subject']);
    $email		=	clean_variable($_POST['contact-email']);
    $telephone  =	clean_variable($_POST['contact-phone']);
    $message    =	clean_variable($_POST['contact-message']);

    $nonce 		=	( wp_verify_nonce( $_POST['contact-nonce'], "contact_form_check" ) )? true : false;

    if( filter_var($email, FILTER_VALIDATE_EMAIL) && trim($subject) != '' && $nonce ){


        //set up to
        $contact_email = 'info@dcc4web.com';

        $options = get_option('wedevs_basics');
        if( isset($options['contact_form_email']) && $options['contact_form_email'] != '' ){
            $contact_email = $options['contact_form_email'];
        }

        $headers[] = 'From: Web Stranica <info@obrtivana.hr>';
        $headers[] = 'Reply-To: Korisnik <' . $email . '>';

        $message = '<p>
                        <strong>Naslov poruke:</strong> ' . $subject . '<br>
                        <strong>Email:</strong> ' . $email . '<br>
                        <strong>Telefon:</strong> ' . $telephone . '<br>
                        <strong>Poruka:</strong><br>
                        ' . $message . '
                        <br><br><br><strong>Pošiljatelj poruke je prihvatio izjavu o privatnosti.</strong><br>
                    </p>';

        add_filter( 'wp_mail_content_type', 'set_html_content_type' );
        $check = wp_mail( $contact_email, $subject . ' - Poruka sa stranice obrtivana.hr', $message, $headers );
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

        $return_data['status'] = 1;

    }
    else{
        $return_data['status'] = 2;
    }

    echo json_encode($return_data);

}

add_action( 'wp_ajax_nopriv_contact_form', 'contact_form' );
add_action( 'wp_ajax_contact_form', 'contact_form' );