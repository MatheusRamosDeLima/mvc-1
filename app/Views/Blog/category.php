<h1>Posts about <span class="category-name"><?= $categoryName ?></span></h1>
<section class="posts">
    <?php if ($doesPostsExist): ?>
        <?php foreach ($posts as $post): ?>
            <a href="/blog/post/<?= $post->id ?>" class="post">
                <h2><?= $post->name ?></h2>
                <p>Categoria: <?= $categoryName ?></p>
            </a>
        <?php endforeach ?>
    <?php endif ?>
    <?php if (!$doesPostsExist): ?>
        <div class="empty-category">
            <span>The <?= $categoryName ?> category is empty!</span>
        </div>
    <?php endif ?>
</section>
<style>
    .category-name {
        text-transform: capitalize;
    }
</style>