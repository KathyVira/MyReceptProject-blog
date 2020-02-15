<?php

// DB חיבור
if (!function_exists('db_connect')) {
    function db_connect()
    {

        if (!$link = @mysqli_connect("localhost", "root", "", "recipes")) 
        {
            die('Eror connecting to mysql server!');
        }
        return $link;
    }
}

// יוצר טוקן שמשתנה כל הזמן הגנה נוספת בפני פריצה 
// csrf ( Cross-site request forgery )
if (!function_exists('csrfToken')) {
    function csrfToken(){
        $token = sha1(time().md5("blog"));
        return $token;
    }
}

// שומר את מה שהיה רשום באינפוט לפני הרפרש
if (!function_exists("old")){
    function old($fn){
        return isset($_POST[$fn])?$_POST[$fn]:"";
    }
}

// מנקה הודעה
if (!function_exists("unsetMs")){
    function unsetMs(){
        // sleep();
      if(isset($_SESSION['ms']) && !empty($_SESSION['ms'])){
          unset($_SESSION['ms']);
        }
    }
}
// cheking IP of user
if (!function_exists("userCheck")){
    function userCheck(){
        if(!empty($_SESSION['uip'])){
            if(!($_SESSION['uip'] == $_SERVER['REMOTE_ADDR'])){

                destroyAllSessions();
                // Уничтожает все данные сессии
                header("location: singin.php");
             }
        }
    }
}

// cheking that $_SESSION['uid'] not empty
if (!function_exists("userConect")){
    function userConect(){
        // session_start();
        if(empty($_SESSION['uid'])){

            // print_r($_SESSION);
            // die;
            header("location: index1.php");
        }
    }
}




//  Генерирует и обновляет идентификатор текущей сессии
if ( !function_exists("startMySession")){
    function startMySession(){
        // session_name('blogId');
        session_start();
        session_regenerate_id();
    }
}

if(!function_exists("destroyAllSessions")){
    function destroyAllSessions(){
        session_start();
        // Stores in Array
        $_SESSION = array();
        // Swipe via memory
        if (ini_get("session.use_cookies")) {
            // Prepare and swipe cookies
            $params = session_get_cookie_params();
            // clear cookies and sessions
            setcookie(session_name(), '', time() - 42000,$params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        // Just in case.. swipe these values too
        ini_set('session.gc_max_lifetime', 0);
        ini_set('session.gc_probability', 1);
        ini_set('session.gc_divisor', 1);
        // Completely destroy our server sessions..
        session_destroy();       
        // unset($_SESSION['uid']);
        // session_unset();
        // session_destroy();
        // header("location: index1.php");
    }
}

if (!function_exists("getAvatar")){
    function getAvatar(){

        $link = db_connect();
        $sql = "SELECT  `avatar` FROM `users` WHERE `id` =  '{$_SESSION['uid']}' ";
        $result = mysqli_query($link, $sql);
        
        if ($result && mysqli_num_rows($result)==1){
            // $_SESSION['ms']=" in result";
            $avatar = mysqli_fetch_assoc($result);
            
            return $avatar['avatar'];
        }else{
            // $_SESSION['ms']=" else ";
            return "defoult.png";
        }
    }
}