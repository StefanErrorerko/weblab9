<?php
    $xml = simplexml_load_file('text.xml');
    $toDelete = array();

    $ttl = filter_var(trim($_POST['title']),
    FILTER_SANITIZE_STRING);

    if(mb_strlen($ttl) < 1){
        echo "Задано пустий заголовок";
        exit();
    }    
    foreach ($xml->article as $article) {
        $title  = $article->title;
        if ($title == $ttl ) { 
            $toDelete[] = $article;
        } 
    }

    

    foreach ($toDelete as $article) {
        $dom = dom_import_simplexml($article);
        $dom->parentNode->removeChild($dom);
    }
    file_put_contents('text.xml', $xml->asXML());

    header('Location: /lab9');
    exit();
?>