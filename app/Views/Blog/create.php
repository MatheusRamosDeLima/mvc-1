<h1>Create post</h1>
<form action="/blog/create" method="post">
    <div>
        <div>
            <label for="input-title">Title</label>
            <input type="text" name="title" id="input-title">
        </div>
        <div>
            <label for="input-content">Content</label>
            <textarea name="content" id="input-content"></textarea>
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
    <input type="submit" onclick="validate(); return canContinue;" value="Create">
</form>
<div id="data-error"></div>