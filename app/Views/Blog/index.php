<h1>Posts</h1>
<section>
    <a href="/blog/create" style="font-size: 25px;">Create post</a>
</section>
<section class="categories">
    <?php if ($categories): ?>
        <?php foreach ($categories as $category): ?>
            <a href="/blog/category/<?= $category ?>" class="category">
                <h2><?= $category ?></h2>
            </a>
        <?php endforeach ?>
    <?php endif ?>
</section>
<section class="posts">
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div style="display: flex; gap: 20px; background-color: #eeeeee; width: fit-content">
                <div>
                    <a href="/blog/post/<?= $post->rowid ?>" class="post">
                        <h2><?= $post->title ?></h2>
                        <p><?= $post->category ?></p>
                    </a>
                </div>
                <div>
                    <a href="/blog/edit/<?= $post->rowid ?>">Edit</a>
                    <div>
                        <form action="/blog/destroy/<?= $post->rowid ?>" method="post">
                            <input type="submit" name="destroy" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <?php if (!$posts): ?>
        <p>There aren't posts.</p>
    <?php endif ?>
</section>
<style>
    .categories {
        display: flex;
        align-items: center;
        justify-content: start;
        gap: 30px;
    }
</style>