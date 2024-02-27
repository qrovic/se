<!DOCTYPE html>
<html lang="en">
<?php 
require_once ("../include/head.php");
require_once('../include/js.php');

?>
<body class="indexkiosk" onclick="redirect()">
    <p class="indexwelcome">Welcome to Meet N' Eat!</p>
    <p class="indextap">Tap to start</p>

    <script>
    function redirect() {
        document.body.style.animation = 'fadeOut 1s forwards';
        setTimeout(() => {
            window.location.href = 'stores.php';
        }, 800);
    }
    </script>
</body>
</script>
</html>