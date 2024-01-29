<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>POSTed Data:</h2>";
    echo "<ul>";

    foreach ($_POST as $key => $value) {
        echo "<li><strong>$key:</strong>";

        if (is_array($value)) {
            
            echo "<ul>";
            foreach ($value as $arrayValue) {
                echo "<li>$arrayValue</li>";
            }
            echo "</ul>";
        } else {
            echo " $value";
        }
        echo "</li>";
    }

    echo "</ul>";
}
?>
