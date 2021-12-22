<?php
    $xml = simplexml_load_file('text.xml');
    $ttl = filter_var(trim($_POST['title']),
    FILTER_SANITIZE_STRING);
    $txt = filter_var(trim($_POST['text']),
    FILTER_SANITIZE_STRING);

    if(mb_strlen($ttl) < 1){
        echo "Задано пустий заголовок";
        exit();
    }  

    $i = false;
    foreach ($xml->article as $article) {
        $title  = $article->title;
        if ($title == $ttl ) { 
            $toEdit[] = $article;
            $i = true;
        } 
    }


    if (!$i){
        echo "Даного заголовку не було знайдено";
        exit();
    }
    $xml->article[0]->text = $txt;
    file_put_contents('text.xml', $xml->asXML());

    header('Location: /lab9');
    exit();
?>