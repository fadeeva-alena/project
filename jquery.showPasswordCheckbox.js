/*
 *	@author	Davin Granroth, http://blog.davingranroth.com/
 *	@date 	Feb 12, 2010
 *	@requires	jquery.js
 *
 *	jquery.showPasswordCheckbox.js plugin
 *	http://www.alistapart.com/articles/the-problem-with-passwords/
 *	This is a jQuery implementation based on example 1 from this article.
 *	This script adds a "Show password" checkbox after password fields, and 
 *	when toggled, it shows the password in plain text.
 *
 *	Fields must have a name attribute and be of type="password".
 *	
 *	@example $("input#password").showPasswordCheckbox();
 *	@example $("input[type=password]").showPasswordCheckbox();
 *
 *
 */
jQuery.fn.showPasswordCheckbox = function() {
	return this.each(function () {
		if((jQuery(this).attr("type") == "password") && (jQuery(this).attr("name") != "undefined")){			
			// Get the name field from "this"
			var altPasswordFieldName = "alt"+jQuery(this).attr("name");
			var showPasswordFieldName = "show"+jQuery(this).attr("name");
			
			// Markup for text password field
			var textPasswordMarkup = "<input type=\"text\" id=\""+altPasswordFieldName+"\" name=\""+altPasswordFieldName+"\" />";
			// Markup for showPassword checkbox
			var showPasswordMarkup = "<input type=\"checkbox\" id=\""+showPasswordFieldName+"\" tabindex=\"17\" /><label for=\""+showPasswordFieldName+"\">&nbsp;Passwort anzeigen</label>";
		
			// Insert the text password field and showPassword field and label
			jQuery(this).after(textPasswordMarkup+showPasswordMarkup);
			
					
			// Clone attributes from this to #altPassword. Do not include "id" and "type".
			// Otherwise, the altPassword field may not behave or look like the password field.
			var attributes = new Array("align","disabled","maxlength","readonly","size","class","dir","lang","style","value","title","xml:lang","onblur","onchange","onclick","ondblclick","onfocus","onmousedown","onmousemove","onmouseout","onmouseover","onmouseup","onkeydown","onkeypress","onkeyup","onselect");
			for(attribute in attributes){
				if(jQuery(this).attr(attributes[attribute]) != "undefined"){
					jQuery("#"+altPasswordFieldName).attr(
						attributes[attribute], 
						jQuery(this).attr(attributes[attribute])
					);
				}
			}
			
			// Initially obscure the text field, until toggled on.
			// This must come after the attributes or an existing style attribute may override the hide.
			jQuery("#"+altPasswordFieldName).hide();

			
			// Toggle the password and altPassword fields' visibility and values as needed
			var shufflePasswordFields = function(jqPassword) {
				jQuery("#"+showPasswordFieldName).click(function(){
					if(jqPassword.is(':visible')){
						// hide password field and show text password field with correct value
						jqPassword.hide();
						jQuery("#"+altPasswordFieldName).val(jqPassword.val()).show();
					}else{
						// hide altPassword field and show password field
						jQuery("#"+altPasswordFieldName).hide();
						jqPassword.show();
					}			
				});
				
				// Keep password value in sync with altPassword value
				jQuery("#"+altPasswordFieldName).change(function(){
					jqPassword.val(jQuery("#"+altPasswordFieldName).val());
				});
				
				return jqPassword;
			}
			
			return shufflePasswordFields(jQuery(this));
		}else{
			// Just return without change if the type is not "password"
			return this;
		}
	});
};
