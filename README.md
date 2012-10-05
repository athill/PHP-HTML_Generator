PHP-HTML_Generator
==================

Simple interface to generate HTML. Default output is to screen, but buffers allow saving output for later use.

I make a global singleton, $h, so examples will use that.

The basic base idea is to easily generate HTML tabs in script mode without using echo, etc.

The workhorse is a __call (method missing) method that categorizes the called function by empty tags, non-empty tags, and indent tags and acts upon it. So, for example, 

<pre><code>$h->p('some text', 'att1="att1value" ...');</pre></code>

produces (where 'p' is a non-empty, non-indent tag)

&lt;p att1="att1value"&gt;
some text
&lt;/p&gt;

while (where 'link' is an empty (indent is irrelavant in this case (see below)) tag)

<pre><code>$h->link('att1="att1value" ...');</pre></code>

produces

&lt;link att1="att1value" /&gt;

Indention primarily comes into play when nexting tags. For example, 

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


