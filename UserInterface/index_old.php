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
 
  
<<!--/div>
  
			<div class="app-content-wrapper">
				<aside class="filter-section-wrapper">
					<h2 class="filter-title">Filters</h2>
					<div class="filter-content"></div>
					<button class="btn apply-filters">Apply Filters</button>
				</aside>
				<main class="result-section">
					<div class="selected-filters"></div>
					<h2>Articles:</h2>
					<div class="results"></div>
				</main>
			</div>
		</div>
		-->
	</form>	
	<script src="script.js"></script>
	<script src="suggestions.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</body>
</html>