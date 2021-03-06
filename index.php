<?php
/*
    This program is free software: you can redistribute it and/or
    modify it under the terms of the GNU General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/licenses/.
*/

$location = "sfbay";
$address = "http://www.craigslist.org/";
$search = "gimp|photoshop|retouch|retouching|retoucher";
if(isset($_POST['location']))
{
    $location = $_POST['location'];
    if($_POST['search'] != '')
    {
        $search = $_POST['search'];
        $q = $search;
        $address = "http://$location.craigslist.org/search/ggg?query=$q";
    }
    else
    {
        $address = "http://$location.craigslist.org/ggg";
        $search = "gimp|photoshop|retouch|retouching|retoucher";
    }
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
    font-size: 12px;
    text-shadow: #000 0 0 3px;
}
span.i{
    display: none;
}
</style>

<script>
    /*    
    @licstart  The following is the entire license notice for the 
    JavaScript code in this page.

    Copyright (C) 2012  Loic J. Duros

    The JavaScript code in this page is free software: you can
    redistribute it and/or modify it under the terms of the GNU
    General Public License (GNU GPL) as published by the Free Software
    Foundation, either version 3 of the License, or (at your option)
    any later version.  The code is distributed WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS
    FOR A PARTICULAR PURPOSE.  See the GNU GPL for more details.

    As additional permission under GNU GPL version 3 section 7, you
    may distribute non-source (e.g., minimized or compacted) forms of
    that code without the copy of the GNU GPL normally required by
    section 4, provided you include this license notice and a URL
    through which recipients can access the Corresponding Source.


    @licend  The above is the entire license notice for the 
    JavaScript code in this page.
    */
</script>
<script language="javascript" src="js/jquery-1.6.2.min.js"></script>
<script language="javascript" src="js/jquery.dimensions.pack.js"></script>

<script language="javascript">
var height = window.innerHeight - 48;
var numrows = Math.floor(height/24);
if(numrows > 23){ numrows = 23; }

var name = "#sidemenu";
var menuYloc = null;
$(document).ready(function(){  
    $('#box').attr('size', numrows)
    menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top")
                               .indexOf("px")));
    $(window).scroll(function () {  
        var offset = menuYloc+$(document).scrollTop()+"px";  
        $(name).animate({top:offset},{duration:500,queue:false});  
    });  

    $("input, textarea").focus(function() {
        // only select if the text has not changed
        if(this.value == this.defaultValue) { this.select(); }
    });
}); 
$(window).resize(function() {
    height = window.innerHeight - 48;
    numrows = Math.floor(height/24);
    if(numrows > 23){ numrows = 23; }
    $('#box').attr('size', numrows);
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
    <select id="box" name="location" size="23" onclick="this.form.submit();"
            style="background-color:#000; color:#fff; float:right;
                   border:#333 solid 1px; margin-top:11px; width:128px;">
    <?php
    foreach($city as $key=>$value)
    {
        if($value == $location)
            echo "<option style='font-weight:bold; text-shadow:#000 0 0 2px;' 
                          selected value='$value'>$key</option>";
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

$count = 0;
foreach($lines as $line)
{
    if(ereg("<p class=\"row\"*", $line)) {
        $line = str_replace("href=\"",
                            "href=\"http://$location.craigslist.org", $line);
        echo $line;
    }
}
?>
</div> <!-- end postings -->

</body>

</html>
