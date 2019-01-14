<?php $todoForm = get_post_meta( $post->ID, 'post_todoTextarea0', true );  ?>
<?php if (isset($postmeta)) :
    for ($k=0; $k < $counttodosubmit; $k++) {
        $post_todoTextarea = 'post_todoTextarea'.$k;
        if (isset($postmeta[$post_todoTextarea][0])) : ?>
            <p>To do: <span>
            <?= $postmeta[$post_todoTextarea][0]; ?>
            </span></p>
<?php endif; } endif; ?>

<div class="card card-body">
    <h3>Please fill your To Do</h3>
    <form action="<?php the_permalink(); ?>" id="todoForm" name="todoForm" method="post">
        <div>
            <label for="todoTextarea">Todo Form</label>
            <textarea name="todoTextarea" id="todoTextarea" cols="30" rows="10"></textarea>
        </div>
        <button type="submit">Save</button>
        <input type="hidden" name="submittedtodo" id="submittedtodo" value="true" />
    </form>
</div>