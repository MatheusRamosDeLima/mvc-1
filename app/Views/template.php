<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->viewTitle ?></title>
</head>
<body>
    <header>
        <h1>Template</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/news">News</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php $this->view($viewName, $modelData) ?>
    </main>
    <footer>
        <p>Copyright...</p>
    </footer>
</body>
</html>