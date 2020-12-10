<!DOCTYPE html>
<html lang="en">
<head>
    <title>Promocodes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark ">
    <div class="container">
        <a class="navbar-brand" href="/">Promocodes</a>
        <div class="ml-auto">
            <?php if ($user): ?>
                <a href="/logout" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="/signin" class="btn btn-primary">Sign In</a>
                <a href="/signup" class="btn btn-success">Sign Up</a>
            <?php endif; ?>
        </div>
</nav>
<main role="main" class="container">
    <?php echo $flashMessages; ?>
    <?php require $templatePath; ?>
</main>
</body>
</html>
