<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<h1>Test V1</h1>
<form id="my_form" method="post" action="products">
<input type="hidden" value="1" name='test'>
<a href="javascript:{}" onclick="document.getElementById('my_form').submit();">Til produkter</a>
</form>
