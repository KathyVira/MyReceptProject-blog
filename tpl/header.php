<?php
// header("X-Frame-Options:sameorigin"); 
require_once 'app/functions.php';
// verUser(); 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Resepts Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="/js/blogjs.js "> </script>
    <script src="/js/search.js "> </script>
    <link rel="stylesheet" type="text/css" href="/scss/blog.css">
    <!-- rel="stylesheet" -->
    <link rel="stylesheet" type="text/css" href="../css/my.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <script type="text/javascript">
        $(function() {
            $(".search_button").click(function() {
                // получаем то, что написал пользователь
                var searchString = $("#search_box").val();
                // формируем строку запроса
                var data = 'search=' + searchString;
                // если searchString не пустая
                if (searchString) {
                    // делаем ajax запрос
                    $.ajax({
                        type: "POST",
                        url: "do_search.php",
                        data: data,
                        beforeSend: function(html) { // запустится до вызова запроса
                            $("#results").html('');
                            $("#searchresults").show();
                            $(".word").html(searchString);
                        },
                        success: function(html) { // запустится после получения результатов
                            $("#results").show();
                            $("#results").append(html);
                        }
                    });
                }
                return false;
            });
        });
    </script>


    <style>
        .body {
            /* padding-top: 56px; */
            height: 300px;
            margin: 0;
            padding: 0;
            /* background-color: #17a2b8; */
            /* height: 100vh; */
            /* background: url(img/core-img/bcr.jpg); */
            background-image: url(img/core-img/foodPatern02sm.png);

        }

        .jumbotron {
            /* background-color: #17a2b8; */
            background-image: url(img/core-img/beef002.png);
            background-size: cover;
        }

        .md-avatar {
            vertical-align: middle;
            width: 40px;
            height: 40px;
        }

        .navbar-dark {
            background-color: #2d2d2d;
            /* #2d2d2d */
        }

        .card,
        .jumbotron {
            /* padding: 5%; */
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
        }

        .footer {
            background-color: #2d2d2d;
            /* #2d2d2d */
        }
    </style>
</head>

<body class="body">
    <!-- <div class="divBody">  -->
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container ">
            <?php if (!empty($_SESSION['uid'])) : ?>
                <a class="navbar-brand" href="#"> <?= htmlspecialchars($_SESSION['name']); ?> Recipes Blog</a>
                <img src="img/avatar/<?= getAvatar(); ?>" alt="Avatar" class="  md-avatar rounded">

            <?php else : ?>

                <a class="navbar-brand" href="#">My Recipes Blog</a>
            <?php endif; ?>



            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            <li class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <!-- </form> -->

                    <?php if (empty($_SESSION['uid'])) : ?>
                        <li class="nav-item m-1">
                            <a class="btn btn-info navbar" href="index.php">Home</a>
                        </li>
                        <li class="nav-item m-1">
                            <a class="btn btn-info navbar " href="singIn.php">Log In</a>
                        </li>
                        <li class="nav-item m-1">
                            <a class="btn btn-info navbar" href="singUp.php">Register</a>
                        </li>
                    <?php else : ?>
                        <!-- <li class="m-1">
                             <img src="img/avatar/defoult.png" alt="Avatar" class="  md-avatar rounded-circle">
                        </li> -->
                        <li class="nav-item m-1">
                            <a class="btn btn-info navbar" href=" blog.php">My Blog</a>
                        </li>
                        <li class="nav-item m-1">
                            <a class="btn btn-info navbar" href="singout.php">Sing Out</a>
                        </li>
                    <?php endif; ?>

                    <!-- SEARCH  https://habr.com/ru/post/438382/ to JS-->
                    <!-- SEARCH  https://code-live.ru/post/custom-search-for-site-with-php-and-mysql/-->

                    <!-- <input type="search" name="query" placeholder="Search" class="form-control">
                    <button type="submit">Search</button> -->

                    <!-- <li class="nav-item m-1">
                        <form name="search" method="post" action="do_search.php">
                            <div class="input-group mb-3">
                                <!-- <input type="search" name="query" class="form-control search_box" placeholder="Recipient's username" id="search_box" aria-label="Recipient's username" aria-describedby="button-addon2"> -->
                    <!-- <input type="text" name="referal" placeholder="Живой поиск" value="" class="who"  autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info search_button" type="submit" id="button-addon2">Button</button>
                                </div>
                            </div>
                        </form>
                    </li> -->
                </ul>
        </div>
        </div>
    </nav>
    <!-- Navigation end-->


    <?php if (isset($_SESSION['ms'])) : ?>
        <div class="alert alert-success m-0 p-2 text-center ms " role="alert">
            <?= $_SESSION['ms']; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($errms)) : ?>
        <div class="alert alert-danger m-0 p-2  text-center " role="alert">
            <?= $errms; ?>
        </div>
    <?php endif; ?>