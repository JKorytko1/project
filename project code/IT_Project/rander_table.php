<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
		
		function rander($tableName, $excludedFields){
		include ('index.php');
        include ('connection.php');
		
	
		        		
        
        $q = mysql_query("SELECT * FROM $tableName");
        echo "<table border=1>";
            echo "<tr>\n";                                              //шапка таблицы
            for ($f = 0; $f < mysql_num_fields($q); $f++) {
                    echo "<th>". mysql_field_name($q, $f)."</th>";
            }
            echo "</tr>\n";                                             //
            while ($row = mysql_fetch_array($q)) {
                echo "<tr>";                		
				   
					for ($f = 0; $f < mysql_num_fields($q); $f++) {
                        echo "<td>". $row[$f]."</td>";
					}		
                echo "</tr>";
				}
            }            
        echo "</table>";
		
		
        ?>
        
    </body>
</html>
