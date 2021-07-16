<?php
$wp_list_comments_args = array(
    "max-depth" => 3,
    "type" => "comment",
    "avatar_size" => 64,
);

if (comments_open()) { ?>
    <h3 class="alert alert-secondary border-0 h4 mt-5" role="alert"><?php comments_number("0 Comments", "1 Comment", "% Comments"); ?></h3>
<?php
    if (have_comments()) :
        echo "<ul class='list-unstyled comments-list'>";
        wp_list_comments($wp_list_comments_args);
        echo "</ul>";
    else :
        echo '<p class="alert alert-light border-0" role="alert">There is no comments on this article. Be the first one.</p>';
    endif;
    echo '<hr class="my-5" />';
    $comment_form_args = array( //This is comment form arguments
        'fields' => array(
            'author' => '<div class="mb-3">
            <label for="author" class="form-label">Name*</label>
            <input type="text" class="form-control" id="nameInput" placeholder="Enter your name" name="author" id="author" maxlength="245" required="required">
            </div>',
            'email' => '<div class="mb-3">
            <label for="email" class="form-label">Email*</label>
            <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" name="email" id="email" maxlength="100" required="required">
            </div>',
            'url' => null,
            'cookies' => '<div class="form-check">
            <input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" checked="checked">
            <label class="form-check-label" for="wp-comment-cookies-consent">
                Save my name, email, and website in this browser for the next time I comment.
            </label>
            </div>',
        ),
        'comment_field' => '<div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" id="commentInput" rows="8" cols="4" resize="none" name="comment" id="comment" maxlength="65525" required="required" placeholder="Enter your comment here"></textarea>
        </div>',
        'submit_button' => '<input name="submit" id="submit" type="submit" class="btn btn-primary submit mt-3" value="Post Comment" />',
        'title_reply' => 'Leave a Comment',
        'title_reply_to' => 'Replied to %s'
    );

    comment_form($comment_form_args);
} else {
    echo "<p>Comments are disabled in this article.</p>";
}

?>