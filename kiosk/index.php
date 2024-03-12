<!DOCTYPE html>
<html lang="en">
<?php 
require_once ("../include/head.php");
require_once('../include/js.php');

?>
<body class="indexkiosk" onclick="redirect()">
    <video src="../resources/indexvideoo.mp4" autoplay muted loop style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"></video>

    <script>
    function txttospeech(text) {
        responsiveVoice.speak(text);
    }

    
    txttospeech(txt); 
    function redirect() {
        document.body.style.animation = 'fadeOut 1s forwards';
        setTimeout(() => {
            window.location.href = 'type.php';
        }, 800);
    }
    </script>
</body>
</script>
</html>