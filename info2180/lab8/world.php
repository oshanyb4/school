<?php
require_once 'config.db.php';
if(!empty($_REQUEST['lookup']) || (!empty($_REQUEST['all']) && $_REQUEST['all'] == true)){
	$LOOKUP = (!empty($_REQUEST['lookup']))?$_REQUEST['lookup']:'';
    $doXML = (!empty($_REQUEST['format']) && $_REQUEST['format'] === 'xml')?true:false;
	# execute a SQL query on the database
	$results = mysql_query("SELECT * FROM countries WHERE name LIKE '%$LOOKUP%';");
	# loop through each country
    if(!$doXML){
        while ($row = mysql_fetch_array($results)) {
          ?>
          <li> <?php echo $row["name"]; ?>, ruled by <?php echo $row["head_of_state"]; ?> </li>
          <?php
        }
    }else{
    //Set the content-type header to xml
    header("Content-type: text/xml");
        ?>
    <countrydata>        
        <?php
        while ($row = mysql_fetch_array($results)) {
          ?>
          <country>
              <name><?php echo $row["name"]; ?></name>
              <ruler><?php echo $row["head_of_state"]; ?></ruler>
            </country>
          <?php
        }
        ?>
    </countrydata>
    <?php }
}else{
	echo "Not Found";
}
?>