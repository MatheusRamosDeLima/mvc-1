<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/_template.css">
    <?php if ($view->getCss() !== null): ?>
        <?php if (gettype($view->getCss()) === 'string'): ?>
            <link rel="stylesheet" href="/css/<?= $view->getCss() ?>.css">
        <?php endif ?>
        <?php if (gettype($view->getCss()) === 'array'): ?>
            <?php foreach ($view->getCss() as $css): ?>
                <link rel="stylesheet" href="/css/<?= $css ?>.css">
            <?php endforeach ?>
        <?php endif ?>
    <?php endif ?>
    <?php if ($view->getJs() !== null): ?>
        <?php if (gettype($view->getJs()) === 'string'): ?>
            <script src="/js/<?= $view->getJs() ?>.js" defer></script>
        <?php endif ?>
        <?php if (gettype($view->getJs()) === 'array'): ?>
            <?php foreach ($view->getJs() as $js): ?>
                <script src="/js/<?= $js ?>.js" defer></script>
            <?php endforeach ?>
        <?php endif ?>
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
        <?php $this->view($view->getPath(), $modelData) ?>
    </main>
    <footer>
        <p>Copyright...</p>
    </footer>
</body>
</html>