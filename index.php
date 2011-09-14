<?php
/*
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

$location = "sfbay";
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
    background-color:#333;
    color:#eee;
    min-width: 512px;
}
a { color: #6ebae5; }
a:visited { color: #aaa; }
#header
{
    background-color: #ccc;
    height: 32px;
    padding: 8px 0 0 8px;
}
#header a { color: #000; }
#header a:visited { color: #666; }
#sidemenu
{
    position: absolute;
    right: 8px;
    top: 16px;
}
#postings
{
    margin-left: 8px;
}
form select option
{
    padding: 4px 8px;
}
</style>

<script language="javascript" src="js/jquery-1.6.2.min.js"></script>
<script language="javascript" src="js/jquery.dimensions.min.js"></script>

<script language="javascript">
var name = "#sidemenu";
var menuYloc = null;
$(document).ready(function(){  
    menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")));
    $(window).scroll(function () {  
        var offset = menuYloc+$(document).scrollTop()+"px";  
        $(name).animate({top:offset},{duration:500,queue:false});  
    });  
}); 

function checkSubmit(e)
{
   if(e && e.keyCode == 13)
      document.forms[0].submit();
}
</script>
</head>

<body>

<?php
echo "<div id='header'><a href='$address'>$address</a></div>";

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


<div id="sidemenu">
<form action="." method="post" onKeyPress="return checkSubmit(event)">
    <span style="color:#000; padding:2px 4px; border-radius:4px;
                 background-color:#ccc; border:#aaa solid 2px;"
          onclick="this.form.submit();">Search:</span>
    <input type="text" name="search" value="<?php echo $search ?>"
           style="background-color:#6ebae5; color:#fff; width:256px;
                  margin-right:4px;" /><br />
    <select name="location" size="23" onclick="this.form.submit();"
            style="background-color:#000; color:#fff; float:right;
                   border:#333 solid 1px; margin-top:11px; width:128px;">
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
</form>
</div>

<div id="postings">
<?php
$lines = file($address);

foreach($lines as $line)
{
    if(ereg("<p>", $line))
        echo $line;
}
?>
</div> <!-- end postings -->

</body>

</html>
