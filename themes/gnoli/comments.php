<?php

/**
 *
 * Comment Form
 *
 * @package gnoli
 * @since 1.0.0
 * @version 1.1.0
 */

if ( post_password_required() ) { return; }
?>


  <?php if ( have_comments() ) : ?>
    <h3 class="comments-title"><?php _e( 'Comments', 'gnoli' ); ?></h3>
    <?php wp_list_comments( array( 'callback' => 'gnoli_comment', 'style' => 'ul' ) ); ?>
  <?php endif; ?>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'gnoli' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gnoli' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gnoli' ) ); ?></div>
      </nav>
    <?php endif; ?>


<?php

    $fields =  array(
      'author' => '<input id="name" type="text" name="author" placeholder="Name" size="30" tabindex="1" />',
      'email'  => '<input id="email" type="email" name="email" placeholder="E-mail" size="30" tabindex="2" />',
    );

    $comments_args = array(
      'id_form' => 'contactform',
      'fields'  =>
        $fields,
        'comment_field' => '<textarea id="comment" aria-required="true" name="comment" placeholder="Tell us what you think" rows="8" cols="60" tabindex="3"></textarea>',
        'must_log_in' => '',
        'logged_in_as' => '',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'title_reply' => '<strong>' . sprintf(__( 'Leave a Comment', 'gnoli') ) . '</strong>',
        'title_reply_to' => __('Leave a Reply to %s', 'gnoli'),
        'cancel_reply_link' => __('Cancel', 'gnoli'),
        'label_submit' => __('Send', 'gnoli'),
        'submit_field'  => '<div class="input-wrapper clearfix">%1$s %2$s<span id="message"></span></div>',
    );

    print '<div class="comments-form">';
      comment_form( $comments_args );
    print '</div>';
?>
