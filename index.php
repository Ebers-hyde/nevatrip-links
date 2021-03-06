<?php

//Найденное решение, чтобы посто так же получить кусок Html в переменную. Всё ниже
//до следующего тега php будет записано строкой. Вчера в шаблонизаторе ModX было бы не нужно, но мне сейчас нужно
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/styles.css">
</head>
<body>
<div class='main'>
    <h3>NEVATRIP-LINKS</h3>
    <img src="/img/cat.jpg" alt="Котейка">
    <p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit praesentium, est ipsa enim vero harum sed doloribus expedita quisquam voluptatem animi quia at! Impedit alias reiciendis, consequatur necessitatibus hic fuga?
    Quis, <a href="http://yandex.ru">ducimus</a>  sed expedita officiis necessitatibus culpa. Quis, sit, non, neque repellendus vero quas enim error maxime dolorem est aut corporis officiis? Vero repellat, nam id atque modi accusamus ipsam!
    Doloribus totam voluptatem voluptatum tempore! Non amet, <a href="https://prahatrip.cz">possimus</a>  provident laborum esse adipisci labore itaque deleniti rerum, nesciunt quo recusandae quibusdam illo blanditiis libero a, impedit aut iusto? Animi, minima assumenda!
    Neque, dolore hic odio aliquam iste obcaecati repudiandae possimus eum quia, facere debitis <a href="vk.com/ebers-hyde">cumque</a> optio ad ducimus tempora. Delectus odio fugit totam explicabo nihil accusantium minima blanditiis porro ipsum iusto.
    </p>
    <p>
    Lorem ipsum dolor sit amet <a href="http://nevatrip.ru">consectetur</a>  adipisicing elit. Quis aliquid tempora voluptas nemo ut. Provident dolorem dolore dolores. Facere, odio! Repudiandae voluptatum hic quasi nihil deserunt earum repellendus qui tempore?
    Eaque fugit ratione, enim repellendus hic natus quibusdam earum facere molestiae expedita, <a href="https://www.youtube.com/watch?v=cfvvh4yFZ3I">reprehenderit</a>  et saepe quidem voluptatibus at. Unde sapiente incidunt eligendi ipsum velit consequuntur inventore quasi fugit. Aliquid, sunt.
    Fugiat ea provident ullam. Iusto in ea rerum. Magni molestiae mollitia repudiandae porro velit odio eveniet dolores a sunt? Ea accusamus impedit hic ex labore accusantium iste? Adipisci, labore amet.
    Repudiandae omnis odit expedita hic iure quis eaque <a href="https://fontanka.ru/2021/03/06/69798233/">consequatur</a> , deserunt, quaerat tenetur quia officiis facere magni itaque labore? Explicabo consequuntur ad corrupti animi eligendi reprehenderit repellendus harum, dolore praesentium voluptatum?
    </p>
    <p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nostrum, voluptatibus ipsam vitae laudantium voluptate reprehenderit placeat natus. Voluptates illum magni perferendis pariatur, nisi quia hic vitae aperiam eligendi quibusdam?
    Nemo quos quia cupiditate nulla aspernatur minus quam eum <a href="HTTPS://google.com">laudantium</a> accusantium ipsa sed aperiam neque quaerat sapiente, commodi vero provident maxime earum, aliquid at. Adipisci suscipit nisi dicta vitae ad.
    Voluptates suscipit voluptatum sit eius cum nemo reiciendis sapiente commodi culpa <a href="busguide.ru/prigorody-peterburga">voluptatem</a>  ducimus hic, minus veritatis iusto deleniti adipisci repellendus, nesciunt accusantium perferendis quo necessitatibus, nostrum quidem? Nesciunt, tempore qui!
    Vel quasi quo dicta consequatur distinctio rem corporis enim, minima sunt natus ipsa impedit cupiditate est ipsum nulla debitis iure officiis, illo quam rerum praesentium. <a href="https://instagram.com">Earum</a> nobis eum minima voluptatem?
    </p>
    <p>
    Lorem, ipsum dolor sit amet consectetur <a href="https://moskvatrip.ru">adipisicing</a> elit. Cupiditate corrupti magni illum reprehenderit, odit, omnis quia recusandae animi, cum aut quam hic! Omnis alias vitae, accusamus dicta quod praesentium. Blanditiis?
    Quibusdam cumque vero rerum provident deserunt sapiente <a href="https://ru.wikipedia.org/wiki/%D0%A1%D0%B0%D0%BD%D0%BA%D1%82-%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3">voluptas</a> . Assumenda temporibus ut perferendis libero officia eius, quam veritatis aperiam nam odit aliquam qui nesciunt, eligendi consequatur voluptas ipsum et, quia facere!
    Sit, soluta quo sunt nulla hic ex neque inventore voluptas, enim animi error? Animi exercitationem molestiae corrupti debitis enim! Aut eos asperiores, sequi modi molestiae praesentium quasi eveniet? Unde, magni!
    Totam, nesciunt iure. Nesciunt nostrum ratione exercitationem qui neque commodi esse in tempora fuga accusamus. Deserunt <a href="avito.ru">distinctio</a> repellat nihil ad illo rerum, suscipit necessitatibus non accusantium soluta praesentium eos amet?
    </p>
    </div>
