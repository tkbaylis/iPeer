<?php ?>

<?php
    // Check that all required parameters are present
    if (empty($eachName) || empty($setName) || empty($verbIn) || empty($verbOut)||
        !isset($list) || !is_array($list) || !isset($selection) || !is_array($selection) || 
        !isset($readOnly)) {
        echo "Error: Please set all parameters for checkBoxList.<br/>";
    } else {
        if (empty($list)) {
            // No entries to choose from? say so.
            echo !empty($emptyMessage) ?
                $emptyMessage :
                "No $setName avaliable.";
        } else {

            // determing a good way to render the list
            $doubleColumn = sizeof($list) >= 6;
            $trippleColumn = sizeof($list) >= 15;
            $renderedCount = 0;

            // Create a checkBox for each entry
            echo "<div style='max-height:220px;overflow:auto'>";
            echo "<table><tr>";
            foreach ($list as $key => $value) {
                echo "<td>";

                // Is this item selected?
                $checked = in_array($key, $selection) ? "checked=true" : "";
				$disabled = $readOnly ? "disabled=true" : "";
                // Cheate the chech for each entry
                echo "<input type='checkbox' name=checkBoxList_$key value='$value' $checked $disabled>";
                if (!empty($checked)) {
                    echo "<b><u>$value</u></b>";
                } else {
                    echo "$value";
                }

                echo "</input></td>";
                $renderedCount++;

                // Insert new rows as needed
                if ($trippleColumn) {
                    echo ($renderedCount % 3 == 0) ? "</tr><tr>" : "";
                } else if ($doubleColumn) {
                    echo ($renderedCount % 2 == 0) ? "</tr><tr>" : "";
                } else {
                    echo "</tr><tr>";
                }
            }
            echo "</tr></table>";
            echo "</div><br/>";
            echo "Use the checkmarks to $verbIn / $verbOut $setName.<br/>";
            echo "($setName in <b><u>bold</u></b> are the ones selected initially.)<br/>";
        }
    }
?>
