#!/usr/bin/perl

use lib '/srv/vonberg.com/lib';
use DB_vonberg;
$t = new DB_vonberg unless $t;

$get_productID = $t->execute_sql('SELECT
    p.partID, cat.categoryID
FROM
    series as s,
    parts as p,
    categories as cat
WHERE
    cat.categoryID = p.categoryID
AND
    p.seriesID = s.seriesID
ORDER BY
    p.categoryID, s.name');

$partID_string = "/srv/vonberg.com/htdocs/pdfs/catalog/cover.pdf ";		

foreach $p (@{$get_productID}) {
($partID,$categoryID) = @{$p};
	if ($now_categoryID ne $categoryID) {
		$partID_string .= "/srv/vonberg.com/htdocs/pdfs/catalog/category_page_" . $categoryID . ".pdf ";		
	}
	$partID_string .= "/srv/vonberg.com/htdocs/pdfs/catalog/" . $partID . ".pdf ";
	$now_categoryID = $categoryID;
}

chop $partID_string;
system `pdftk $partID_string output /srv/vonberg.com/htdocs/pdfs/catalog/VONBERG-Product_Catalog.pdf`;
#print "$partID_string \n";

exit;
