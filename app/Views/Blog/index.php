<h1>All posts!</h1>
<section class="categories">
    <?php foreach ($categories as $category): ?>
            <a href="/blog/category/<?= $category->name ?>" class="category">
                <h2><?= $category->name ?></h2>
            </a>
        <?php endforeach ?>
</section>
<section class="posts">
    <?php foreach ($posts as $post): ?>
        <a href="/blog/post/<?= $post->id ?>" class="post">
            <h2><?= $post->name ?></h2>
            <p><?= $postCategory($post) ?></p>
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