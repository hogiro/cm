Ext.onReady(function(){
Ext.require([
    'Ext.grid.*',
    'Ext.data.*'
]);

Ext.define ('Status', {
		extend: 'Ext.data.Model',
		fields: [
				 {name: 'campaign_id'},
		         {name: 'name'},
		         {name: 'startDate'},
		         {name: 'endDate'},
		         {name: 'totalDays'},
		         {name: 'actualDays'}
		         /*
		         {name: 'volume'},
		         {name: 'soll'},
		         {name: 'ist'},
		         {name: 'clicks'},
		         {name: 'ctr'},
		         {name: 'performance'}
		         */
		         ]
	});
	

	var store = Ext.create('Ext.data.Store',{
		model: 'Status',
		autoLoad: true,
		remoteSort:true,
		proxy: {
			type: 'ajax',
			url : 'status_data.php',
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
				  }, {
		        	  text: 'Laufzeit (Tage)', //5
		        	  width: 100,
		        	  dataIndex: 'totalDays'
		          }, {
		        	  text: 'Ist (Tage)', //5
		        	  width: 100,
		        	  dataIndex: 'actualDays'
		          }
		      ],
		   
         bbar: bbar
	});	
});





