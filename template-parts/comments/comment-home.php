<?php 
$comments = Benfrom09\CBD\WooHelper::get_last_woocommerce_comments(4);
$i = 0;
?>
<div class="cbd-comments show-block">
    <?php foreach ($comments as $comment): 
        $i++;
        $index = $i % 2 === 0 ? '2' : '1';
        ?>
        
    <article class="cbd-comment p-relative show-block-<?php echo $index;?>">
        <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_icon('comment.png')) ?>" alt="">
        <p>
        <?php 
            echo esc_html($comment->comment_content);
        ?>
        </p>
        <div class="name">
            <span><?php 
            echo esc_html($comment->comment_author);
        ?></span>
        </div>
    </article>
    <?php endforeach; ?>
</div>
