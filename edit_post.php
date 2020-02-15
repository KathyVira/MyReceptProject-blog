



<?php 
require_once 'app/functions.php'; 
if(!isset($_SESSION)) {
    startMySession();
}
// session_start(); 
// פועל בתוך הפונקציות
// cheking that $_SESSION['uid'] not empty
userConect();
// cheking IP of user
userCheck(); 
unsetMs();

//  לפי GET בדיקת לקוח
if(isset($_GET['post_id']) && is_numeric($_GET['post_id'])){
// חיבור לDB
    $link = db_connect();
    mysqli_set_charset($link,"utf8");
   
//    ניקיון של GET
 $post_id = trim(filter_input(INPUT_GET, 'post_id' ,FILTER_SANITIZE_STRING));
  // הוצאה נתונים מדטה-בייס 
    $sql = "SELECT * FROM `posts` WHERE id = '$post_id' AND uid = '{$_SESSION['uid']}'";

    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) == 1){
        $data = mysqli_fetch_assoc($result);   
       
        
    }
}

// פעולה ובדיקות  אחרי לחיצה על SUBMIT
if(isset($_POST['submit'])){
    // בדיקה של TOKEN
    if(isset($_POST['token'])&& $_SESSION['token'] == $_POST['token']){
        // $_SESSION['ms']=$_POST;
        // $ms = $_POST;
        if(empty($_POST['title'])){
            $errms = "You need to fill Recipe title";
        }elseif(empty($_POST['post'])){
            $errms ="You need to fill the Ingredients and Directions";
        }else{
            // $id=$_SESSION[$id];
            //  הגנה בפני פריצות . ניקיון של רווחים INPUTS
            //  xss attack ( Cross-Site Scripting Attacks )
            $title = trim(filter_input(INPUT_POST, 'title' , FILTER_SANITIZE_STRING ));
            $post = trim(filter_input(INPUT_POST, 'post' , FILTER_SANITIZE_STRING ));
            $post_id = trim(filter_input(INPUT_GET, 'post_id' , FILTER_SANITIZE_STRING ));
            $uid = $_SESSION['uid'];


            // $link = db_connect();
            // הגנה של קוד בפני גרשיים והכנסה סדונית של שאילתה לDB 
            // sql injection
            $title = mysqli_real_escape_string($link, $title);
            $pos = mysqli_real_escape_string($link, $post);
            $post_id = mysqli_real_escape_string($link, $post_id);


// השאילתה עצמה אחרי הנקיון
            $sql = "UPDATE `posts` SET `title`='$title',`post`='$post',`created_at`=NOW() WHERE id ='$post_id' AND uid = '{$_SESSION['uid']}'";

// הכנסת שאילתה עם החיבור ובדיקה כמה שורות הושפעו בשאילתה

            $result = mysqli_query($link, $sql);
                 if($result && mysqli_affected_rows($link)>0){
                     $_SESSION['ms']= "Your post were updated";
                     header('location: blog.php');


                    }

        }

    }

} 

// יצירת טוקן פונקציה בקובץ נפרד
// csrf ( Cross-site request forgery )
$token = csrfToken();
$_SESSION['token'] = $token;
?>

<!-- צירוף קוד של נוו בר -->
<?php require_once 'tpl/header.php'; ?>


<div class="container  py-5 mb-4 mt-5">
    <div class="row card">
        

            
             <!-- FORM להכנסה שיוי אינפוטים -->
             <!--  htmlentities כולל ניקוי  -->
            <form action=" " class="forum-sugnin card-body" method="post">
                    <h1 class="h1 py-5 md-3 col">Update post</h1> 
                    <span>Recipe title</span>
                    <input class="form-control"  name="title" type="text" value="<?= htmlentities($data['title']); ?>"></input>
                    <span>Ingredients and Directions</span>
                  
                    <div class="form-group">
                        <textarea name="post" cols="30" rows="10"  class="col form-control text-left"><?= htmlentities($data['post']);?></textarea>
                    </div>
                   
<!-- הכנסת SPAN נהלם לטוקן  -->
                    <div class="checkbox mb-3">  
                        <input type="hidden" name="token" value="<?= $token;?>">
                    </div>

<!-- דיו לכפתורים -->
                <div class="row justify-content-between">
                    <div class="col-6">
                        <input type="submit" name="submit" class="btn btn-block btn-info " value="Update Article"></input>
                    </div>
                    <div class="col-6">
                        <a href="blog.php"><input class="btn btn-block btn-outline-info btn-block" value="Cancel"></input></a>
                    </div>
                </div>
            </form>
<!-- סגירת FORM -->
    </div>
    <!-- סגירת ROW -->
</div>
<!-- סגירת קונטינר -->







<?php require_once 'tpl/footer.php'; ?>
<!-- צירוף פוטר מקובץ נפרד -->