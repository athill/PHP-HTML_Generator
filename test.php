<?php
include('Html.class.php');
$h = Html::singleton();

$h->ohtml('Test Page');
$h->body();
$h->p('here is a paragraph');

$h->oul();
$h->li('one');
$h->cul();
$h->chtml();
?>