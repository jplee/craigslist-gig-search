<?php
/*
    craigslist gig search v0.0

    Copyright 2011, Joe Lee <jpl@ireland.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

$location = "www";
$address = "http://www.craigslist.org/ggg";
if(isset($_POST['location']))
{
    $location = $_POST['location'];
    if($_POST['search'] != '')
    {
        $search = $_POST['search'];
        $q = "'" . $search . "'";
        $address = "http://$location.craigslist.org/search/ggg/?query=$q";
    }
    else $address = "http://$location.craigslist.org/ggg";
}

?>

<html>

<head>
<title>gig search</title>
<style>
body
{
    background-color:#000;
    color:#eee;
}
a { color: #6ebae5; }
a:visited { color: #aaa; }
</style>
<script type="text/javascript">
function checkSubmit(e)
{
   if(e && e.keyCode == 13)
      document.forms[0].submit();
}

</script>
</head>

<body>

<?php
echo "<a href='$address'>$address</a>";

$city = array(
            "sf bay" => "sfbay",
            "los angeles" => "losangeles",
            "sacramento" => "sacramento",
            "orange co" => "orangecounty",
            "san diego" => "sandiego",
            "las vegas" => "lasvegas",
            "seattle" => "seattle",
            "portland" => "portland",
            "phoenix" => "phoenix",
            "denver" => "denver",
            "houston" => "houston",
            "austin" => "austin",
            "dallas" => "dallas",
            "atlanta" => "atlanta",
            "minneapolis" => "minneapolis",
            "chicago" => "chicago",
            "detroit" => "detroit",
            "philadelphia" => "philadelphia",
            "raleigh" => "raleigh",
            "wash dc" => "washingtondc",
            "boston" => "boston",
            "miami" => "miami",
            "newyork" => "newyork");
?>


<div style="float:right">
<form action="." method="post" onKeyPress="return checkSubmit(event)">
    <input type="text" name="search" value="<?php echo $search ?>"
           style="background-color:#6ebae5; color:#fff; width:128px;" />
    <p>
    <select name="location" size="23" onchange="this.form.submit();"
            style="background-color:#000; color:#fff; float:right; 
                   border:#333 solid 1px; padding:8px; width:128px;">
    <?php
    foreach($city as $key=>$value)
    {
        if($value == $location)
            echo "<option selected value='$value'>$key</option>";
        else
            echo "<option value='$value'>$key</option>";
    }
    ?>
    </select>
    </p>
</form>
</div>

<?php
$lines = file($address);

foreach($lines as $line)
{
    if(ereg("<p>", $line))
        echo $line;
}

?>

</body>

</html>
