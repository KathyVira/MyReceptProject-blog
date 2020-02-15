<?php 
    // cotect to function
    require_once 'app/functions.php';
    if(!isset($_SESSION)) {
        startMySession();
    } 
// cheking IP of user
userCheck(); 
// cheking that $_SESSION['uid'] not empty
userConect();
unsetMs();

// session_start();
if(isset($_POST['submit'])){
    
    if(isset($_GET['post_id']) && is_numeric($_GET['post_id']) ){
        
        $link = db_connect();
        $sql = "DELETE FROM `posts` WHERE id = {$_GET['post_id']} AND uid = {$_SESSION['uid']}";
        
        $result = mysqli_query($link, $sql);

            if ($result && mysqli_affected_rows($link)>0){
                $_SESSION['ms']= "Your articule has been deleted";
                unset($_SESSION['errms']);
                header("location: blog.php");
            }
            
        }
    }
    
    ?>

<?php require_once 'tpl/header.php'; ?>
<?php unsetMs(); ?>

<div class="container p-5  align-items-center">
    <div class="row card ">
       
            <div class="col" >
                <h1 class="h1 mb-3 p-5 ">Are you sure you want to erase this article</h1>
        </div>
        

        <form action=" " class="card-body col-12  " method="post">
            
            <div class="row justify-content-between">
                <div class="col-6">

                    <button name="submit"   class="btn btn-info  btn-block" type="submit">Delete</button>
                </div>
                <div class="col-6">
                    
                    <a href="blog.php"><input class="btn btn-outline-info btn-block" value="Cancel"></input></a>
                </div>
            </div>
            
        </form>
    </div>
 </div>

<input type="hidden" name="token" value="<?= $token;?>">






<?php require_once('tpl/footer.php'); ?>