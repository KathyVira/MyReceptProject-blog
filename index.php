<?php
require_once('app/functions.php');
// unsetMs();
if (!isset($_SESSION)) {
    startMySession();
}
// DB חיבור בשביל להוציא את הפוסטים שורסמו
$link = db_connect();
mysqli_set_charset($link, "utf8");
$sql = "SELECT posts.*, users.name FROM posts JOIN users on posts.uid = users.id";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}




require_once('tpl/header.php');
require_once('tpl/mainPanel.php');
?>



<div class="container">

    <!-- <div class="row">
        <div class="col-md-8 mb-5">
            <h2>What We Do</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
            <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
        </div>
        <div class="col-md-4 mb-5">
            <h2>Contact Us</h2>
            <hr>
            <address>
                <strong>Start Bootstrap</strong>
                <br>3481 Melrose Place
                <br>Beverly Hills, CA 90210
                <br>
            </address>
            <address>
                <abbr title="Phone">P:</abbr>
                (123) 456-7890
                <br>
                <abbr title="Email">E:</abbr>
                <a href="mailto:#">name@example.com</a>
            </address>
        </div>
    </div>
    /.row -->

    <div class="row">
        <!-- <div class="col-md-4 mb-5">
            <div class="card ">
                <img class="card-img-top" src="img/blog-img/1.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
            </div>
        </div> -->
        <ul class="search_result"></ul>

        <?php if ($data) : ?>
            <?php foreach ($data as $row) : ?>
                <div class="col-md-12 p-2">
                    <div class="card ">
                        <!-- <img class="card-img-top" src="img/blog-img/1.jpg" alt=""> -->
                        <div class="card-body">
                            <h4 class="card-title"><?= htmlspecialchars($row['title']); ?></h4>
                            <p class="card-text"><?= htmlspecialchars($row['post']); ?></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">Author: <?= htmlspecialchars($row['name']); ?></p>


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->



<?php require_once('tpl/footer.php') ?>