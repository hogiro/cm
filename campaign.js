Ext.onReady(function(){
Ext.require([
    'Ext.grid.*',
    'Ext.data.*'
]);

var win;
var winNew, winDetail;



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
	
Ext.define('User', {
	    extend: 'Ext.data.Model',
	    fields: [ 'state', 'name', 'startDate', 'endDate' ]
	});
	

		/*
	var store = Ext.create('Ext.data.ArrayStore', {
		model: 'Book',
	
		data:[
		      
		      ['Ext JS 4: First Look', 'Ext JS', false, null, 0],
		      ['Learning Ext JS 3.2','Ext JS','3.2',true, '2010/10/01', 40.49],
		      ['Ext JS 3.0 Cookbook','Ext JS','3', true, '2009/10/01', 44.99],
		      ['Learning Ext JS','Ext JS','2.x', true, '2008/11/01', 35.99]
		     ]
		     */
	var store = Ext.create('Ext.data.Store',{
		model: 'Campaigns',
		autoLoad: true,
		remoteSort:true,
		proxy: {
			type: 'ajax',
			url : 'campaign_data.php',
			//headers: {'Content-Type': 'application/json; charset=UTF-8'},
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
		}]
	});
	
	/*
	var rowEditor = Ext.create('Ext.grid.plugin.RowEditing', {
	clicksToEdit: 1
	});
	*/

/*
 *  Kampagnen Grid
 */
	
var combo = new Ext.form.ComboBox({
  name : 'perpage',
  width: 40,
  store: new Ext.data.ArrayStore({
    fields: ['id'],
    data  : [
      ['15'],
      ['25'],
      ['50']
    ]
  }),
  mode : 'local',
  value: '15',

  listWidth     : 40,
  triggerAction : 'all',
  displayField  : 'id',
  valueField    : 'id',
  editable      : false,
  forceSelection: true
});

var bbar = new Ext.PagingToolbar({
  store:       store, //the store you use in your grid
  displayInfo: true,
  pageSize:100,
  items   :    [
    '-',
    'Per Page: ',
    combo
  ]
});

combo.on('select', function(combo, record) {
  bbar.pageSize = parseInt(record.get('id'), 10);
  bbar.doLoad(bbar.cursor);
}, this);

/*
var bbar = Ext.create('Ext.PagingToolbar', {
	          store: store,
	          displayInfo: true,
	          pageSize: 100,
	          displayMsg: 'Displaying topics {0} - {1} of {2}',
	          emptyMsg: 'No topics to display'
});

*/
combo.on('select', function(combo, record) {
  bbar.pageSize = parseInt(record.get('id'), 10);
  bbar.doLoad(bbar.cursor);
}, this);

var grid = Ext.create('Ext.grid.Panel', {
		store: store,
		width: 'auto',
		height:650,
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
		          }
		          
		          /*, {
		        	  xtype:'actioncolumn', //8
		        	  width:50,
		        	  items: [{
		        		  icon: 'images/edit.png',
		        		  tooltip: 'Edit',
		        		  handler: function(grid, rowIndex, colIndex) {
		        			  var rec = grid.getStore().getAt(rowIndex);
		        			  Ext.MessageBox.alert('Edit',rec.get('name'));
		        		  }
		        }, {
		        	  icon: 'images/delete.gif',
		        	  tooltip: 'Delete',
		        	  handler: function(grid, rowIndex, colIndex) {
		        		  var rec = grid.getStore().getAt(rowIndex);
		        		  Ext.MessageBox.alert('Delete',rec.get('name'));
		        	  }
		        	  		       
		        }]
		     }
		     
		      */
		      ],
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

        }, '-', /*{
            text:'Bearbeiten',
            tooltip:'Bearbeiten',
            iconCls:'option',
            handler: function() {
            	Ext.Msg.alert('Alert', 'Add new X item!');
            	}
        },'-',*/{
            text:'L&ouml;schen',
            tooltip:'Remove the selected item',
            iconCls:'remove',
            handler: function() {
            	
            },
            
            // Place a reference in the GridPanel
            ref: '../removeButton',
            disabled: true
        }, '-', {
        		xtype: 'combo',
        		label: 'Anzeige:',
        		width: 300,
        		store: [
        			'Alle Kampagnen',
        			'Active Kampagnen',
        			'Beendete Kampagnen',
        			'Erwartete Kampagnen'
        		]
        }],
         bbar: bbar,
	    viewConfig: {
	        forceFit:true,
	        listeners: {
	        	 itemdblclick: function(dataview, index, item, e){
	        	 	//var store = grid.getStore();	
        			var sm = grid.getSelectionModel().getSelection();
					if (! winDetail) {
            			winDetail = Ext.create('Ext.Window', {
                		title    : "Kampagne Eigenschaften",
                		closeAction   : 'close',
                		id            : 'win',
                		closable	  : false,
                		/*
                		width         : 800,
						height        : 800,
						*/
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
	

	/*
	 *  FORM for adding new Campaigns
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
										fieldLabel	: 'Ansprechpartner',
										name		: 'customer',
										width		: 800,
										minHeight	: 100,
										grow		: false
					
									},
									{
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
    var newWindow = function(formName) {
        if (! win) {
            win = Ext.create('Ext.Window', {
                title    : "Neue Kampagne Hinzuf&uuml;gen",
                closeAction   : 'destroy',
                id            : 'win',
                width         : 800,
				height        : 800,
                constrain     : true,
                items:[
                formName
                ]
            });
        }
        win.show();
    }
    
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
										fieldLabel: 'Ansprechpartner',
										name: 'customer',
										width:750,
										height:100
									},
									{
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



function elasticTextArea (elementId){

    /*
     * This are two helper functions, they are delcared here for convinience
     * so we can get and set all styles at once and because they are not available in ext-core
     * only in ExtJs
     */
     
    //available in extjs (not ext-core) as element.getStyles
    function getStyles(el, arguments){
        var ret = {};
        total = arguments.length ;
        for (var n=0; n<total; n++ )
           ret[ arguments[n] ] = el.getStyle(arguments[n]); 
        return ret;
    }
    
    //available in extjs (not ext-core) as Ext.Domhelper.applyStyles
    function applyStyles  (el, styles){
        if(styles){
            var i = 0,
                len,
                style; 
                
            el = Ext.fly(el);                   
            if(Ext.isFunction(styles)) {
                styles = styles.call();
            }
            if (typeof styles == "string") {
                styles = styles.split(/:|;/g);
                for (len = styles.length; i < len;) {
                    el.setStyle(styles[i++], styles[i++]);  
                }
            } else if (Ext.isObject(styles)) {
                el.setStyle(styles);
            }           
        }   
    }
    
    //minimum and maximum text area size
    var minHeight = 10 ;
    var maxHeight = 300 ;

    //increment value when resizing the text area
    var growBy = 20 ;
    
    var el = Ext.get(elementId);
  //get text area width
    var width = el.getWidth();

    //current text area styles
    var styles = getStyles(el, ['padding-top', 'padding-bottom', 'padding-left', 'padding-right', 'line-height', 'font-size', 'font-family', 'font-weight', 'font-style']);

    //store text area width into styles object to later apply them to the div 
    styles.width = width +'px' ;
        //hide the text area scrool to avoid flickering
        el.setStyle('overflow', 'hidden');
      //create the hidden div only if does not exists
        if(! this.div){

            //create the hidden div outside the viewport area
            this.div = Ext.DomHelper.append(Ext.getBody() || document.body, {
                'id':elementId + '-preview-div'
                ,'tag' : 'div'
                ,'style' : 'position: absolute; top: -100000px; left: -100000px;'
            }, true);

            //apply the text area styles to the hidden div
            applyStyles(this.div, styles);


            //recalculate the div height on each key stroke
            el.on('keyup', function() {
                elasticTextArea(elementId);
            }, this);
        }

      //clean up text area contents, so that no special chars are processed
      //replace \n with <br>&nbsp; so that the enter key can trigger a height increase
      //but first remove all previous entries, so that the height measurement can be as accurate as possible
          this.div.update( 
                  el.dom.value.replace(/<br \/>&nbsp;/, '<br />')
                              .replace(/<|>/g, ' ')
                              .replace(/&/g,"&amp;")
                              .replace(/\n/g, '<br />&nbsp;') 
                  );

          //finally get the div height
          var textHeight = this.div.getHeight();
      //enforce text area maximum and minimum size
          if ( (textHeight > maxHeight ) && (maxHeight > 0) ){
              textHeight = maxHeight ;
              el.setStyle('overflow', 'auto');
          }
          if ( (textHeight < minHeight ) && (minHeight > 0) ) {
              textHeight = minHeight ;
          }

          //resize the text area
          el.setHeight(textHeight + growBy , true);
      }

