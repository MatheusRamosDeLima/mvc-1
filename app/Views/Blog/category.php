<h1>Posts about <span class="category"><?= $category ?></span></h1>
<section class="posts">
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <a href="/blog/post/<?= $post->rowid ?>" class="post">
                <h2><?= $post->title ?></h2>
                <p>Categoria: <?= $post->category ?></p>
            </a>
        <?php endforeach ?>
    <?php endif ?>
    <?php if (!$posts): ?>
        <div class="empty-category">
            <span>The <?= $category ?> category is empty!</span>
        </div>
    <?php endif ?>
</section>
<style>
    .category {
        text-transform: capitalize;
    }
</style>