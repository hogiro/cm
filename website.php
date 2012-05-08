<?php 
require_once 'header.php';
?>
<script type="text/javascript" src="website.js">
</script>

<?php 
$page ="website";
include_once 'inc/oaHeader.php';
include_once 'inc/oaNavigation.php';
//include_once 'inc/firstLevelContent.php';
?>

<!--
<div id="firstLevelContent">
    <div id="secondLevelNavigation">
               <ul class="navigation first">
      
          <li class="active  first">
              <a href="http://ads20.wwe-media.de/www/admin/advertiser-index.php">
            Werbetreibende
            <span class="top"></span>
            <span class="bottom"></span>
          </a>
    
      </li>     
         <li class="passive  after-active">
              <a href="http://ads20.wwe-media.de/www/admin/advertiser-campaigns.php">
            Kampagnen
            <span class="top"></span>
            <span class="bottom"></span>
          </a>
        
      </li>
              
          <li class="passive  last">

              <a href="http://ads20.wwe-media.de/www/admin/campaign-banners.php">
            Banner
            <span class="top"></span>
            <span class="bottom"></span>
          </a>
        
      </li>
          
               </ul>
        <ul class="navigation">
      
          <li class="passive  first">

              <a href="http://ads20.wwe-media.de/www/admin/website-index.php">
            Webseiten
            <span class="top"></span>
            <span class="bottom"></span>
          </a>
         
      </li>
       
          <li class="passive ">
              <a href="http://ads20.wwe-media.de/www/admin/affiliate-zones.php">
            Zonen
            <span class="top"></span>

            <span class="bottom"></span>
          </a>
          
      </li>
       
          <li class="passive  last">
              <a href="http://ads20.wwe-media.de/www/admin/affiliate-channels.php">
            Zielgruppen
            <span class="top"></span>
            <span class="bottom"></span>
          </a>
         
      </li>
    </ul>
        <ul class="navigation">
      
          <li class="passive  first last single">
              <a href="http://ads20.wwe-media.de/www/admin/admin-generate.php">
            Bannercode erstellen
            <span class="top"></span>
            <span class="bottom"></span>
          </a>

          
                                  
          
      </li>
         </ul>
          

</div>

<div id="secondLevelContent">

<div id="thirdLevelHeader">

<div class="breadcrumb hasIcon iconAdvertisersLarge">
<h3 class="noBreadcrumb">
<span class="label">Webseiten</span>
</h3>

</div>

<div class="corner left"></div>
<div class="corner right"></div>
</div>


<div style="min-height: 696px;" id="thirdLevelContent">

<div class="tableWrapper">
<div class="tableHeader">
<ul class="tableActions">
<li>
<a href="http://ads20.wwe-media.de/www/admin/advertiser-edit.php" class="inlineIcon iconAdvertiserAdd">Neuen Werbetreibenden hinzufügen</a>
</li>
<li class="inactive activeIfSelected">
<a id="deleteSelection" href="#" class="inlineIcon iconDelete">Löschen</a>


<script type="text/javascript">
<!--

$('#deleteSelection').click(function(event) {
	event.preventDefault();

	if (!$(this).parents('li').hasClass('inactive')) {
		var ids = [];
		$(this).parents('.tableWrapper').find('.toggleSelection input:checked').each(function() {
			ids.push(this.value);
		});

		if (!tablePreferences.warningBeforeDelete || confirm("Möchten Sie die ausgewählten Werbetreibenden wirklich löschen?")) {
			window.location = 'advertiser-delete.php?clientid=' + ids.join(',');
		}
	}
});


</script>

</li>
</ul>

<ul class="tableFilters alignRight">
<li>
<div class="label">
Show
</div>

<div class="dropDown">
<span><span>All advertisers</span></span>

<div class="panel">
<div>
<ul>
<li><a href="http://ads20.wwe-media.de/www/admin/advertiser-index.php?hideinactive=0">All advertisers</a></li>
<li><a href="http://ads20.wwe-media.de/www/admin/advertiser-index.php?hideinactive=1">Active advertisers</a></li>
</ul>
</div>
</div>

<div class="mask"></div>
</div>
</li>
</ul>

<div class="clear"></div>

<div class="corner left"></div>
<div class="corner right"></div>
</div>

</div>


</div>

</div>
</div>
-->
<?php 
include 'footer.php';
?>