</body>
</html>
    
<?php

//переменная с кодом html
$source = ob_get_contents();
//буфер очищается и закрывается;
ob_end_clean();

//создание нового объекта DOM
$doc = new DOMDocument();

//HTML в объект загружается из переменной
$doc->loadHTML($source); 
//извлекаюся из HTML все ссылки
$links = $doc->getElementsByTagName('a');

//для каждой ссылки запускается цикл
foreach($links as $link) {
    //у каждой строки методом берётся атрибут 'Href', то есть куда эта ссылка ведёт 
    //и парсится в ассоциативный массив. Нас интересуют значения ключа scheme, в котором и есть протокол, а может его вообще нет 
    $href_parsed = parse_url($link->getAttribute('href'));
    
    //пути ссылок обрабатываются обратной функцией unparse_url, которую я так же нашёл в оф. документации и 
    //слегка изменил, добавив значение 'https', которое всегда записывается в scheme, если его нет, или оно http
    $href_prepared = unparse_url($href_parsed, 'https');
    //переменная записывается в атрибут 'href' ссылки. таким образом каждая ссылка приводится в формат https.
    $link->setAttribute('href', $href_prepared);
    
    //тут используется самое простое регулярное выражение, перечислены 'белые домены', которые закрывать не надо
    //если атрибут 'href', путь ссылки, не соодержит какой-оибо из этих доменов
    if(!preg_match('~prahatrip\.cz|nevatrip\.ru|busguide\.ru|moskvatrip\.ru~', $link->getAttribute('href'))) {
        //ссылке добавляется атрибут 'rel' значением 'unfollow'.
        $link->setAttribute('rel', 'nofollow');
    }
}

echo $doc->saveHTML(); // наконец документ HTML сохраняется и выводится на страницу в нужном виде

//а это функция из документации. на самом деле очень простая, разбирать нечего.
//Если у пути ссылки есть scheme, то есть протокол, и он точно равен https, то добавляем символы '://',
//иначе устанавливаем этот протокол в явном виде и также добавляем символы '://'
//Остальное неважно, просто остальные части ссылки если они есть, цепляются в одну строку, затем вся эта строка возвращается
function unparse_url($parsed_url, $scheme) {
    $scheme   = isset($parsed_url['scheme']) && $parsed_url['scheme'] === 'https' ? $parsed_url['scheme'] . '://' : $scheme . '://';
    $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
    $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
    $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
    $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
    $pass     = ($user || $pass) ? "$pass@" : '';
    $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
    $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
    $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
    return "$scheme$user$pass$host$port$path$query$fragment";
  }

?>