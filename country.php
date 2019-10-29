<?php 
	include("functions.php");
	$connection = connect();
	$code = $_GET['code'];
	$country = getCountry($connection, $code);
	$continent = getContinent($connection, $country['continent_code']);
	$coords = json_decode($country['coords']);

	$breadcrumb = [ 
		["text" => "Home", "link" => "index.php"],
		["text" => $continent['name'], "link" => "continent.php?code=".$country['continent_code']],
		["text" => $country['name'], "link" => ""],
	];
?>

<!-- верхняя часть -->
<?php include("header.php"); ?>



<!-- Основная часть -->
<main>
	<div class="container">
		
		<div class="list-group-item list-group-item-secondary h2">
			<?=$country['name']?>
			<img class="rounded" src="images/countries/png100px/<?= strtolower($code)?>.png">
		</div>
		<div class="row">
				<div class="col">
					<dl class="row">
  						<dt class="col-sm-3">Field</dt>
  						<dt class="col-sm-9">Value</dd>
  					</dl>
					<?php foreach ($country as $key => $value) :?>
						<dl class="row">
  							<dt class="col-sm-3"><?= replaceUnderSpaceBySpace($key) ?></dt>
  							<dd class="col-sm-9"><?= $value ?></dd>
  						</dl>
					<?php endforeach; ?>
					<dl class="row">
  						<dt class="col-sm-3">Wiki</dt>
  						<dd class="col-sm-9"><a href="https://en.wikipedia.org/wiki/<?=replaceSpaceByUnderSpace($country['name']) ?>" target="_blank"><?=$country['name']?></a></dd>
  					</dl>		

				</div>
				<div class="col text-center">
					
					
            			<div id="map_canvas" style="height: 400px"></div>
            			<script>
                			function initialize() {
                    			var myLatlng = new google.maps.LatLng(<?= $coords[0]; ?>, <?= $coords[1]; ?>);
                    			var myOptions = {
                        			zoom: 4,
                        			center: myLatlng,
                        			mapTypeId: google.maps.MapTypeId.ROADMAP
                    			}
                    			var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                			}
            			</script>
            			<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize" async defer></script>
        		</div>
			</div>
		</div>
	</div>
</main>

	<!-- нижняя часть -->
<?php include("footer.php"); ?>