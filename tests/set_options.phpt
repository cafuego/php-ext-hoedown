--TEST--
setOptions
--SKIPIF--
--INI--
hoedown.options =
--FILE--
<?php
$text = <<<EOT
# table

First Header  | Second Header
------------- | -------------
Content Cell  | Content Cell
Content Cell  | Content Cel

## fenced code

```php
echo "hello world";
```

### autolink

http://www.php.net/

#### strikethrough

this is ~~good~~ bad.

##### no intra emphasis

hoge_fuga_foo
EOT;

$hoedown = new Hoedown;

echo "== parse ==\n";
echo $hoedown->parse($text);

echo "== setOptions ==\n";
$ret = $hoedown->setOptions(
    array(Hoedown::TABLES => true,
          Hoedown::FENCED_CODE => true,
          Hoedown::AUTOLINK => true,
          Hoedown::STRIKETHROUGH => true,
          Hoedown::NO_INTRA_EMPHASIS => true));

echo "== parse ==\n";
echo $hoedown->parse($text);

--EXPECTF--
== parse ==
<h1>table</h1>

<p>First Header  | Second Header
------------- | -------------
Content Cell  | Content Cell
Content Cell  | Content Cel</p>

<h2>fenced code</h2>

<p><code>php
echo &quot;hello world&quot;;</code></p>

<h3>autolink</h3>

<p>http://www.php.net/</p>

<h4>strikethrough</h4>

<p>this is ~~good~~ bad.</p>

<h5>no intra emphasis</h5>

<p>hoge<em>fuga</em>foo</p>
== setOptions ==
== parse ==
<h1>table</h1>

<table>
<thead>
<tr>
<th>First Header</th>
<th>Second Header</th>
</tr>
</thead>

<tbody>
<tr>
<td>Content Cell</td>
<td>Content Cell</td>
</tr>
<tr>
<td>Content Cell</td>
<td>Content Cel</td>
</tr>
</tbody>
</table>

<h2>fenced code</h2>

<pre><code class="language-php">echo &quot;hello world&quot;;
</code></pre>

<h3>autolink</h3>

<p><a href="http://www.php.net/">http://www.php.net/</a></p>

<h4>strikethrough</h4>

<p>this is <del>good</del> bad.</p>

<h5>no intra emphasis</h5>

<p>hoge_fuga_foo</p>
