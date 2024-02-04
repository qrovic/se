<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>POST Values:</h2>";
    echo "<ul>";

    foreach ($_POST as $key => $value) {
        echo "<li><strong>{$key}:</strong> {$value}</li>";
    }

    echo "</ul>";
}
?>
