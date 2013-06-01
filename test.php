<?php
include('Html.class.php');
$h = Html::singleton();

$h->ohtml('Test Page');
$h->body();
$h->p('here is a paragraph');

$h->oul();
$h->li('one');
$h->cul();

$h->startBuffer();
$h->p('test');
$content = $h->endBuffer();

$h->tnl($content);

print_r($h->atstr2hash('href="fun" img="thing"'));

$h->chtml();
?>