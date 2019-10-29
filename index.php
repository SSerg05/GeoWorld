<?php
	include("functions.php");
	$connection = connect();
	$continents = getContinents($connection);

	$breadcrumb = [ 
		["text" => "Home", "link" => ""],
	];
	//print_r($continents);
?>

<!-- верхняя часть -->
<?php include("header.php"); ?>


<!-- Основная часть -->
<main>
	<div class="container">
		<div class="row">
			<?php foreach ($continents as $continentItem):?>
				<div class="col-6 col-md-4">
					<div class="card p-2 mb-2">
						<img class="card-img-top" src="images/continents/<?= strtolower($continentItem['code'])?>.png" 
							alt="<?= $continentItem['name'] ?>">
						<div class="card-body">
							<h5 class="card-title">
								<a href="continent.php?code=<?=$continentItem['code'] ?>">
									<?= $continentItem['name'] ?>
								</a>
   							</h5>
   							<p class="card-text"><?=$continentItem['description'] ?></p>									
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</main>

<!-- нижняя часть -->
<?php include("footer.php"); ?>
