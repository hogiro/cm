/*

Ext.application({
    name: 'CM',
    launch: function() {
    	Ext.create('Ext.container.Viewport', {
    	    layout: 'border',
    	    renderTo: Ext.getBody(),
    	    items: [{
    	        region: 'north',
    	        html: '<h1 class="x-panel-header">CM Ad-Manager</h1>',
    	        autoHeight: true,
    	        border: false,
    	        margins: '0 0 5 0'
    	    }, {
    	        region: 'west',
    	        collapsible: true,
    	        title: 'Navigation',
    	        width: 150
    	        // could use a TreePanel or AccordionLayout for navigational items
    	    }, {
    	        region: 'south',
    	        title: 'South Panel',
    	        collapsible: true,
    	        html: 'Information goes here',
    	        split: true,
    	        height: 100,
    	        minHeight: 100
    	    }, {
    	        region: 'east',
    	        title: 'East Panel',
    	        collapsible: true,
    	        split: true,
    	        width: 150
    	    }, {
    	        region: 'center',
    	        xtype: 'tabpanel', // TabPanel itself has no title
    	        activeTab: 0,      // First tab active by default
    	        items: {
    	            title: 'Default Tab',
    	            html: 'The first tab\'s content. Others may be added dynamically'
    	        }
    	    }]
    	});

    }
});



// explicitly create a Container
Ext.create('Ext.container.Container', {
    layout: {
        type: 'hbox'
    },
    width: 400,
    renderTo: Ext.getBody(),
    border: 1,
    style: {borderColor:'#000000', borderStyle:'solid', borderWidth:'1px'},
    defaults: {
        labelWidth: 80,
        // implicitly create Container by specifying xtype
        xtype: 'datefield',
        flex: 1,
        style: {
            padding: '10px'
        }
    },
    items: [{
        xtype: 'datefield',
        name: 'startDate',
        fieldLabel: 'Start date'
    },{
        xtype: 'datefield',
        name: 'endDate',
        fieldLabel: 'End date'
    }]
});

*/

/*
Ext.onReady(function(){
    var win,
        button = Ext.get('show-btn');

    button.on('click', function(){

        if (!win) {
            win = Ext.create('widget.window', {
                title: 'Layout Window',
                closable: true,
                closeAction: 'hide',
                //animateTarget: this,
                width: 800,
                height: 500,
                layout: 'border',
                bodyStyle: 'padding: 5px;',
                items: [{
                    region: 'west',
                    title: 'Navigation',
                    width: 200,
                    split: true,
                    collapsible: true,
                    floatable: false
                }, {
                    region: 'center',
                    xtype: 'tabpanel',
                    items: [{
                        title: 'Bogus Tab',
                        html: 'Hello world 1'
                    }, {
                        title: 'Another Tab',
                        html: 'Hello world 2',
                        closable:true
                    }, {
                        title: 'Closable Tab',
                        html: 'Hello world 3',
                        closable: true
                    }]
                }]
            });
        }
        button.dom.disabled = true;
        if (win.isVisible()) {
            win.hide(this, function() {
                button.dom.disabled = false;
            });
        } else {
            win.show(this, function() {
                button.dom.disabled = false;
            });
        }
    });
});


*/

