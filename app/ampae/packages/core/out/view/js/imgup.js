/*
 * <codeheader>
 * <name>ChinaTown</name>
 * <version>5.1.1</version>
 * <description>User Registration and Management LAMP SaaS FrameWork. Secure, Fast, Small and Light.</description>
 * <base>https://ampae.com/chinatown/</base>
 * <author>V Bugroff</author>
 * <author>M Karodine</author>
 * <email>bugroff@protonmail.com</email>
 * <email>usr04@protonmail.com</email>
 * <copyright file="LICENSE.txt" company="AMPAE">
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR
 * A PARTICULAR PURPOSE.
 * </copyright>
 * <date>2019-01-01</date>
 * <summary>
 * Script File
 * </summary>
 * </codeheader>
*/
jQuery(function($) {
    $('#photoimg').change(function(){
        if(this.files[0].size < 4194304) {
            if (this.files[0].name.match(/\.jpg$/) == null && this.files[0].name.match(/\.png$/) == null && this.files[0].name.match(/\.JPG$/) == null && this.files[0].name.match(/\.jpeg$/) == null) {
                alert('Not supported');
            } else {
                $("#co-post-img").html( $("input[name*='iid']").val() );
                $("#preview").html('');$("#preview").html('<img src="assets/img/loader.gif" alt="Uploading..."/>');
                $("#imageform").ajaxForm({target: '#preview'}).submit();
            }
        } else {
            alert('Too Big');
        }
    });
});
function getFfile(){
    document.getElementById("photoimg").click();
}
