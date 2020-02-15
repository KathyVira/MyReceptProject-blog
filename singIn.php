<?php
require_once 'app/functions.php';
startMySession();
// unsetMs();





if (isset($_POST['submit'])) {

  if (isset($_POST['token']) && $_SESSION['token'] == trim($_POST['token'])) {
    if (@empty($_POST['email'])) {
          $errms = "Sorry, you must fill your e-mail address and password. Please try again.";
    } elseif (@empty($_POST['pwd'])) {
          $errms = "Sorry, you must fill your e-mail address and password. Please try again.";
    } else{
     
      // חיבור
      $link = db_connect();
      // בדיקת תקינון תוכן

      $email = trim(filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL));
      $pwd = trim(filter_input(INPUT_POST, 'pwd',FILTER_SANITIZE_STRING));

      $email = mysqli_real_escape_string($link,  $email);
      // $name = mysqli_real_escape_string($link,  $_POST['uName']);
      // בדיקה תקינות תוכן הסיסמה
      $pwd =  mysqli_real_escape_string($link,  $pwd);
      
      // שאילתא
      $sql = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
      // הרצה של חיבור ושאילתה
      $result = mysqli_query($link, $sql);
   
    // בדיקה שיש חיבור ושאילתה תקינה
      if ($result && mysqli_num_rows($result) == 1) {
      
        $data = mysqli_fetch_assoc($result);
      
      // הוצאנו את הסיסמה מדטה בייס המוצפן
        $hash = ($data['pwd']);
      
      // השווה בין קוד מוצפן בדטה לבין מה שלקוח הכניס
      if (password_verify($pwd, $hash)) {
        // הפעלה של סאשן והוצאה של נתונים לסאשן לשימוש המשך

        $_SESSION['name'] = $data['name'];
        $_SESSION['uid'] = $data['id'];
        $_SESSION['rool'] = $data['rool'];
        $_SESSION['uip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['ms'] = "Wellcome to your food blog";
        
// echo <pre>
        // print_r($_SESSION);die;
        header("location: blog.php");

      } else {
        $errms = "Sorry, we couldn't find your e-mail address or username. Please try again or Register.";
      }
    } else {
      $errms = "Sorry, we couldn't find your e-mail address or username. Please try again or Register.";
      
    }
  
  }
}
}

$token = csrfToken();
$_SESSION['token'] = $token;
?>


<?php require_once('tpl/header.php') ?>
<?php unsetMs(); ?>


 
<div class="container login-container py-5 mb-4 position-static mt-5 ">
  <div class="row col-md-6 card">
    <div class="login-form-1 card-body">
      <h3>Enter your details</h3>
      <form action="" method="post">
        <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="Your Email *" value="<?= old('email'); ?>" />
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="pwd" placeholder="Your Password *" value=""  />
        </div>
        <div class="form-group ">
          <input type="submit" class="btnSubmit btn btn-info navbar" value="Sing In" name="submit" />
        </div>
      
          <input type="hidden" name="token" value="<?= $token; ?> ">
        <!-- <div class="form-group">
          <a href="#" class="ForgetPwd">Forget Password?</a>
        </div> -->
      </form> 
    </div>
  </div>
</div>









<?php require_once('tpl/footer.php') ?>