Ext.onReady(function(){
	
//	store.load({params:{start:0,limit:25}});
	
	Ext.define('User', {
	    extend: 'Ext.data.Model',
	    fields: [ 'state', 'name' ]
	});
	
	var userStore = Ext.create('Ext.data.Store', {
	    model: 'User',
	    autoLoad: true,
	    pageSize: 10,
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
	
	Ext.create('Ext.grid.Panel', {
	    renderTo: Ext.getBody(),
	    store: userStore,
	       bbar: Ext.create('Ext.PagingToolbar', {
	            store: userStore,
	            displayInfo: true,
	            displayMsg: 'Displaying topics {0} - {1} of {2}',
	            emptyMsg: "No topics to display",
	        }),
	    width: 600,
	    height: 500,
	    title: 'Kampagnen',
	    columns: [
	        {
	            text: 'Status',
	            width: 100,
	            sortable: false,
	            hideable: false,
	            dataIndex: 'state'
	        },
	        {
	            text: 'Name',
	            width: 150,
	            dataIndex: 'name',
	          //  renderer: function(value) {
	          //      return Ext.String.format('<a href="mailto:{0}">{1}</a>', value, value);
	       //     },
	            hidden: false
	        }
	    ]
	});

	/*
	Ext.create('Ext.data.Store', {
	    storeId:'simpsonsStore',
	    fields:['name', 'email', 'phone'],
	    data:{'items':[
	        { 'name': 'Lisa',  "email":"lisa@simpsons.com",  "phone":"555-111-1224"  },
	        { 'name': 'Bart',  "email":"bart@simpsons.com",  "phone":"555-222-1234" },
	        { 'name': 'Homer', "email":"home@simpsons.com",  "phone":"555-222-1244"  },
	        { 'name': 'Marge', "email":"marge@simpsons.com", "phone":"555-222-1254"  }
	    ]},
	    proxy: {
	        type: 'memory',
	        reader: {
	            type: 'json',
	            root: 'items'
	        }
	    }
	});

	Ext.create('Ext.grid.Panel', {
	    title: 'Simpsons',
	    store: Ext.data.StoreManager.lookup('simpsonsStore'),
	    columns: [
	        { header: 'Name',  dataIndex: 'name' },
	        { header: 'Email', dataIndex: 'email', flex: 1 },
	        { header: 'Phone', dataIndex: 'phone' }
	    ],
	    height: 200,
	    width: 400,
	    renderTo: Ext.getBody()
	});

*/	
	
});


/*

Ext.onReady(function(){
	  Ext.define('UsgsList', {
	    extend: 'Ext.data.Model',
	    fields: [
	       {name: 'fid',       type: 'int'},
	       {name: 'title',     type: 'string'},
	       {name: 'description',  type: 'string'},
	       {name: 'link',      type: 'string'},
	       {name: 'pubDate',    type: 'date'},
	       {name: 'lat',      type: 'string'},
	       {name: 'long',      type: 'string'}
	    ],
	    idProperty: 'fid'
	});

	var store = Ext.create('Ext.data.Store', {
	    id: 'store',
	    model: 'UsgsList',
	    proxy: {
	       type: 'jsonp',
	       url: 'http://query.yahooapis.com/v1/public/yql',
	    extraParams: {
	       q: 'select * from rss where url="http://earthquake.usgs.gov/earthquakes/catalogs/eqs7day-M2.5.xml"',
	       format: 'json'
	   },
	   reader: {
	      root: 'query.results.item',
	   }
	 }
	});

	function renderTitle(value, p, record) {
	   return Ext.String.format('<a href="{1}" target="_blank">{0}</a>',
	   value,
	   record.data.link
	   );
	}

	var grid = Ext.create('Ext.grid.Panel', {
	   width: 700,
	   height: 500,
	   title: 'USGS - M2.5+',
	   store: store,
	   loadMask: true,
	   disableSelection: true,
	   invalidateScrollerOnRefresh: false,
	   viewConfig: {
	     trackOver: false
	   },
	   // grid columns
	   columns:[{
	      xtype: 'rownumberer',
	      width: 50,
	      sortable: false
	   },{
	      id: 'title',
	      text: "Title",
	      dataIndex: 'title',
	      flex: 1,
	      renderer: renderTitle,
	      sortable: false
	   },{
	      id: 'pubDate',
	      text: "Published Date",
	      dataIndex: 'pubDate',
	      width: 130,
	      renderer: Ext.util.Format.dateRenderer('n/j/Y g:i A'),
	      sortable: true
	   }],
	   renderTo: Ext.getBody()
	});

	// trigger the data store load
	store.load();
	});

*/

