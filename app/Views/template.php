<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/template.css">
    <?php if($view->getCss() !== null): ?>
        <link rel="stylesheet" href="/css/<?= $view->getCss() ?>.css">
    <?php endif ?>
    <title><?= $view->getTitle() ?></title>
</head>
<body>
    <header>
        <h1>Template</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/blog">Blog</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php $this->view($view->getName(), $modelData) ?>
    </main>
    <footer>
        <p>Copyright...</p>
    </footer>
</body>
</html>