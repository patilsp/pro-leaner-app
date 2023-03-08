<?php
$html = '<body><div><p>hello</p><div></body>';

$dom = new DOMDocument();

$dom->preserveWhiteSpace = false;
$dom->loadHTML($html,LIBXML_HTML_NOIMPLIED);
$dom->formatOutput = true;


print $dom->saveXML($dom->documentElement);
?>