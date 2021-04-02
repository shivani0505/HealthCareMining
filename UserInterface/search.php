<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap"
			rel="stylesheet"
		/>
		<title>Healthcare Mining UI</title>
		<link rel="stylesheet" href="style2.css">
		
	</head>
	<body>
	<form action="search.php" method="get">
		<div class="app-wrapper">
			<header class="app-header">
				<h2>Semantic Web Mining - Healthcare Mining</h2>
			</header>
			<nav class="search-wrapper">
			<div class="search-box">
				<div class="wrapper">
				<input type="text" name="query" id="search" placeholder="Search COVID-19 related topics " autocomplete="off" required />
					
					<button class="btn submit" id="searchBtn">Search</button>
					<div class="results">
						<ul></ul>
					</div>
					</div>
				</div>
			</nav>
			
		</div>
		<script src="script.js"></script>
	</form>	
	</body>

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
//print_r($query_array);

$core_url = "http://localhost:8983/solr/Trial2/select?q=SymptomName:";
$weight_url="http://localhost:8983/solr/Sympweight/select?q=Source:";
$start=$page*10-10;
$symp_array=[];
$symp_array2=[];

$contents = file_get_contents($weight_url.$query.'&sort=Weight%20desc'.'&wt=php&rows=10&start='.$start.'');

eval("\$result = " . $contents . ";");
$count = $result["response"]["numFound"];

$numOfPages = ceil($count/10);

if($count==0){
	echo "no results found";
}
if($count>1){ 
for($i=0; $i<sizeof($result["response"]["docs"]) ; $i++){
	//echo "=====Result[".($i+1+$start)."]======<br/>";
	foreach($result["response"]["docs"][$i] as $key=>$value){
		if($key=='Destination' or $key=='Weight')
		{
			
			//display($key,$value);
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
					//display($key,$value);
					$value=str_replace(" ","%20",$value);
					array_push($symp_array2,strtolower(implode(" ",$value)));
					
				}
			}
		}
	}
	
	
	
}

$i = 0;
		echo "<form action='#' method='post' class='form1'>";
        echo '<div class="app-content-wrapper" id="checkid">';
		echo'<aside class="filter-section-wrapper">';
		echo '<h2 class="filter-title">Filters</h2>';
		echo '<h4 class="filter-title">Related Symptoms</h4>';
		
		if(count($symp_array)>10)
		{
			while($i < 10) 
		{
			
			echo "<input type='checkbox' class='filter-section-wrapper' name='result[]' value='$symp_array[$i]' /> $symp_array[$i]";
			echo "</br>";
			
			
			$i++;
		}
		}
		else {
			while($i < count($symp_array)) 
		{
			
			echo "<input type='checkbox' class='filter-section-wrapper' name='result[]' value='$symp_array[$i]' /> $symp_array[$i]";
			echo "</br>";
			
			
			$i++;
		}

		}
		
		echo "</br>";
		echo "</br>";
		echo "<input type='submit' class='btn submit' name='submit2' value='Process' />";
		echo "</aside> </form>";
		echo "<form action='#' method='post' class='form2'>";
		
		
		


		
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
	}
$contents2 = file_get_contents($core_url.implode(",",$query_array).'&sort=PostNumber%20asc'.'&wt=php&rows=10&start='.$start.'');
eval("\$result2 = " . $contents2 . ";");
$count2 = $result2["response"]["numFound"];

$numOfPages = ceil($count2/10);
if($count2==0){
	echo "no results found";
}

if($count>1){

echo '<main class="result-section">';
for($i=0; $i<sizeof($result2["response"]["docs"]) ; $i++){
	//echo "=====Result[".($i+1+$start)."]======<br/>";
	foreach($result2["response"]["docs"][$i] as $key=>$value){
		
		if($key=='PostLink')
		{
			//display($key,$value);
			$temp=implode(" ",$value);
			echo "<br><a href='$temp' target='_blank'>$temp</a>";
			//echo " <a href='$value'>$i</a>";
			
		}
	}
	echo "<br/>";
	
	
}
echo "<br/>";
echo "<br/>";
echo "Page Number:";
for($i=0; $i< $numOfPages ; $i++){
	
	echo "<a href='search.php?page=".($i+1)."&query=".implode(",",$query_array)."'>[".($i+1)."]</a> ";
	
}
echo "<br/>";
echo "<br/>";
echo'</main> </div>';

echo'</form>';

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
<script src="script.js"></script>
	<script src="suggestions.js"></script>
</html>

