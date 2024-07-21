<h1>All posts!</h1>
<section class="categories">
    <?php foreach ($categories as $category): ?>
            <a href="/blog/category/<?= $category ?>" class="category">
                <h2><?= $category ?></h2>
            </a>
        <?php endforeach ?>
</section>
<section class="posts">
    <?php foreach ($posts as $post): ?>
        <a href="/blog/post/<?= $post->rowid ?>" class="post">
            <h2><?= $post->title ?></h2>
            <p><?= $post->category ?></p>
        </a>
    <?php endforeach ?>
</section>
<style>
    .categories {
        display: flex;
        align-items: center;
        justify-content: start;
        gap: 30px;
    }
</style>