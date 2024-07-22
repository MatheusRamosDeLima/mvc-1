<h1>Home Page</h1>
<section>
    <?php if (!$posts): ?>
        <p>There aren't posts.</p>
    <?php endif ?>
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <a href="/blog/post/<?= $post->rowid ?>">
                <h2><?= $post->title ?></h2>
                <span><?= $post->category ?></span>
            </a>
        <?php endforeach ?>
    <?php endif ?>
</section>