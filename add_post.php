<?php
require_once ('app/functions.php'); 

    if(!isset($_SESSION)) {
        startMySession();
    }
    // cheking that $_SESSION['uid'] not empty
    userConect();
// cheking IP of user
    userCheck(); 

//   startMySession();
unsetMs();
// enter after submit presd
  if(isset($_POST['submit'])){
    //   chaking of the token
      if(isset($_POST['token'])&& $_SESSION['token'] == $_POST['token']){
        // print_r($_POST['title']);die;
        // chek inputs ane not empty
        if(empty($_POST['title'])){
            $errms ="You need to fill Recipe title";
        }elseif(empty($_POST['article'])){

            // print_r($_POST['article']);
            // die;
            $errms ="You need to fill the Ingredients and Directions";
        }else{
           
            
            $title = trim(filter_input(INPUT_POST, 'title' , FILTER_SANITIZE_STRING ));
            $article = trim(filter_input(INPUT_POST, 'article' , FILTER_SANITIZE_STRING ));
            $uid = $_SESSION['uid'];

            $link = db_connect();
            mysqli_set_charset($link,"utf8");
            $title = mysqli_real_escape_string($link, $title);
            $article = mysqli_real_escape_string($link, $article);


            $sql = "INSERT INTO `posts` (`id`, `uid`, `title`, `post`, `created_at`) VALUES (NULL, '$uid', '$title', '$article', NOW())";

            $result = mysqli_query($link, $sql);

            
            if($result && mysqli_affected_rows($link)>0){
                $_SESSION['ms']= "Your recip was published";
                header('location: blog.php');

            }else{
                $errms= "Error result";
            }

        }

    }

} 


$token = csrfToken();
$_SESSION['token'] = $token;
?>
<!-- צירוף קובע של אתר מקובץ נפרד -->
<?php require_once ('tpl/header.php'); ?>
<!-- בדיקה אם יש הודעות וניקוי שלהן. -->


<div class="container  py-5 mb-4 mt-5 ">
    <div class="row  card ">
        <form action=" " class="forum-sugnin card-body " method="post">
                <h1 class="h1 py-5 md-3 col">Add new recipe</h1>
               
                <span>Recipe title</span>
                <input class="form-control" name="title" type="text" value="<?= old('title'); ?>"></input>
                <span>Ingredients and Directions</span>
            <div class="form-group">
                <textarea class=" col form-control text-left" cols="30" rows="10" name="article" type="text"  value="<?php old('article'); ?>"></textarea>
                <!--  id="summernote" -->
               
            </div>
    
            <div class="checkbox mb-3">  
                <input type="hidden" name="token" value="<?= $token;?>">
            </div>
            <div class="row justify-content-between">
                <div class="col-6">
                    <input type="submit" name="submit" class="btn btn-info btn-block " value="Publich Recipes"></input>
                </div>
                <div class="col-6">
                    <a href="blog.php"><input class="btn btn-block btn-outline-info btn-block" value="Cancel"></input></a>
                </div>
            </div>
        </form>
    </div>
</div>







<?php require_once('tpl/footer.php'); ?>