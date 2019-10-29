<?php 
   include("functions.php");
   $connection = connect();
   $nameCountry = htmlspecialchars($_POST['searchNameCountry']);
   $countries = searchCountry($connection, $nameCountry);

   	$breadcrumb = [
		["text" => "Home", "link" => ""],
	];

?>

<!-- верхняя часть -->
<?php include("header.php"); ?>


<!-- Основная часть -->
<main>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="list-group-item list-group-item-secondary">Country List</div>
				<?php foreach ($countries as $countryItem) :?>
					<a href="country.php?code=<?=$countryItem['code']?>" class="list-group-item list-group-item-action">
						<img src="images/countries/png100px/<?= strtolower($countryItem['code'])?>.png">
						<?=$countryItem['name'] ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</main>
	<!-- нижняя часть -->
<?php include("footer.php"); ?>