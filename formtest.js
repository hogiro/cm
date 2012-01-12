/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

Commercial Usage
Licensees holding valid commercial licenses may use this file in accordance with the Commercial Software License Agreement provided with the Software or, alternatively, in accordance with the terms contained in a written agreement between you and Sencha.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/


Ext.onReady(function() {
	
Ext.define('User', {
    extend: 'Ext.data.Model',
    fields: ['firstName', 'lastName', 'birthDate'],
    proxy: {
        type: 'ajax',
        api: {
            read: 'form.json',
            update: 'form.json'
        },
        reader: {
            type: 'json',
            root: 'users'
        }
    }
});

var userForm=Ext.create('Ext.form.Panel', {
    renderTo: Ext.getBody(),
    title: 'User Form',
    height: 130,
    width: 280,
    bodyPadding: 10,
    defaultType: 'textfield',
    items: [
        {
            fieldLabel: 'First Name',
            name: 'firstName'
        },
        {
            fieldLabel: 'Last Name',
            name: 'lastName'
        },
        {
            xtype: 'datefield',
            fieldLabel: 'Date of Birth',
            name: 'birthDate'
        }
    ]
});

Ext.ModelMgr.getModel('User').load(1, { // load user with ID of "1"
    success: function(user) {
        userForm.loadRecord(user); // when user is loaded successfully, load the data into the form
    }
});

});

