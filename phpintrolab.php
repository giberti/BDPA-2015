<?php
    // Total number of columns to display
    $columns = 15;
    // Total number of rows to display
    $rows = 15;
    // All prime numbers between 1-250
    $primeNumbers = array(2,3,5,7,11,13,17,19,23,29,31,37,41,43,47,53,59,61,67,71,73,79,83,89,97,101,103,107,109,113,127,131,137,139,149,151,157,163,167,173,179,181,191,193,197,199,211,223,227,229,233,239,241);
?>
<html>
    <head>
        <title>Multiplication Table</title>
        <style type="text/css">
        /* reset the default table styles */
        table, tr, th, td {
            border: 0px;
            margin: 0px;
            padding: 0px;
            border-collapse: collapse;
            border-spacing: 0;
	    }
        body, th, td { 
            font-family:arial; 
            font-size:12pt; 
        }
        th { 
            background-color: #eee;
        }
        th, td { 
            border:1px solid #eee;
            text-align:right; 
            width:38px; 
            padding:3px;
        }
        .prime { 
            color:red; 
            font-weight:bold; 
        }
        </style>
    </head>
    <body>
    <h1>Multiplication Table</h1>
    <?php
    // Setup the table
    print '<table>';
    print '<tr>';
    print '<th>x</th>';
    // Loop for each heading column
    for ($column = 1; $column <= $columns; $column++) {
        print '<th>' . $column . '</th>';
    }
    print '</tr>';
    // Loop for each row requested
    for ($row = 1; $row <= $rows; $row++) { 
        print '<tr>';
        print '<th>' . $row . '</th>';    
        // Loop for each column in the row
        for ($column = 1; $column <= $columns; $column++) {
            $product = $column * $row;
            // If the product is one of the prime numbers, highlight it
            if (in_array($product, $primeNumbers)) {
                print '<td class="prime">' . $product . '</td>';
            } else {
                print '<td>' . $product . '</td>';
            }
        }
        print '</tr>';
    }
    print '</table>';
    ?>
    </body>
</html>
