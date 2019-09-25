<?php 
    $dom = new DOMDocument("1.0");
    $node = $dom->createElement("markers");
    $parnode = $dom->appendChild($node);

    // Opens a connection to a MySQL server

    $connection=mysqli_connect('localhost', 'root', '','heatmap');
    $list_of_users = mysqli_query($connection, "SELECT * FROM users");

    // header("Content-type: text/xml");

    // Iterate through the rows, adding XML nodes for each

    while ($row = mysqli_fetch_assoc($list_of_users)){
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id",$row['id']);
    $newnode->setAttribute("name",$row['name']);
    $newnode->setAttribute("lat", $row['latitude']);
    $newnode->setAttribute("lng", $row['longitude']);
    }

    echo $dom->saveXML();

    // Start XML file, create parent node
// $doc = domxml_new_doc("1.0");
// $node = $doc->create_element("markers");
// $parnode = $doc->append_child($node);

// $connection=mysqli_connect('localhost', 'root', '','heatmap');
// $list_of_users = mysqli_query($connection, "SELECT * FROM users");




// header("Content-type: text/xml");

// // Iterate through the rows, adding XML nodes for each
// while ($row = mysqli_fetch_assoc($list_of_users)){
//   // Add to XML document node
//   $node = $doc->create_element("marker");
//   $newnode = $parnode->append_child($node);

//   $newnode->set_attribute("id", $row['id']);
//   $newnode->set_attribute("name", $row['name']);
//   $newnode->set_attribute("address", $row['address']);
//   $newnode->set_attribute("lat", $row['lat']);
//   $newnode->set_attribute("lng", $row['lng']);
//   $newnode->set_attribute("type", $row['type']);
// }

// $xmlfile = $doc->dump_mem();
// echo $xmlfile;


?>
{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div xmlns="http://www.w3.org/1999/xhtml" id="webkit-xml-viewer-source-xml"><markers xmlns="">
    <marker id="1" name="Billy Kwong" address="1/28 Macleay Street, Elizabeth Bay, NSW" lat="-33.869843" lng="-151.225769" type="restaurant"/>
    <marker id="2" name="Love.Fish" address="580 Darling Street, Rozelle, NSW" lat="-33.861034" lng="151.171936" type="restaurant"/>
    <marker id="3" name="Young Henrys" address="76 Wilford Street, Newtown, NSW" lat="-33.898113" lng="151.174469" type="bar"/>
    <marker id="4" name="Hunter Gatherer" address="Greenwood Plaza, 36 Blue St, North Sydney NSW" lat="-33.840282" lng="151.207474" type="bar"/>
    <marker id="5" name="The Potting Shed" address="7A, 2 Huntley Street, Alexandria, NSW" lat="-33.910751" lng="151.194168" type="bar"/>
    <marker id="6" name="Nomad" address="16 Foster Street, Surry Hills, NSW" lat="-33.879917" lng="151.210449" type="bar"/>
    <marker id="7" name="Three Blue Ducks" address="43 Macpherson Street, Bronte, NSW" lat="-33.906357" lng="151.263763" type="restaurant"/>
    <marker id="8" name="Single Origin Roasters" address="60-64 Reservoir Street, Surry Hills, NSW" lat="-33.881123" lng="151.209656" type="restaurant"/>
    <marker id="9" name="Red Lantern" address="60 Riley Street, Darlinghurst, NSW" lat="-33.874737" lng="151.215530" type="restaurant"/>
</markers></div>
</body>
</html> --}}