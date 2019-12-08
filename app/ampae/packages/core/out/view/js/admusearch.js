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
    var limit = 5
    var offset = 0;

function displayUsers(q, lim, off)
{
    $.ajax({
        type: "GET",
        async: false,
        url: "./process",
        data: "q=" + q + "&limit=" + lim + "&offset=" + off,
        cache: false,
        dataType: "JSON",
        beforeSend: function () {
            $("#loader_message").html("").hide();
        },
        success: function (data) {

            var items = [];

            $.each(data, function ( key, val ) {
                items.push(qtubox(key, val));
            });

                $("#results").append(items);

/*
alert(JSON.stringify(items));
*/

            if (data == "") {
                $("#loader_message").html('<div class="cnt"><hr></div>').show()
            } else {
                $("#loader_message").html('<div class="cnt"><button class="btn btn-theme btn-lg btn-block" type="button">Load More..</button></div><br>').show();
            }

        }
        });
};

jQuery(function ($) {

        //displayUsers('', limit, offset);
        $('input#srch-term').keyup(function () {

            var qx = $(this);
            var qv = qx.val();
            var ql = qx.val().length;
            offset = 0;

            $("#results").html("");

            if (ql > 2 && ql < 32) {
                displayUsers(qv, limit, offset);
                $("#qrq").text(qv);
            }

        });

        $('#loader_message').click(function () {

            offset = limit + offset;
            displayUsers($("#qrq").text(), limit, offset);

        });

    });

    function qtubox(key, val)
    {
        var s = '';

        s += '<div class="usradmcard">';
        s += '<img class="zal" src="'+val.avatar+'" alt="avatar" height="60" width="60" />';
        s += '<div class="lupa">';

        s += '<a href="../'+val.at+'">@'+val.at+'</a><br />';
        s += '<a href="../at/'+val.id+'">'+val.id+'</a><br />';

        s += '<span>'+val.email+'</span><br />';
        s += '<span>'+val.ago+'</span><br />';
        //s += '<p>lorem ipsum</p>';
        s += '</div>';
        s += '</div>';

        return s + '\n';
    }
