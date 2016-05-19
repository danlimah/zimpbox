<?php

/**
 *
 * Mevo Comment Form
 *
 * @package mevo
 * @since 1.0.0
 * @version 1.0.0
 */

if ( post_password_required() ) { return; }
?>
  <?php if ( have_comments() ) : ?>
    <div class="comment-list">
      <?php wp_list_comments( array( 'callback' => 'mevo_comment' ) ); ?>
    </div>
  <?php endif; ?>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'mevo' ); ?></h1>
      <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'mevo' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'mevo' ) ); ?></div>
    </nav>
  <?php endif; ?>

<?php
  $fields =  array(
    'author' => '<input type="text" name="author" placeholder="Name" class="f-input" tabindex="1" required="" />',
    'email'  => '<input type="email" name="email" placeholder="Email" class="f-input" tabindex="2" required="" />',
  );
  $comments_args = array(
    'id_form' => 'form-id',
    'fields'  =>
      $fields,
      'comment_field' => '<textarea class="f-area" required="" name="comment" placeholder="Comment"></textarea>',
      'must_log_in' => '',
      'logged_in_as' => '',
      'comment_notes_before' => '',
      'comment_notes_after' => '',
      'title_reply' => sprintf( esc_html__( 'add a comment', 'mevo' ) ),
      'title_reply_to' => esc_html__('Leave a Reply to %s', 'mevo' ),
      'cancel_reply_link' => esc_html__('Cancel', 'mevo' ),
      'label_submit' => esc_html__('Submit', 'mevo' ),
      'submit_field'  => '<div class="input-wrapper clearfix">%1$s %2$s<span id="message"></span></div>',
  );

  print '<div class="row"><div class="col-xs-12 col-sm-8">';
    comment_form( $comments_args );
  print '</div></div>';
?>
