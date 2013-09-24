/* 
Copyright (c) 2011, Francois-Xavier Aeberhard All rights reserved.
Code licensed under the BSD License:
http://redcms.red-agent.com/license.html
*/

YUI.add('redagent', function(Y) {
	

	var RedAgentHistory,
		LoginAction,
		DeleteAction,
		NewWindowHrefAction,
		HrefAction,
		AsyncRequestAction,
		CONTENT_BOX = 'contentBox',
		BOUNDING_BOX = 'boundingBox',
		BODY = 'body',
		
		CLICK = 'click';

		RedAgentHistory = Y.Base.create("redcms-redagent-history", Y.Widget, [Y.RedCMS.RedCMSWidget], {

		_handlers : [],
		
		_showPage : function(targetHref) {
			this.get(BOUNDING_BOX).get('parentNode').removeClass("redcms-bd-hidden");
			this.get(CONTENT_BOX).addClass('redcms-bd-content-loading');
			Y.io(targetHref, {											//Then request its content to the server
				data : {'redreload':true},
				on : {
					success: function(id, o, args) {
						var bb = this.get(BOUNDING_BOX),
							cb = this.get(CONTENT_BOX),
							newNode = Y.Node.create( o.responseText );
						
						cb.setContent('');
						var target = bb.get('parentNode');
						this.destroy();
						target.prepend(newNode);

						Y.RedCMS.RedCMSManager.render(newNode);
					}
				}, context :this
			});
		},
		
		renderUI : function() {
			var cb = this.get(CONTENT_BOX);
			if (RedAgentHistory._swf == null) {
				RedAgentHistory._swf = new Y.SWF("#swfContainer","/src/redagent/as/RedAgentClient.swf",
				{
					//version: "9.0.115",
					fixedAttributes: {
						allowScriptAccess:"always", 
						allowNetworking:"all",
						allowFullScreen:"true",
					/*	align, base, menu, name, quality, salign, scale, tabindex,*/
						bgcolor:"transparent",
						wmode:"transparent"
					},
					flashVars: {
						//foo: "bar", foo1: "bar1"
					}
				});
			}
			this._swf.on('wrongflashversion', function(){
				console.log('wrongflashversion', arguments, this);
			
			});

			this._swf.on('swfReady', function() {
				console.log('swfReady', arguments, this);
			});
			this._handlers.push( RedAgentHistory._swf.on('showPage', function(e) {
				this._showPage(Y.RedCMS.RedCMSManager.getLink(e.text));
			}, this));
			
			this._handlers.push( Y.on("click", function(e) {
				this._showPage(e.target.get('href'));
				e.preventDefault();
			}, ".redcms-left .yui3-redcmsnavmenu a", this));
			Y.log("wew",cb.one(".redcms-bd-closebutton"));
			//this.handlers.push( 
			cb.one(".redcms-bd-closebutton").on('click', function() {
			//	alert("click");
				this.get(BOUNDING_BOX).get('parentNode').addClass("redcms-bd-hidden");
				this.get(CONTENT_BOX).setContent("");
				//this.get(CONTENT_BOX).addClass('parentNode')
			}, this);
			//);
		},
		destructor : function() {
			for (var i=0;i<this._handlers.length;i++) {
				this._handlers[i].detach();
			}
		}
	}, { 
		_swf:null
	});
	
	Y.namespace('RedCMS').RedAgentHistory = RedAgentHistory;
	
	
}, '0.1.1');