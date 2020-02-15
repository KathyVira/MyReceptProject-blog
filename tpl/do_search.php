<?php
//получаем данные через $_POST
if (isset($_POST['search'])) {
    // подключаемся к базе
    include('db.php');
    $db = new db();
    // никогда не доверяйте входящим данным! Фильтруйте всё!
    $word = mysqli_real_escape_string($_POST['search']);
    // Строим запрос
    $sql = "SELECT title FROM pages WHERE content LIKE '%" . $word . "%' ORDER BY title LIMIT 10";
    // Получаем результаты
    $row = $db->select_list($sql);
    if (count($row)) {
        $end_result = '';
        foreach ($row as $r) {
            $result         = $r['title'];
            $bold           = '<span class="found">' . $word . '</span>';
            $end_result     .= '<li>' . str_ireplace($word, $bold, $result) . '</li>';
        }
        echo $end_result;
    } else {
        echo '<li>По вашему запросу ничего не найдено</li>';
    }
}
