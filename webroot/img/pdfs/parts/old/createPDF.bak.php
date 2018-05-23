<?php

$partID = intval($_GET['partID']);

// prep the PDO 
$dbHost = "127.0.0.1";
$dbUser = "root";
$dbPass = "foobarbaz";
$dbName = "vonberg";

try {
    $dbh = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
} catch(PDOException $e) {
    echo $e->getMessage();
}

// GET PART DATA //
$get_parts = $dbh->query("SELECT 
    p.description,
    p.categoryID,
    t.name,
    s.name,
    st.name,
    c.name,
    ty.name
FROM
    parts as p,
    series as s,
    styles as st,
    connections as c,
    categories as t,
    types as ty
WHERE
    p.partID = '$partID'
AND
    p.seriesID = s.seriesID
AND
    p.styleID = st.styleID
AND
    p.connectionID  = c.connectionID
AND
    p.categoryID = t.categoryID
AND
    p.typeID = ty.typesID
");

$part_info = $get_parts->fetch(PDO::FETCH_NUM);
list($description,$categoryID,$category_name,$series_name,$style_name,$connection_name,$type_name) = $part_info;

if ($type_name == 'N/A') { $type_name = ''; } // REMOVES IF N/A


// GET OPERATIONS CONTENT - 1 OPERATIONS
$get_operations_text_blockID = $dbh->query("SELECT text_blockID FROM text_blocks WHERE partID = '$partID' AND order_num = '1'");
$operations_text_blockID = $get_operations_text_blockID->fetchColumn();

$get_operations_bullets = $dbh->query("SELECT bullet_text FROM text_block_bullets WHERE text_blockID = '$operations_text_blockID' ORDER BY order_num");
while ($operations_bullet_text = $get_operations_bullets->fetchColumn()) {
    $operations .= "<li>$operations_bullet_text</li>";
}


// GET FEATURES CONTENT - 2 FEATURES
$get_features_text_blockID = $dbh->query("SELECT text_blockID FROM text_blocks WHERE partID = '$partID' AND order_num = '2'");
$features_text_blockID = $get_features_text_blockID->fetchColumn();

$get_features_bullets = $dbh->query("SELECT bullet_text FROM text_block_bullets WHERE text_blockID = '$features_text_blockID' ORDER BY order_num");
while ($features_bullet_text = $get_features_bullets->fetchColumn()) {
    $features .= "<li>$features_bullet_text</li>";
}


// GET SPECIFICATIONS
$get_specifications = $dbh->query("SELECT spec_name, spec_value FROM specifications WHERE partID = '$partID' ORDER BY order_num");
while ($specifications = $get_specifications->fetch(PDO::FETCH_NUM)) {
    list($spec_name, $spec_value) = $specifications;
    $spec .= "<tr><td>$spec_name</td><td>$spec_value</td></tr>";
}


// GET MODEL TABLEID
$get_model_tableID = $dbh->query("SELECT model_tableID FROM model_tables WHERE partID = '$partID'");
$model_tableID = $get_model_tableID->fetchColumn();

// GET TABLE HEADS
$headCounter = '0';
$get_table_heads = $dbh->query("SELECT model_table_text FROM model_table_headers WHERE model_tableID = '$model_tableID' ORDER BY order_num");
$theads .= "<tr>
";
while ($table_header = $get_table_heads->fetchColumn()) {
    $theads .= "<th>$table_header</th>";
    $headCounter++;
}
$theads .= "</tr>";

// GET COLUMN CONTENT
$colCounter = '0';
$get_table_cols = $dbh->query("SELECT model_table_row_text FROM model_table_rows WHERE model_tableID = '$model_tableID' ORDER BY order_num");

while ($table_col = $get_table_cols->fetchColumn()) {
    if ($colCounter == 0) { $tcols .= "<tr>"; }
    $tcols .= "<td>$table_col</td>";
    $colCounter++;
    if ($colCounter == $headCounter) {
        $tcols .= "</tr>";
        $colCounter = '0';
    }
}


// LOAD PDF BUILDER
require_once("dompdf_config.inc.php");


// THIS SETS THE MEMORY HIGHER SO IT DOESNT CRASH
ini_set('memory_limit', '-1');


// THIS IS THE HTML OUTPUT //
//
$html = <<<EOF

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Vonberg Valve, Inc. - Product</title>

<style>
body {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 8pt;
    padding: 10px 15px 10px 54px;
}
.small {
    font-size: 8pt;
}
div.hr {
    width: 100%;
    height: 2px;
    background-color: #1c5832;
}
div.hr2 {
    width: 100%;
    height: 1px;
    background-color: #1c5832;
}
h1 {
    color: #1c5832;
    font-size: 12pt;
    margin: 0;
    padding: 0;
}
h2 {
    font-size: 9pt;
    margin: 0;
    padding: 0;
}
h3 {
    font-size: 10pt;
    margin: 0;
    margin-bottom: 3px;
    padding: 0;
    border-bottom: 1px solid #1c5832;
}
table {
    margin: 0;
    padding: 0;
    border: 0;
    border-spacing: 0;
}
th {
    text-align: left;
}
ul, p { 
    margin-top: 3px;
}
ul {
    margin-left: 0;
    padding-left: 0;
}
li {
    //margin-left: 1em;
    margin-left: 5px;
    list-style-type: circle;
}
table.rule th,
table.rule td {
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #1c5832;
}
p.notes {
    margin: 0;
    padding: 8px 0 0 0;
    font-size: 8pt;
    line-height: 8pt;
}
</style>

</head>

<body>

<table width="100%">
<tr>
<td width="50%"><img src="/srv/vonberg.com/htdocs/images/vonberg-pdf-logo.jpg" style="width:200px;"></td>
<td width="50%" style="text-align:right;">
    <h1>$category_name<br/>$style_name</h1>
    <h2>$series_name<br/>$connection_name<br/>$type_name</h2>
</td>
</tr>
<tr><td colspan="2"><div class="hr"></div></td></tr>
</table>

<table width="100%" style="padding-top:10px;">

<tr>
<td width="45%" style="padding-right:10px;">
    <!-- LEFT RAIL -->

    <h3>PRODUCT</h3>
    <p><img src="/srv/vonberg.com/htdocs/parts/$partID/schematic_drawing.jpg"></p>

    <h3>SCHEMATIC</h3>
    <p><img src="/srv/vonberg.com/htdocs/parts/$partID/hydraulic_symbol.jpg"></p>

    <h3>TYPICAL PERFORMANCE</h3>
    <p><img src="/srv/vonberg.com/htdocs/parts/$partID/typical_performance.jpg"></p>

    <!-- END LEFT RAIL -->
</td>
<td width="55%" style="padding-left:10px;border-left:2px solid #1c5832;">
    <!-- RIGHT RAIL -->

    <h3>DESCRIPTION</h3>
    <p>$description</p>
    <br/>

    <h3>OPERATION</h3>
    <ul>$operations</ul>
    <br/>

    <h3>FEATURES</h3>
    <ul>$features</ul>
    <br/>

    <h3>SPECIFICATIONS</h3>
    <table width="100%" cellspacing="0" style="padding-bottom:10px;" class="rule">
    $spec
    </table>
    <br/>

    <h3>ORDERING INFORMATION</h3>
    <p><img src="/srv/vonberg.com/htdocs/parts/$partID/ordering_information.jpg"></p>

    <!-- END RIGHT RAIL -->
</td>
</tr>

<tr><td colspan="2" style="padding:10px 0 0 0;"><div class="hr"></div></td></tr>

</table>
<br/>

<table cellspacing="0" width="100%" style="padding-top:10px;" class="rule">
<thead>
    $theads
</thead>
<tbody>
    $tcols
</tbody>
</table>

<p class="notes">This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met.</p>

<p class="notes" style="padding-bottom:8px;">The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of Vonberg Valve, Inc. without prior notification.</p>

<div class="hr2"></div>

<p>Vonberg Valve, Inc. &#149; 3800 Industrial Avenue &#149; Rolling Meadows, IL 60008-1085 USA &#169; 2012<br/>
279 847/259-3800 &#149; fax 847/259-3997 &#149; email: info@vonberg.com</p>

</body>
</html>

EOF;
// THIS ENDS THE HTML OUTPUT //


// NAME OF FILE
$file_name = "VONBERG-$category_name-$style_name-$series_name.pdf"; // NAME PDF FILE
$file_name = str_replace(' ','_',$file_name); // REPLACES SPACE WITH UNDERSCORE


// CREATES PDF //
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("$file_name");

?>