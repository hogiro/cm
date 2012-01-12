<?php 
require_once 'header.php';
?>

<script type="text/javascript">
$(function(){
	$("#list").jqGrid({
		url:'websiteGet.php',
		datatype: 'json',
		mtype: 'GET',
		colNames:['Website', 'Reichweite'],
		colModel :[
					{name:'name', index:'name', width:200, resizable:true,editable:true,editoptions:{size:100} },
					{name:'range', index:'range', width:200,resizable:true,editable:true,editoptions:{size:100} }
					],
					pager: '#pager',
					rowNum:50,
					rowList:[10,20,30],
					sortname: 'name',
					sortorder: 'desc',
					viewrecords: true,
					autowidth: true,
					rownumbers: true,
					gridview: true,
					width: 700,
					height: 400,
					caption: 'Webseiten',
					editurl:"websiteDo.php",
				//	toolbar:[true,"top"],
					ondblClickRow: function(rowid) {
						jQuery(this).jqGrid('editGridRow', rowid, { width: 'auto' },
						{
							recreateForm:true,closeAfterEdit:true,
							closeOnEscape:true,reloadAfterSubmit:false});
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
			{ beforeShowForm: function(form) {
                // "editmodlist"
                var dlgDiv = $("#editmod" + grid[0].id);
                var parentDiv = dlgDiv.parent(); // div#gbox_list
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                // TODO: change parentWidth and parentHeight in case of the grid
                //       is larger as the browser window
                  dlgDiv[0].style.width = 600 + "px";
                dlgDiv[0].style.height =  + "auto";
                dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)/2) + "px";
                dlgDiv[0].style.left = Math.round((parentWidth-dlgWidth)/2) + "px";
              
            }}
			);
});

</script>

<?php 
$page ="website";
include_once 'inc/oaHeader.php';
include_once 'inc/oaNavigation.php';
//include_once 'inc/firstLevelContent.php';
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

<?php 
include 'footer.php';
?>