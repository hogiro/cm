Ext.onReady(function(){
	

  //  Ext.tip.QuickTipManager.init();
	
//	store.load({params:{start:0,limit:25}});
	

	var userStore = Ext.create('Ext.data.Store', {
	    model: 'User',
	    autoLoad: true,
	    pageSize: 50,
	    proxy: {
	        type: 'ajax',
	        url : 'data.php',
	        reader: {
	            type: 'json',
	            root: 'rows',
	            totalProperty: 'totalCount'
	        }
	    }
	});
	
	var myGrid=Ext.create('Ext.grid.Panel', {
	   // renderTo: Ext.getBody(),
		renderTo: 'pager',
	    store: userStore,
	    tbar:[{
            text:'Neue Kampagne',
            tooltip:'Add a new row',
            iconCls:'add',
            handler: function(){
            newWindow();
            }

        }, '-', {
            text:'Bearbeiten',
            tooltip:'Blah blah blah blaht',
            iconCls:'option',
            handler: function() {
            	Ext.Msg.alert('Alert', 'Add new X item!');
            	}
        },'-',{
            text:'L&ouml;schen',
            tooltip:'Remove the selected item',
            iconCls:'remove',

            // Place a reference in the GridPanel
            ref: '../removeButton',
            disabled: true
        }],
	    bbar: Ext.create('Ext.PagingToolbar', {
	          store: userStore,
	          displayInfo: true,
	          pageSize: 50,
	          displayMsg: 'Displaying topics {0} - {1} of {2}',
	          emptyMsg: 'No topics to display'
	    }),
	    width: 900,
	    height: 500,
	    title: 'Kampagnen',
	    columns: [
	        {
	            text: 'Status',
	            width: 100,
	            hideable: false,
	            dataIndex: 'state'
	        },
	        {
	            text: 'Name',
	            width: 500,
	            dataIndex: 'name',
	          //  renderer: function(value) {
	          //      return Ext.String.format('<a href="mailto:{0}">{1}</a>', value, value);
	       //     },
	            hidden: false
	        },
	        {
	            text: 'Startdatum',
	            width: 100,
	            sortable: false,
	            hideable: false,
	            dataIndex: 'startDate',
	            renderer: Ext.util.Format.dateRenderer('d.m.Y')
	        },
	        {
	            text: 'Enddatum',
	            width: 100,
	            sortable: false,
	            hideable: false,
	            dataIndex: 'endDate',
	            renderer: Ext.util.Format.dateRenderer('d.m.Y')
	        }
	    ],
	    viewConfig: {
	        forceFit:true,
	        listeners: {
	        	 itemdblclick: function(){
	        		 Ext.create('Ext.window.Window',{
	        			    layout: 'fit',
	        			    items: [
	        			     detailForm
	        			    ],
	        			    title: 'Hello Window',
	        			    width: 750,
	        			    height: 800,
	        			    id: 'myWindow',
	        			    html:'<p>aaaa</p>' 
	        			}).show();
	                }
	            }
	      }
	});



	/*
	 *  FORM for adding new Campaigns
	 */
	var myForm=	new Ext.FormPanel ({
							url:'campaign_add.php',
							//renderTo: 'addNewRow',
							frame: true,
							title: 'Movie Information Form',
							id: 'myForm',
							width:'100%',
							height:'100%',
							//autoScroll:true,
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
										name: 'startDate'
									},
									{
										xtype: 'datefield',
										format: 'd.m.Y', 
										fieldLabel: 'Enddatum',
										name: 'endDate'
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Ansprechpartner',
										name: 'customer',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Umfeld Webseiten',
										name: 'websites',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Volumen Verteilung',
										name: 'volumes',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Umbuchungen',
										name: 'rebook',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Auftrag Vereinbarung (Kunde)',
										name: 'avk',
										width:700,
										height:80
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Auftrag Vereinbarung (Webseiten)',
										name: 'avw',
										width:700,
										height:80
									},
									{
										xtype: 'combobox',
										fieldLabel: 'Ansprechpartner Intern',
										name: 'user',
										width:400
									}],
									buttons: [{
										text: 'Speichern',
										handler: function(){
											myForm.getForm().submit({
												success: function(f,a){
													Ext.MessageBox.alert('Status', 'Die Kampagne wurde angelegt!');
													Ext.Function.defer(Ext.MessageBox.hide, 1500, Ext.MessageBox);
													myForm.getForm().reset();
													win.close();
												},
												failure: function(f,a){
													Ext.Msg.alert('Status', 'Error');
												}
										});
									}
							}, {
								text: 'Reset',
								handler: function(){
								myForm.getForm().reset();
							}
						}]

					}).show();



    var win;
    var newWindow = function() {
        if (! win) {
            win = new Ext.Window({
                title    : "Neue Kampagne Hinzuf&uuml;gen",
                closeAction   : 'close',
                id            : 'win',
                width         : 800,
				height        : 800,
                constrain     : true,
                items:[
                myForm
                ]
            });
        }
        win.show();
    }
    
    
    
	var detailForm =	new Ext.FormPanel ({
							url:'campaign_edit.php',
							//renderTo: 'addNewRow',
							frame: true,
							title: 'Movie Information Form',
							id: 'detailForm',
							width:'100%',
							height:'100%',
							//autoScroll:true,
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
										name: 'startDate'
									},
									{
										xtype: 'datefield',
										format: 'd.m.Y', 
										fieldLabel: 'Enddatum',
										name: 'endDate'
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Ansprechpartner',
										name: 'customer',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Umfeld Webseiten',
										name: 'websites',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Volumen Verteilung',
										name: 'volumes',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Umbuchungen',
										name: 'rebook',
										width:700,
										height:100
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Auftrag Vereinbarung (Kunde)',
										name: 'avk',
										width:700,
										height:80
									},
									{
										xtype: 'textarea',
										fieldLabel: 'Auftrag Vereinbarung (Webseiten)',
										name: 'avw',
										width:700,
										height:80
									},
									{
										xtype: 'combobox',
										fieldLabel: 'Ansprechpartner Intern',
										name: 'user',
										width:400
									}],
									buttons: [{
										text: 'Speichern',
										handler: function(){
											detailForm.getForm().submit({
												success: function(f,a){
													Ext.MessageBox.alert('Status', 'Die Kampagne wurde angelegt!');
													Ext.Function.defer(Ext.MessageBox.hide, 1500, Ext.MessageBox);
													detailForm.getForm().reset();
													win.close();
											},
failure: function(f,a){
Ext.Msg.alert('Status', 'Error');
}
});
}
}, {
text: 'Reset',
handler: function(){
detailForm.getForm().reset();
}
}]
}).show();



});


