<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php if (isset($pageTitle)) {
                echo $pageTitle;
            } ?> | Frankie's Farm</title>
    <meta name="description" content="Home Page">
    <meta name="author" content="Jessica Ingebrigtsen">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/frankies/css/styles.css">


</head>

<body>
    <div class="contain">
        <a href='/frankies' title="Frankie's Farm Home Page"><img src="/frankies/images/site/frankieLogo.png" alt="Frankie's Farm Logo"></a>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <?php include 'nav.php'; ?>
            </div>
        </nav>
        <main>