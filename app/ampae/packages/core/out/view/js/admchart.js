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

jQuery(function ($) {

    $.getJSON(tmpChinaTownWebPath + "at/chart", function (json) {
        var plotarea = $("#usr_chart");
        var dataLine=json.dataLine;
        $.plot(plotarea , [{data: dataLine, color: "#024355", points: { show: true }, lines: { show: true, steps: false }}], {xaxis: { mode: "time", timeformat: "%d %b", tickSize: [1, "day"] }, yaxis: { minTickSize: 1, tickDecimals: 0  }, legend:{position:"nw"} });
    });
});
