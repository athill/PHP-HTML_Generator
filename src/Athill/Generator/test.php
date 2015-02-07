<?php
include('Html.class.php');
$h = Html::singleton();
//// start page
$h->ohtml('Test Page');
$h->body();
//// content

// br
heading('Blank line');
$h->br();
heading('2 Blank lines');
$h->br(2);


$h->p('here is a paragraph');

$h->oul();
$h->li('one');
$h->cul();

$h->startBuffer();
$h->p('test');
$content = $h->endBuffer();

$h->tnl($content);

////close page
$h->chtml();


//// helper
function heading($str) {
	global $h;
	$h->strong($str);
	$h->br();
}
?>