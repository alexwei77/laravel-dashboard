$( document ).ready(function() {
         $("#choose-country2").hide();
         $(".hide-home").hide();
         $('.navbar').affix();

         $('.navbar').on('affix.bs.affix', function () {
             $("#choose-country2").show();
               $(".hide-home").show();
          });

          $('.navbar').on('affix-top.bs.affix', function () {
             $("#choose-country2").hide();
             $(".hide-home").hide();
          });

        });