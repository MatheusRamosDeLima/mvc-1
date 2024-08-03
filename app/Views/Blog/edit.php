<h1>Edit post</h1>
<form action="/blog/edit/<?= $post->rowid ?>" method="post">
    <div>
        <div>
            <label for="input-title">Title</label>
            <input type="text" name="title" id="input-title" value="<?= $post->title ?>">
        </div>
        <div>
            <label for="input-content">Content</label>
            <textarea name="content" id="input-content"><?= $post->content ?></textarea>
        </div>
        <div>
            <label for="select-category">Category</label>
            <select name="category" id="select-category">
                <option value="leitura">Leitura</option>
                <option value="comida">Comida</option>
                <option value="esporte">Esporte</option>
            </select>
        </div>
    </div>
    <input type="submit" onclick="validate(); return canContinue;" value="Edit">
</form>
<div id="data-error"></div>
<script defer>
    const selectCategory = document.getElementById("select-category");
    const categoryOptions = selectCategory.getElementsByTagName("option");

    for (let i = 0; i < categoryOptions.length; i++) {
        if (categoryOptions[i].value === "<?= $post->category ?>") categoryOptions[i].selected = true;
    }
</script>