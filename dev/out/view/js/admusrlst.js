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
    var limitu = 25
    var offsetu = 0;

    jQuery(function ($) {
      displayUsrLst(limitu, offsetu);
      $('#loader_usrlst').click(function ( ) {
          offsetu = limitu + offsetu;
          displayUsrLst(limitu, offsetu);
      });
    });

function displayUsrLst(lim, off)
{
    $.ajax({
        type: "GET",
        async: false,
        url: "at/getusrlst",
        data: "limit=" + lim + "&offset=" + off,
        cache: false,
        dataType: "JSON",
        beforeSend: function () {
            $("#loader_usrlst").html("").hide();
        },
        success: function (data) {
            var items = [];

            $.each(data, function ( key, val ) {
                items.push(qtuboxsmall(key, val));
            });

                $("#results_usrlst").append(items);

/*
alert(JSON.stringify(items));
*/

            if (data == "") {
                $("#loader_usrlst").html('<div class="cnt"><hr></div>').show()
            } else {
                $("#loader_usrlst").html('<div class="cnt"><button class="btn" type="button">Load More..</button></div><br>').show();
            }

        }
        });
};


    function qtuboxsmall(key, val)
    {
        var s = '';

        s += '<div class="usradmcardsmall">';
/*
        s += '<img class="zal" src="'+val.avatar+'" alt="avatar" height="60" width="60" />';
*/
        s += '<div class="lupa">';
/*
        s += '<a href="../at/'+val.at+'">@'+val.at+'</a>';
*/
        s += '<a href="at/'+val.id+'">' + val.id + '</a> | ' + val.ago + ' | ' + val.email + ' | <a href="./'+val.at+'">@' + val.at + '</a>';
        s += '<br />';

        s += '</div>';
        s += '</div>';

        return s + '\n';
    }
