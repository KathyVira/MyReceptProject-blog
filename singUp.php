<?php
require_once ('app/functions.php');
startMySession();

// unsetMs();
// cheking IP of user
// userCheck(); 
// cheking that $_SESSION['uid'] not empty
// userConect();
// if(!isset($_SESSION)) {
// }
//   unset($_SESSION['uid']);
// verUser(); 
// userConect();

if (isset($_POST['submit'])) {
    // die;
    //   $tokenS = $_SESSION['token'];
    //   $tokenP = $_POST['token'];
     if ($_SESSION['token'] == trim($_POST['token'])) {

        if (empty($_POST['uName'])) {
            $errms = "Sorry, you must fill your e-mail address and password. Please try again.";
        } elseif (empty($_POST['uEmail'])) {
            $errms = "Sorry, you must fill your e-mail address and password. Please try again.";
        } elseif (empty($_POST['pwd'])) {
            $errms = "Sorry, you must fill your e-mail address and password. Please try again.";
        } elseif (empty($_POST['rePwd'])) {
            $errms = "Sorry, you neet to fill password agane! Please try again.";
        } else {
                define('UPLOAD_MAX_SIZE', 1024 * 1024 * 20);
                $ex = ['jpg', 'jpeg', 'png', 'gif', 'bpm', 'pdf', 'doc', 'docx'];
                    //ניקוי מרוחים והגנה בפני   xss attack ( Cross-Site Scripting Attacks )
                    
                    $name = trim(filter_input(INPUT_POST, 'uName' , FILTER_SANITIZE_STRING ));
                    $email = trim(filter_input(INPUT_POST, 'uEmail' , FILTER_SANITIZE_STRING ));
                    $pwd = trim(filter_input(INPUT_POST, 'pwd' , FILTER_SANITIZE_STRING ));
                    $rePwd = trim(filter_input(INPUT_POST, 'rePwd' , FILTER_SANITIZE_STRING ));
                    
                    // חיבור
                    $link = db_connect();
                    // הגדרה לאינפוטים שיכבדו עברית
                    mysqli_set_charset($link,"utrf8");

                    // הגנה sql injection
                    $name = mysqli_real_escape_string($link, $name);
                    $email = mysqli_real_escape_string($link, $email);
                    $pwd = mysqli_real_escape_string($link, $pwd);
                    $rePwd = mysqli_real_escape_string($link, $rePwd);

                    // שילתא DB
                    $sql = "SELECT email FROM users WHERE email ='$email'";

                    $result = mysqli_query($link,$sql);

            if ($result && mysqli_num_rows($result)>0){
                $errms = "This email has already been used";
            }else{
                if ($pwd == $rePwd) {
                        // הצפנה של סיסמה
                        $hash = password_hash($pwd, PASSWORD_BCRYPT);
                        // הכנסה של תמונת גולש ברישום לבלוג
                    if (!empty($_FILES['image']['name'])) {
                        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                            if ($_FILES['image']['size'] <= UPLOAD_MAX_SIZE && $_FILES['image']['error'] == 0) {
                                
                                    $file_info = pathinfo($_FILES['image']['name']);                                                      
                                    $file_ex = strtolower($file_info['extension']);
                            
                                    if (in_array($file_ex, $ex)) {
                                    move_uploaded_file($_FILES['image']['tmp_name'], "img/avatar/" . $_FILES['image']['name']);
                                    $avatar = $_FILES['image']['name'];
                                    }
                            }  else{
                                $errms = "is_uploaded_file error ";
                                $avatar = "defoult.png";
                            }
                          }else{
                              $errms = "is_uploaded_file error ";
                              $avatar = "defoult.png";
                          }

                     }else{
                        //  if input avatare empty
                    $avatar = "defoult1.png";
                                   
                    //  $errms = "uploded image to big, please chouse up to 1040/1040 px ";
                                    
                                          
                     }
                                    
                    $rool =6;
                                    
                     // שאילתא
                     $sql = "INSERT INTO `users` (`id`, `name`, `email`, `pwd`, `rool`, `avatar`, `updated`) VALUES (NULL, '$name', '$email', '$hash', '$rool', '$avatar', current_timestamp());";
                     // הרצה של חיבור ושאילתה
                                    $result = mysqli_query($link, $sql);
                                    // בדיקה שיש חיבור ושאילתה תקינה
                                    if ($result && mysqli_affected_rows($link) > 0) {
                                        $_SESSION['name'] = $name;
                                        $_SESSION['uid'] = mysqli_insert_id($link);
                                        $_SESSION['rool'] = $rool; 
                                        // print_r (mysqli_insert_id($link)) ;
                                        // die;
                                        $_SESSION['ms'] = "Your blog account has been created";
                                        
                                        header('location: blog.php');
                                    } else {
                                        $errms = "Error result";
                                        
                                    }
                        }else {
                        $errms = "Re-password don't match";
                        }
                     }
                                
                        // is_uploaded_file
                    // file not empty

                } 
                // re-pwd good end
            }
            // else affactad rows 
        }
        // empty postname
    // 
    // session token end
// 
// submit end


$token = csrfToken();
$_SESSION['token'] = $token;
?>


<?php require_once ('tpl/header.php'); ?>


<div class="container login-container py-5 mb-4 mt-5 ">
    <div class="row col-md-6 card">
        <div class=" login-form-1 card-body">
            <h3>Create New blog</h3>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <input type="text" class="form-control" name="uName" placeholder="Your Name *" value="<?= old('uName'); ?>" />                   
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="uEmail" placeholder="Your Email *" value="<?= old('uEmail'); ?>" />
                   
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="pwd" placeholder="Your Password *" value="<?= old('pwd'); ?>"  />
                  
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="rePwd" placeholder="Verify Password *" value="" />
                </div>

                <div class="form-group">
                    <input type="file" class="form-control" name="image" value="" />
                </div>
                
                
                

                <div class="form-group" >
                    <input type="submit" class="btnSubmit btn btn-info navbar" value="Create my Account" name="submit" />
                </div>
                
                <input type="hidden" name="token" value="<?=$token;?>">
                
            </form>
        </div>
    </div>
</div>

 <?php require_once('tpl/footer.php') ?> 