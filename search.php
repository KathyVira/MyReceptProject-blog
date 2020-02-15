<!-- https://code-live.ru/post/custom-search-for-site-with-php-and-mysql/ -->

<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'recipes');

// https://kylaksizov.ru/51-zhivoy-poisk-ajax-php.html
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli -> query("SET NAMES 'utf8'") or die ("Error connecting to database!");


if(!empty($_POST["query"])){ //Принимаем данные

    $query = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["query"]))));

    $db_query = $mysqli -> query("SELECT * from ".PREFIX."search WHERE name LIKE '%$query%'")
    or die('Error №'.__LINE__.'<br>Contact the site administrator, please reporting the error number.');

    while ($row = $db_query -> fetch_array()) {
        echo "\n<li>".$row["name"]."</li>"; //$row["name"] - имя поля таблицы
    }

}



function search ($query) 
{ 
    $query = trim($query); 
    $query = mysqli_real_escape_string($link, $query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '<p>Search term too short.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Search term too long.</p>';
        } else { 
            $q = "SELECT `id`, `uid`, `title`, `post`, `created_at` FROM `posts` WHERE `title` LIKE '%$query%'
            OR `post` LIKE '%$query%'";
                 

            $result = mysqli_query($q);

            if (mysqli_affected_rows() > 0) { 
                $row = mysqli_fetch_assoc($result); 
                $num = mysqli_num_rows($result);

                $text = '<p>Request <b>'.$query.'</b> matches found: '.$num.'</p>';

                do {
                    // Делаем запрос, получающий ссылки на статьи
                    $q1 = "SELECT `link` FROM `table_name` WHERE `uniq_id` = '$row[page_id]'";
                    $result1 = mysqli_query($q1);

                    if (mysqli_affected_rows() > 0) {
                        $row1 = mysqli_fetch_assoc($result1);
                    }

                    $text .= '<p><a> href="'.$row1['link'].'/'.$row['category'].'/'.$row['uniq_id'].'" title="'.$row['title_link'].'">'.$row['title'].'</a></p>
                    <p>'.$row['desc'].'</p>';

                } while ($row = mysqli_fetch_assoc($result)); 
            } else {
                $text = '<p>No results were found for your request..</p>';
            }
        } 
    } else {
        $text = '<p>Search term is empty.</p>';
    }

    return $text; 
} 
?>

<?php 
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>