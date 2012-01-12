
<div id="footpanel">

	<ul id="mainpanel">    	

        <li><a href="http://www.designbombs.com" class="home">Inspiration <small>Design Bombs</small></a></li>
        <li><a href="http://www.designbombs.com" class="profile">View Profile <small>View Profile</small></a></li>
        <li><a href="http://www.designbombs.com" class="editprofile">Edit Profile <small>Edit Profile</small></a></li>
        <li><a href="http://www.designbombs.com" class="contacts">Contacts <small>Contacts</small></a></li>
        <li><a href="http://www.designbombs.com" class="messages">Messages (10) <small>Messages</small></a></li>
        <li><a href="http://www.designbombs.com" class="playlist">Play List <small>Play List</small></a></li>
        <li><a href="http://www.designbombs.com" class="videos">Videos <small>Videos</small></a></li>
        <li id="alertpanel">
        	<a href="#" class="alerts">Alerts</a>
            <div class="subpanel">
            <h3><span> &ndash; </span>Notifications</h3>
            <ul>
            	<li class="view"><a href="#">View All</a></li>
            	<li><a href="#" class="delete">X</a><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Et voco </a> Duis vel quis at metuo obruo, turpis quadrum nostrud <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Tego</a> nulla eum probo metuo nullus indoles os consequat commoveo os<a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Nonummy</a> nulla eum probo metuo nullus indoles os consequat commoveo <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Tego</a> minim autem aptent et jumentum metuo uxor nibh euismod si <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>
            </ul>
            </div>
        </li>
        <li id="chatpanel">
        	<a href="#" class="chat">Kampagnen (<strong>18</strong>) </a>
            <div class="subpanel">
            <h3><span> &ndash; </span>Kampagnen</h3>
            <ul>
            	<li><span>Aktive Kampagnen</span></li>
<?php 
	$campaign = new campaign();
	$result = $campaign->show_campaigns();
	while ($row=mysql_fetch_array($result)){
?>

<li><a class="colorbox" href="campaign_detail.php?campaign_id=<?php 
	echo $row['campaign_id'];
?>"><img src="chat-thumb.gif" alt="" /><?php 	echo $row['name']; ?></a></li>
<?php 
	}

?>
                <li><span>Bevorstehende Kampagnen</span></li>
                
                <?php 
	$campaign = new campaign();
	$result = $campaign->show_campaigns();
	while ($row=mysql_fetch_array($result)){
?>

<li><a class="colorbox" href="campaign_detail.php?campaign_id=<?php 
	echo $row['campaign_id'];?>"><img src="chat-thumb.gif" alt="" /><?php 	echo $row['name']; ?></a></li>
<?php 
	}

?>

            </ul>
            </div>
        </li>
	</ul>

</div>
</body>
</html>