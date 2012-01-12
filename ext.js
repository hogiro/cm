/*
Ext.onReady(function() {
    Ext.QuickTips.init();
    
   
    
    var htmlEditor = {
      xtype          : 'htmleditor',
      fieldLabel     : "",
      anchor         : '100% 100%',
      allowBlank     : false,
      validateValue  : function() {
        var val = this.getRawValue();  
        return  false;
      }
    }
    var f = {
      xtype      : 'form',
      labelWidth : -20,
      items      : htmlEditor,
      border     : false
    }
    new Ext.Window({
      title      : '',
      layout     : 'fit',
      height     : 300,
      width      : 600,
      items      : f,
      buttons    : [
        {
          text : "Is the html editor valid??",
          handler : function() {
            var isValid = Ext.getCmp('ext-comp-1003').form.isValid();
            var msg = (isValid) ? 'valid' : 'invalid';
            Ext.MessageBox.alert('Title', 'The HTML Editor is ' + msg);
          }
        }
      
      ]
    }).show();

});



*/

Ext.onReady(function(){
	

	
  //  Ext.tip.QuickTipManager.init();
	
//	store.load({params:{start:0,limit:25}});
	
	Ext.define('User', {
	    extend: 'Ext.data.Model',
	    fields: [ 'state', 'name', 'startDate', 'endDate' ]
	});
	
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
	
	Ext.create('Ext.grid.Panel', {
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
	        			     // 
	        			    ],
	        			    title: 'Hello Window',
	        			    width: 600,
	        			    height: 500,
	        			    id: 'myWindow',
	        			    html:'<p>aaaa</p>' 
	        			}).show();
	                }
	            }
	      }
	});



	
	var myForm=	new Ext.FormPanel ({
							url:'campaign_add.php',
							//renderTo: 'addNewRow',
							frame: true,
							title: 'Movie Information Form',
							id: 'myForm',
							width:'100%',
							height:'100%',
							items: [{
										xtype: 'textfield',
										fieldLabel: 'Kampagne',
										name: 'title',
										width:500
									},
									{
										xtype: 'datefield',
										fieldLabel: 'Director',
										name: 'director'
									},
									{
										xtype: 'textfield',
										fieldLabel: 'Released',
										name: 'released'
									}],
									buttons: [{
text: 'Save',
handler: function(){
myForm.getForm().submit({
success: function(f,a){
Ext.Msg.alert('Success', 'It worked');
},
failure: function(f,a){
Ext.Msg.alert('Warning', 'Error');
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
                 title    : "title",
                closeAction   : 'close',
                id            : 'win',
                height        : 800,
                width         : 600,
                constrain     : true,
                items:[
                myForm
                ]
            });
        }
        win.show();
    }

/*
var win;
var winAdd = function(){
if (! win) {
            win=	new Ext.Window({
            	id: 'addWindow',
            	layout:'fit',
            	initCenter:false,
            	items: myForm,
            	title: 'Neue Kampagne hinzuf&uuml;gen',
            	width:800,
            	height:600,
            	constrain : true,
            	closeAction   : 'hide'
            	
            });
	}
	win.show();
}

*/
	
});




