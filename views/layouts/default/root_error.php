<?php
/** @var AppError $error */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
</head>
<body>
<h1>Error in Controller flow</h1>
<h3>Message: <?= $error->name; ?></h3>
<h3>File: <?= $error->file ?></h3>
<h3>Line: <?= $error->line ?></h3>
</body>
</html>
