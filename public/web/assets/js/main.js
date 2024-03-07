(function ($) {

   "use strict";


   $(window).on("load", function () {
      $('.preloader').fadeOut(1000);
   });

   $(".slider").pgwSlider({

      autoSlide: false
   });

   $(".slider-2").pgwSlideshow();


   $(".video-carousel").owlCarousel({
      loop: false,
      margin: 30,
   //    autoplay:true,
   //  autoplayTimeout:2500,
      nav: true,
      navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
      responsive: {

         0: {

            items: 1
         },

         480: {

            items: 2
         },

         768: {

            items: 3
         },
         992: {
            items: 4
         }
      }
   });

   $(".banner-slide-carousel").owlCarousel({
      loop: true,
      margin: 30,
      autoplay:true,
      autoplayTimeout:10000,
      nav: true,
      navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
      responsive: {

         0: {

            items: 1
         },

         480: {

            items: 1
         },

         768: {

            items: 1
         },
         992: {
            items: 1
         }
      }
   });
   $(".home-trending-video-carousel").owlCarousel({
      loop: true,
      margin: 30,
      autoplay:true,
      autoplayTimeout:10000,
      nav: false,
      //navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
      responsive: {

         0: {

            items: 1
         },

         480: {

            items: 1
         },

         768: {

            items: 2
         },
         992: {
            items: 2
         }
      }
   });

   $(".feature-carousel").owlCarousel({
      loop: true,
      margin: 15,
      nav: false,
      items: 1,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true

   });


   // Youtube Video Bg

   var bgvideo = $(".bgvideo");

   if (bgvideo.length > 0) {

      bgvideo.YTPlayer({

         videoURL: 'https://www.youtube.com/watch?v=RoKeSWzZAwA',
         containment: '.video-area',
         quality: 'large',
         autoPlay: true,
         mute: true,
         opacity: 1

      });
   }




   // Scroll Top

   function scrolltop() {
      var wind = $(window);
      wind.on("scroll", function () {
         var scrollTop = $(window).scrollTop();
         if (scrollTop >= 500) {
            $(".scroll-top").fadeIn("slow");
         } else {
            $(".scroll-top").fadeOut("slow");
         }

      });

      $(".scroll-top").on("click", function () {
         var bodyTop = $("html, body");
         bodyTop.animate({
            scrollTop: 0
         }, 800, "easeOutCubic");
      });

   }
   scrolltop();




   $('.lazy').Lazy({
      placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7..."
   });

   	/*  Footer full year */
  $('#spanYear').html(new Date().getFullYear());



})(jQuery);


// change password

function password_show_hide() {
   var x = document.getElementById("password");
   var show_eye = document.getElementById("show_eye");
   var hide_eye = document.getElementById("hide_eye");
   hide_eye.classList.remove("d-none");
   if (x.type === "password") {
   x.type = "text";
   show_eye.style.display = "none";
   hide_eye.style.display = "block";
   } else {
   x.type = "password";
   show_eye.style.display = "block";
   hide_eye.style.display = "none";
   }
}


function password_show_hidenew() {
   var x = document.getElementById("newpassword");
   var show_eye = document.getElementById("show_eyenew");
   var hide_eye = document.getElementById("hide_eyenew");
   hide_eye.classList.remove("d-none");
   if (x.type === "password") {
   x.type = "text";
   show_eye.style.display = "none";
   hide_eye.style.display = "block";
   } else {
   x.type = "password";
   show_eye.style.display = "block";
   hide_eye.style.display = "none";
   }
}


// otp screen

document.querySelectorAll(".otp-input").forEach((element, index, array) => {
   element.addEventListener("input", function (event) {
       let inputValue = event.target.value;
       inputValue = inputValue.replace(/[^0-9]/g, "");
       inputValue = inputValue.slice(0, 1);
       event.target.value = inputValue;

       if (inputValue !== "") {
           // Move focus to the next input field
           if (index < array.length - 1) {
               array[index + 1].focus();
           }
       } else {
           // Move focus to the previous input field
           if (index > 0) {
               array[index - 1].focus();
           }
       }
   });

   // Add a blur event listener to handle cases where the user clicks or tabs away
   element.addEventListener("blur", function () {
       // If the input is empty, move focus to the previous input field
       if (element.value === "" && index > 0) {
           array[index - 1].focus();
       }
   });
});



