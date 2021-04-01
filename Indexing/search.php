
<?php
if(isset($_GET["page"])){
	$page = (int)$_GET["page"];
}
else {
	$page = 1;
}

$query = urldecode($_GET["query"]);
$query = str_replace(" ","%20",$query);
$query_array = explode (",", strtolower($query));

$core_url = "http://localhost:8983/solr/Trial2/select?q=SymptomName:";
$weight_url="http://localhost:8983/solr/Sympweight/select?q=Source:";
$start=$page*10-10;
$symp_array=[];
$symp_array2=[];

$contents = file_get_contents($weight_url.$query.'&sort=Weight%20desc'.'&wt=php&rows=1000&start='.$start.'');

eval("\$result = " . $contents . ";");
$count = $result["response"]["numFound"];

$numOfPages = ceil($count/10);

if($count==0){
	echo "no results found";
}

for($i=0; $i<sizeof($result["response"]["docs"]) ; $i++){

	foreach($result["response"]["docs"][$i] as $key=>$value){
		if($key=='Destination' or $key=='Weight')
		{
			
			if($key=='Destination')
			{
				if (in_array(strtolower(implode(" ",$value)), $symp_array))
					continue;
				elseif (in_array(strtolower(implode(" ",$value)), $query_array))
					continue;
				elseif (in_array(strtolower(implode(" ",$value)), $symp_array2))
					continue;
				
				else
				{
					array_push($symp_array,strtolower(implode(" ",$value)));
					$value=str_replace(" ","%20",$value);
					array_push($symp_array2,strtolower(implode(" ",$value)));
					
				}
			}
		}
	}
	
}

echo "<h1>Filter Search</h1>";
$i = 0;
    
		
		echo "<form action='#' method='post'";
        while($i < 10) 
		{
			echo "</br>";
			echo "<input type='checkbox' name='result[]' value='$symp_array[$i]' /> $symp_array[$i]";
			echo "</br>";
			$i++;
		}
		echo "<input type='submit' name='submit2' value='process' />";
		echo "</form>";
		
		if(isset($_POST['result']))
		{
			foreach($_POST['result'] as $result)
			{
				$result=str_replace(" ","%20",$result);
				array_push($query_array,$result);
				//echo '</br>'.$result.'<br>';
			}
		}

//SYMPTOM AND LINK APACHE SOLR

$contents2 = file_get_contents($core_url.implode(",",$query_array).'&sort=PostNumber%20asc'.'&wt=php&rows=1000&start='.$start.'');
eval("\$result2 = " . $contents2 . ";");
$count2 = $result2["response"]["numFound"];
//echo $count2;
//echo "<br>";
$numOfPages = ceil($count2/10);
if($count2==0){
	echo "no results found";
}
for($i=0; $i<sizeof($result2["response"]["docs"]) ; $i++){
	//echo "=====Result[".($i+1+$start)."]======<br/>";
	foreach($result2["response"]["docs"][$i] as $key=>$value){
		if($key=='PostLink')
		{
			//display($key,$value);
			$temp=implode(" ",$value);
			echo "<br><a href='$temp'>$temp</a>";
			//echo " <a href='$value'>$i</a>";
			
		}
	}
	
	
}

function display($k,$x){
	if(!isset($x)){
		return;
	}
	
	echo $k.": ";
	
	if(!is_array($x)){
		echo $x;
		echo "<br>";
	}
	else {
		for($i=0; $i<sizeof($x) ; $i++){
			if(sizeof($x)==1 || $i==sizeof($x)-1){
				echo $x[$i];
			}
			else {
				echo $x[$i].' - ';
			}
		}
		echo "<br>";
	}
}

?>



