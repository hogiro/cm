/*
 *  Campaign Operations
 */
Ext.onReady(function(){
Ext.require([
    'Ext.grid.*',
    'Ext.data.*'
]);

/*
 *  Declaration of Windows for new campaigns and campaign details
 */
var win;
var winNew, winDetail;


 var filterCampaigns = new Ext.form.ComboBox({
		name: 'filterCampaigns',
		width: 300,
		store: new Ext.data.ArrayStore({
			    fields: 	    	
			    	 ['state', 'val'],
				    data  : [
				      ["Alle Kampagnen", ""],
				      ["Aktive Kampagnen", "aktiv"],
				      ["Beendete Kampagnen", "beendet"],
				      ["Erwartete Kampagnen", "erwartet"]
				    ]
			    
			  
				}),
		  mode : 'local',
		//  value: '',
		  listWidth     : 200,
		  triggerAction : 'all',
		  displayField  : 'state',
		  valueField    : 'val',
		  editable      : false,
		  forceSelection: true,
		  emptyText: 'Auswahl'
});




/*
 *   Campaign Model
 *   ------------------------------------------------------------------------------------------
 */
Ext.define ('Campaigns', {
	extend: 'Ext.data.Model',
	fields: [
			 {name: 'campaign_id'},
	         {name: 'state'},
	         {name: 'name'},
	         {name: 'startDate'},
	         {name: 'endDate'}
	         ]
});

/*
 *  Campaign Main Store
 *  ------------------------------------------------------------------------------------------
 */
var store = Ext.create('Ext.data.Store',{
	model: 'Campaigns',
	autoLoad: true,
	remoteSort:true,
	remoteFilter:true,
	pageSize:50,
	proxy: {
		type: 'ajax',
		url : 'campaign_data.php',
		reader: {
			type: 'json',
			root: 'rows',
			totalProperty: 'totalCount'
		},
		simpleSortMode:true
	},
	sorters: [{
		property:'name',
		direction:'ASC'
	}],
	filters:[{
		property: 'state',
		value:filterCampaigns.value
	}]
});


/*
 *   User Combobox Model
 *   ------------------------------------------------------------------------------------------
 */
Ext.define ('Users', {
	extend: 'Ext.data.Model',
	fields: [
			 {name: 'user_id'},
	         {name: 'username'}
	         ]
});


/*
 *  User Combobox Store
 *  ------------------------------------------------------------------------------------------
 */
var storeUsers = Ext.create('Ext.data.Store',{
	model: 'Users',
	autoLoad: true,
	proxy: {
		type: 'ajax',
		url : 'user_data.php',
		reader: {
			type: 'json',
			root: 'rows',
			totalProperty: 'totalCount'
		},
		simpleSortMode:true
	}
});
	

/*
 *  ComboBox for Paginagion Limit on Campaign Grid
 *  ------------------------------------------------------------------------------------------
 */	
var comboPageSize = new Ext.form.ComboBox({
	  name : 'perpage',
	  width: 80,
	  store: new Ext.data.ArrayStore({
	    fields: ['id'],
	    data  : [
	      ['25'],
	      ['50'],
	      ['75'],
	      ['100']
	    ]
	  }),
	  mode : 'local',
	  value: '50',

	  listWidth     : 40,
	  triggerAction : 'all',
	  displayField  : 'id',
	  valueField    : 'id',
	  editable      : false,
	  forceSelection: true
	});

/*
 *  Bottom Bar for Campaign Grid
 *  ------------------------------------------------------------------------------------------
 */
var bbar = new Ext.PagingToolbar({
	  store:       store, //the store you use in your grid
	  displayInfo: true,
	  pageSize:100,
	  items   :    [
	    '-',
	    'Per Page: ',
	    comboPageSize
	  ]
	});

	comboPageSize.on('select', function(combo, value) {
	 store.pageSize = combo.value;
	  store.load();
	  bbar.doLoad(bbar.cursor);
	}, this);


/*
 *  Campaign Grid
 *  ------------------------------------------------------------------------------------------
 */
	var grid = Ext.create('Ext.grid.Panel', {
		store: store,
		width: 'auto',
		height:700,
		tbar: toolbar,
		title: 'Kampagnen',
		renderTo: 'pager',	
		remoteSort:true,
		//renderTo: Ext.getBody(),
		selModel: Ext.create('Ext.selection.CheckboxModel'), //1
		columns: [
		          Ext.create('Ext.grid.RowNumberer'), //2
		          {
		          	  text: 'Status', //3
		        	  width:100,
		        	  dataIndex: 'state'
		          	
		          }, {
		        	  text: 'Kampagne', //3
		        	  flex: 1,
		        	  dataIndex: 'name'
		          }, {
		        	  text: 'Startdatum', //4
		        	  width: 100,
		        	  dataIndex: 'startDate',
		        	  renderer: Ext.util.Format.dateRenderer('d.m.Y')
		          }, {
		        	  text: 'Enddatum', //5
		        	  width: 100,
		        	  dataIndex: 'endDate',
		        	  renderer: Ext.util.Format.dateRenderer('d.m.Y')
		          }],
		   tbar: [{
            text:'Neue Kampagne',
            tooltip:'Add a new row',
            iconCls:'add',
            handler: function(){
            	if (! winNew) {
            			winNew = Ext.create('Ext.window.Window', {
                		title    : "Neue Kampagne Hinzuf&uuml;gen",
                		closeAction   : 'close',
                		id            : 'winNew',
                		layout		  : 'fit',
                		modal		  : true,
                		closable	  : false,
                		height:Ext.getBody().getViewSize().height*0.95,
    					width:Ext.getBody().getViewSize().width*0.95, //80%
                		constrain     : true,
                		items:[
                			myForm
                		]
            		});
        		}
        		winNew.show();
            }

        }, '-', {
            text:'L&ouml;schen',
            tooltip:'Remove the selected item',
            iconCls:'remove',
            handler: function() {
            	
            },
            
            // Place a reference in the GridPanel
            ref: '../removeButton',
            disabled: true
        }, '-' , 'Filter: ',filterCampaigns],
         bbar: bbar,
	    viewConfig: {
	        forceFit:true,
	        listeners: {
	        	 itemdblclick: function(dataview, index, item, e){
        			var sm = grid.getSelectionModel().getSelection();
					if (! winDetail) {
            			winDetail = Ext.create('Ext.Window', {
                		title    : "Kampagne Eigenschaften",
                		closeAction   : 'close',
                		id            : 'win',
                		closable	  : false,
                		height:Ext.getBody().getViewSize().height*0.95,
    					width:Ext.getBody().getViewSize().width*0.95, //80%
						modal		  : true,
						layout		  : 'fit',
						autoScroll    : true,
                		constrain     : true,
                		items:[
                			detailForm
                		]
            		});
        		}
        		
        		detailForm.getForm().load({
				url : 'campaign_getdetail.php?id='+sm[0].get('campaign_id')
					});
					winDetail.show();

	            }
	        }
	      }
	});
	
	filterCampaigns.on('select', function(combo, value) {
		store.clearFilter();
		var stateFilter = new Ext.util.Filter({
   		property: "state", value: combo.value
		});
		store.filter(stateFilter);
	  	store.load();
	}, this);

/*
*  FORM for adding new Campaigns
*  ------------------------------------------------------------------------------------------
*/
	var myForm=	Ext.create('Ext.form.Panel', {
							url:'campaign_add.php',
							//renderTo: 'addNewRow',
							frame: true,
							id: 'myForm',
							width:'100%',
							height:'100%',
							autoScroll:true,
							items: [{
										xtype: 'textfield',
										fieldLabel: 'Kampagne',
										name: 'name',
										width:700
									},
									{
										xtype: 'datefield',
										format: 'd.m.Y', 
										fieldLabel: 'Startdatum',
										name: 'startDate',
										minValue: new Date(2012, 0, 1),
    									value: new Date()
									},
									{
										xtype		: 'datefield',
										format		: 'd.m.Y', 
										fieldLabel	: 'Enddatum',
										name		: 'endDate',
										minValue	: new Date(2012, 0, 1),
    									value		: new Date()
									},
									{
										xtype		: 'textarea',
										fieldLabel	: 'Kunde',
										name		: 'customer',
										width		: 800,
										minHeight	: 100,
										grow		: false
					
									},{
										xtype: 'combobox',
										fieldLabel: 'Ansprechpartner',
										name: 'user',
										displayField:'username',
										valueField:'user_id',
										width:400,
										store:storeUsers
									},{
										xtype		: 'textarea',
										fieldLabel	: 'Umfeld Webseiten',
										name		: 'websites',
										width		: 800,
										minHeight	: 100,
										grow		: false
									},
									{
										xtype		: 'textarea',
										fieldLabel	: 'Volumen Verteilung',
										name		: 'volumes',
										width		: 800,
										minHeight	: 100,
										grow		: false
									},
									{
										xtype		: 'textarea',
										fieldLabel	: 'Anmerkungen',
										name		: 'rebook',
										width		: 800,
										minHeight	: 100,
										grow		: false
									},
									{
										xtype		: 'textarea',
										fieldLabel	: 'Auftrag Vereinbarung (Kunde)',
										name		: 'avk',
										width		: 800,
										minHeight	: 100,
										grow		: false
									},
									{
										xtype		: 'textarea',
										fieldLabel	: 'Auftrag Vereinbarung (Webseiten)',
										name		: 'avw',
										width		: 800,
										minHeight	: 100,
										grow		: false
									}],
									buttons: [{
										text: 'Speichern',
										handler: function(){
											myForm.getForm().submit({
												success: function(f,a){
													Ext.MessageBox.alert('Status', 'Die Kampagne wurde angelegt!');
													Ext.Function.defer(Ext.MessageBox.hide, 1500, Ext.MessageBox);
													myForm.getForm().reset();
													store.load();
													grid.getView().refresh();
													
												},
												failure: function(f,a){
													Ext.Msg.alert('Status', 'Error');
												}
												
										});
										myForm.up("window").close();
										
									}
									
							}, {
								text: 'Schliessen',
								handler: function(){
								myForm.getForm().reset();
								myForm.up("window").close();
							}
						}]

		});  


/*
 *  Form Detail of the Campaigns
 *  ------------------------------------------------------------------------------------------
 */
	var detailForm =Ext.create('Ext.form.Panel',  {
						url:'campaign_update.php',
						id: 'detailForm',
						frame: true,
						width:'100%',
						//headers: {'Content-Type': 'application/json; charset=UTF-8'},
						height:'100%',
						autoScroll:true,
						items: [{
        								xtype: 'hiddenfield',
        								name: 'campaign_id'
    							},{
										xtype: 'textfield',
										fieldLabel: 'Kampagne',
										name: 'name',
										width:700
									},
									{
										xtype: 'datefield',
										format: 'd.m.Y', 
										fieldLabel: 'Startdatum',
										name: 'startDate',
										minValue: new Date(2012, 0, 1),
    									value: new Date()
									},
									{
										xtype: 'datefield',
										format: 'd.m.Y', 
										fieldLabel: 'Enddatum',
										name: 'endDate',
										minValue: new Date(2012, 0, 1),
    									value: new Date()
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Kunde',
										name: 'customer',
										width:750,
										height:100
									},{
										xtype: 'combobox',
										fieldLabel: 'Ansprechpartner',
										name: 'user',
										displayField:'username',
										valueField:'user_id',
										width:400,
										store:storeUsers,
										value:'user'
									},{
										xtype: 'textarea',
										fieldLabel: 'Umfeld Webseiten',
										name: 'websites',
										width:750,
										minHeight:200
										
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Volumen Verteilung',
										name: 'volumes',
										width:750,
										minHeight:200
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Anmerkungen',
										name: 'rebook',
										width:750,
										minHeight:200
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Auftrag Vereinbarung (Kunde)',
										name: 'avk',
										width:750,
										minHeight:80
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Auftrag Vereinbarung (Webseiten)',
										name: 'avw',
										width:750,
										minHeight:80
									}],
								
								buttons: [{
									text: 'Speichern',
									handler: function(){
										detailForm.getForm().submit({
											success: function(f,a){
												Ext.MessageBox.alert('Status', 'Die Kampagne wurde aktualisiert!');
												Ext.Function.defer(Ext.MessageBox.hide, 1500, Ext.MessageBox);
											//	detailForm.getForm().reset();
												//win.close();
											},
											failure: function(f,a){
												Ext.Msg.alert('Status', 'Error');
											}
										
										});
										//detailForm.up("window").close();
										grid.getStore().load();
										detailForm.getForm().load();
									}
								},{
									text: 'Schliessen',
									handler: function(){
										detailForm.getForm().reset();
										detailForm.up("window").close();
										grid.getStore().load();
									}
								}]
	});
		

	
});
