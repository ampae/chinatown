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

function displayRecords(lim, off)
{
    $.ajax({
        type: "GET",
        async: false,
        url: "./activity/raw",
        data: "limit=" + lim + "&offset=" + off,
        cache: false,
        dataType: "JSON",
        beforeSend: function () {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
        },
        success: function (data) {
            $('#loader_image').hide();
            var items = [];

            $.each(data, function ( key, val ) {
                items.push(qtbobox(key, val));
            });

                $("#results").append(items);

            if (data == "") {
                $("#loader_message").html('<div class="cnt"><hr></div>').show()
            } else {
                $("#loader_message").html('<div class="cnt"><button class="btn btn-theme btn-lg btn-block" type="button">Load More..</button></div><br />').show();
            }

        }
        });
}

      jQuery(function ($) {

        displayRecords(limit, offset);

        $('#loader_message').click(function () {


            var d = $('#loader_message').find("button").attr("data-atr");
            if (d != "nodata") {
                offset = limit + offset;
                displayRecords(limit, offset);
            }
        });

      });

        function qtbobox(key, val)
        {

            var s = '';

                s += '<div id="profile-widget" class="panel">';

                s += '<div class="panel-body">';
                s += '<div class="media">';

                s += '<div class="media-body">';
                s += '<p><a href="at/' + val.uid + '">' + val.name + '</a> &raquo; ' + val.value + ' &bull; ' + val.htime + '</p>';
                s += '</div>';
                s += '</div>';
                s += '</div>';

                s += '</div>';


            return s + '\n';
        }
