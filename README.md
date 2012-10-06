PHP-HTML_Generator
==================

Simple interface to generate HTML. Default output is to screen, but buffers allow saving output for later use.

Html.class.php extends Xml.class.php

I make a global singleton for Html.class.php, $h, so examples will use that.

The basic base idea is to easily generate HTML tags in script mode without using 'echo', etc.

The workhorse is the <a href="http://www.php.net/manual/en/language.oop5.overloading.php#object.call" target="_blank">__call</a> (<a href="http://en.wikipedia.org/wiki/Metaprogramming" target="_blank">missing method</a>) method that categorizes the called function by valid empty tags, non-empty tags, and indent tags and acts upon it. So, for example, 

<pre><code>$h->p('some text', 'att1="att1value" ...');</pre></code>

produces (where 'p' is a non-empty, non-indent tag)

<pre><code>
&lt;p att1="att1value"&gt;
some text
&lt;/p&gt;
</pre></code>

while (where 'link' is an empty (indent is irrelavant in this case (see below)) tag)

<pre><code>$h->link('att1="att1value" ...');</pre></code>

produces

<pre><code>
&lt;link att1="att1value" /&gt;
</pre></code>

Indention primarily comes into play when nesting tags. For example, 

<pre><code>
$h->otable('border="1" id="this-table"');
$headers = array('one','two');
foreach ($headers as $header) {
	$h->th($header);
}
$data = array(
	array('a', 'b');
	array('c', 'd');
);
foreach ($data as $datum) {
	$h->cotr();
	foreach ($datum as $cell) {
		$h->td($cell);
	}
}
$h->ctable('close this-table');
</pre></code>

produces

<pre><code>
&lt;table border="1" id="this-table"&gt;
&lt;tr&gt;
	&lt;th&gt;one&lt;/th&gt;
	&lt;th&gt;two&lt;/th&gt;
&lt;/tr&gt;
&lt;tr&gt;
	&lt;td&gt;a&lt;/td&gt;
	&lt;td&gt;b&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
	&lt;td&gt;c&lt;/td&gt;
	&lt;td&gt;d&lt;/td&gt;
&lt;/tr&gt;
&lt;/table&gt; &lt;!-- close this-table --&gt;
</pre></code>

similar results could be achieved by:

<pre><code>
$h->simpleTable(
	array(
		'headers'=>array('one', 'two'), 
		'data'=>array(
			array('a', 'b'),
			array('c', 'd')
		),
		'atts'=>'border="1" id="this-table"'
	)
);
</pre></code>

A couple things I've skipped over:

1. You can prepend (relevant) tags with 'o', 'c', or 'co'. For example, 'otable' generates &lt;table ...&gt;, 'ctable' generates &lt;/table&gt;, and 'cotr' generates &lt;/tr&gt;&lt;tr&gt; The 'ol' and 'col' tags represent exceptions which have not yet been addressed.
2. simpleTable is just an example of abstracting the basic concept. 
3. This is a work in progress. I like the basic idea though: The Xml class is the core. Tag generation via metaprogramming; indention; buffering. That's all the base class should do. The Html class defines specific tag behavior (e.g., empty or non-empty, indent or un-indent) and utility methods (e.g., simpleTable)
