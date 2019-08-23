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

    $('#contact-form').validate({
        rules: {
          name: {
            minlength: 4,
            required: true
          },
          email: {
            required: true,
            email: true
          },
          subject: {
              minlength: 2,
            required: true
          },
          message: {
            minlength: 5,
            required: true
          }
        }
      });

    $('#account').validate({
        rules: {
          name: {
            required: true,
            rangelength: [4, 64]
          },
          email: {
            required: true,
            email: true
          }
        }
      });

    $('#sup-form').validate({
        rules: {
          uname: {
            required: true,
            rangelength: [4, 64]
          },
          email: {
            required: true,
            email: true
          }
        }
      });

      $('#sin-form').validate({
          rules: {
            email: {
              required: true,
              email: true
            },
            pword: {
            required: true,
                rangelength: [3, 32]
            },
          }
        });

    $('#req-form').validate({
        rules: {
          email: {
            required: true,
            email: true
          }
        }
      });

    $("#settings-form").validate({

    rules: {
        pword2: {
        required: true,
            rangelength: [5, 32]
        },
        pword3: {
        required: true,
            rangelength: [5, 32],
        equalTo: "#pword2"
        }
    }
      });

});
