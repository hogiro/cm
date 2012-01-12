<?php require_once('header.php'); ?>

<?php 
$page ="startpage";
include_once 'inc/oaHeader.php';
include_once 'inc/oaNavigation.php';
?>

<input type="button" id="show-btn" value="Hello World" /><br /><br />
<div id="hello-win" class="x-hidden">
    <div class="x-window-header">Hello Dialog</div>
    <div id="hello-tabs">
        <!-- Auto create tab 1 -->
        <div class="x-tab" title="Hello World 1">
            <p>Hello...</p>
        </div>
        <!-- Auto create tab 2 -->
        <div class="x-tab" title="Hello World 2">
            <p>... World!</p>
        </div>
    </div>
</div>
	
</body>
</html>