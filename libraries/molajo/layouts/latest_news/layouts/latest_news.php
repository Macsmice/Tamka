<?php
	include('includes/prettydate.php');
	$newsitems = array(
		array(
			"link" => "http://www.semo.edu/news/index_32717.htm",
			"title" => "Lisa Ling Speaking Engagement Canceled at Southeast",
			"iso_date" => "2011-01-27",
		),
		array(
			"link" => "http://www.semo.edu/news/index_32707.htm",
			"title" => "Jazz Series Presents Gala Festival Concert with Jazz Trombonist Tony Baker",
			"iso_date" => "2011-01-27",
		),
		array(
			"link" => "http://www.semo.edu/news/index_32686.htm",
			"title" => "Ribbon Cutting Ceremony Planned for Beef Research Facility",
			"iso_date" => "2011-01-27",
		),
		array(
			"link" => "http://www.semo.edu/news/index_32684.htm",
			"title" => "'The Arrow' to Commemorate Its 100th Anniversary in Upcoming Edition",
			"iso_date" => "2011-01-26",
		),
		array(
			"link" => "http://www.semo.edu/news/index_32675.htm",
			"title" => "Southeast to Host 'Show Me Day' Feb. 19 for Prospective Students and Parents",
			"iso_date" => "2011-01-25",
		)
	);
?>
<ol>
	<?php
			foreach ($newsitems as $item) {
				echo '<li><a href="'.$item["link"].'"><h3>'.$item["title"].'</h3><time datetime="'.$item["iso_date"].'">'.Date_Difference::getStringResolved($item["iso_date"]).'</time></a></li>';
			}
	?>
</ol>