<?php 
require_once 'header.php';
?>
<script type="text/javascript">

$(function(){ 
  $("#list").jqGrid({
    url:'example.php',
    datatype: 'json',
    mtype: 'GET',
    colNames:['Status', 'Kampagne', 'Startdatum', 'Enddatum'],
    colModel :[ 
      {name:'state', index:'state', width:100, align:'center'}, 
      {name:'name', index:'name', width:500,resizable:true,editable:true,editoptions:{size:100}},
      {name:'startDate', index:'startDate', width:180, align:'center',resizable:true,editable:true,editoptions:{size:100}},
      {name:'endDate', index:'endDate', width:180, align:'center',resizable:true,editable:true,editoptions:{size:100}}
    ],
    pager: '#pager',
    rowNum:50,
    rowList:[10,20,30],
    sortname: 'startDate',
    sortorder: 'desc',
    viewrecords: true,
    autowidth: true,
	rownumbers: true,
   gridview: true,
    width: "100%",
    height: 400,
    caption: 'Kampagnen',
    editurl:"campaign_add_do.php",
//    toolbar:[true,"top"],
    ondblClickRow: function(rowid) {
    	var grid = $("#list");
        jQuery(this).jqGrid('editGridRow', rowid, { width: 'auto' },
                            {recreateForm:true,closeAfterEdit:true,
                             closeOnEscape:true,reloadAfterSubmit:false}
                             );
    }
 //   	jsonReader : { 
 //           root: "rows", 
 //           page: "page", 
 //           total: "total", 
 //           records: "records", 
 //           repeatitems: true, 
 //           cell: "cell", 
 //           id: "id",
 //           userdata: "userdata"
 //   	}
  }); 
  var grid = $("#list");
  $("#list").jqGrid('navGrid','#pager',{edit:true,add:true,del:true},
	        {dataheight: 100, height: 290, width: 'auto', jqModal: true, closeOnEscape: true, reloadAfterSubmit:true }, // Edit options
	        {dataheight: 100, height: 290, width: 'auto', jqModal: true, closeOnEscape: true, reloadAfterSubmit:true }, // Add options
	        {}, // Delete options
	        {}, // Search options
	        {} // View options
		  );
//  $("#list").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
});
</script>
<?php 
$page ="campaign";
include_once 'inc/oaHeader.php';
include_once 'inc/oaNavigation.php';
?>



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
<span class="label">Kampagnen</span>
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

//-->
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
<!-- jqGrid Table Inhalt -->
<div style="margin:10px;">
<table id="list"><tr><td/></tr></table> 
<div id="pager"></div> 
</div>
<!-- /jqGrid Table Inhalt -->

</div>


</div>

</div>
</div>
</body>
</html>