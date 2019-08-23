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
document.addEventListener("DOMContentLoaded", function(e) {
  chkScr();
});

window.onresize = function(event) {
  chkScr();
  location.reload();
}

function chkScr(){
  if (window.innerWidth > 640) {
    document.getElementById("chkMenu").checked = true;
    menuOpen();
  } else {
    document.getElementById("chkMenu").checked = false;
    menuClose();
  }
}

function ShowHideAsideLeft(chkMenu) {
   if(chkMenu.checked) {
     menuOpen();
   } else {
     menuClose();
   }
};
function menuOpen(){
  document.getElementById("asideLeft").style.width = "200px";
  //document.getElementById("main").style.paddingLeft = "200px";
  document.getElementById("fufu").innerHTML = '&times;';
}
function menuClose(){
  document.getElementById("asideLeft").style.width = "0";
  //document.getElementById("main").style.paddingLeft = "0";
  document.getElementById("fufu").innerHTML = '&#9776;';
}

function toggle_visibility(id) {
  var e = document.getElementById(id);
  e.style.display = ((e.style.display!='none') ? 'none' : 'block');
}

    jQuery(function($) {
        $('.alert > button').on('click', function(){
            $(this).closest('div.alert').fadeOut('slow');
        })

        $("#leftside-navigation .sub-menu > a").click(function(e) {
        $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
        e.stopPropagation()
        })
    });
