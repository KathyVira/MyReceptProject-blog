<?php 
require_once ('app/functions.php');
startMySession();
// cheking IP of user
userCheck(); 
// cheking that $_SESSION['uid'] not empty
userConect();
// if(!isset($_SESSION)) {
//   }
// userConect();
// session_start();
// unsetMs();

$link = db_connect();
mysqli_set_charset($link,"utf8");
$sql = "SELECT posts.*, users.name FROM posts JOIN users on posts.uid = users.id";
$result = mysqli_query($link,$sql);
    if ($result && mysqli_num_rows($result)>0){
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
       
    }else{
        $errms="eror to conect to db";
    }
// echo "<pre>";
// print_r ($data);

;?>
<?php require_once ('tpl/header.php');?>


<main role ="main ">
    <div class="jumbotron  bg-info"> 
        <div class="container ">
            <div class="row h-100 align-items-center ">
                <h1 class="display-3 text-white" > Hello <?=  htmlspecialchars($_SESSION['name']);?> </h1>  
            </div>
            <hr>
            <p class="text-white">Save recipes, rate favorites and join the fun!</p>
            <a class="btn btn-light btn-lg" href="add_post.php" role ="button" > Add new recipe</a>
        </div>
    </div>


<div class="container">
<!-- <div class="row"> -->
    <div class="row p-5">
        
        <?php if($data):?>
             <?php foreach($data as $row) : ?>
                 <div class="col-md-12 p-2">
                    <div class="card ">
                        <!-- <img class="card-img-top" src="img/blog-img/1.jpg" alt=""> -->
                        <div class="card-body">
                            <h4 class="card-title"><?=  htmlspecialchars($row['title']); ?></h4>
                            <p class="card-text"><?=  htmlspecialchars($row['post']); ?></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text" >Author: <?=  htmlspecialchars($row['name']); ?></p>
                           
                            
                            <?php if($_SESSION['uid'] == $row['uid'] ):?>
                                <a class="btn btn-info " href="edit_post.php?post_id=<?= htmlspecialchars($row['id']);?>" role ="button" >Update</a>
                                <a class="btn btn-info pl-3 pr-3" href="delete.php?post_id=<?=  htmlspecialchars($row['id']) ?>" role ="button" >Delete</a>
                            <?php endif; ?>
                         </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif ;?>
    </div>
    <!-- /.row -->
</div>
</div>
</main>


<?php require_once('tpl/footer.php') ?>

<!-- style="height: 800px" -->