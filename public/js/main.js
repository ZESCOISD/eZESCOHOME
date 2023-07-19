$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});


window.addEventListener("load", function () {
  var splashScreen = document.getElementById("splash-screen");
  var content = document.getElementById("content");
  var delayInMilliseconds = 3000; // 3 seconds

  setTimeout(function () {
    if (splashScreen) {
      splashScreen.style.display = "none";
      content.style.display = "block";
    }
  }, delayInMilliseconds);
});





$(function() {
  var print = function(msg) {
    alert(msg);
  };

  var setInvisible = function(elem) {
    elem.css('visibility', 'hidden');
  };
  var setVisible = function(elem) {
    elem.css('visibility', 'visible');
  };

  var elem = $("#elem");
  var items = elem.children();

  // Inserting Buttons
  elem.prepend('<div id="right-button" style="visibility: hidden;"><a href="#"><</a></div>');
  elem.append('  <div id="left-button"><a href="#">></a></div>');

  // Inserting Inner
  items.wrapAll('<div id="inner" />');

  // Inserting Outer

  elem.find('#inner').wrap('<div id="outer"/>');

  var outer = $('#outer');

  var updateUI = function() {
    var maxWidth = outer.outerWidth(true);
    var actualWidth = 0;
    $.each($('#inner >'), function(i, item) {
      actualWidth += $(item).outerWidth(true);
    });

    if (actualWidth <= maxWidth) {
      setVisible($('#left-button'));
    }
  };
  updateUI();



  $('#right-button').click(function() {
    var leftPos = outer.scrollLeft();
    outer.animate({
      scrollLeft: leftPos - 200
    }, 800, function() {

      if ($('#outer').scrollLeft() <= 0) {
        setInvisible($('#right-button'));
      }
    });
  });

  $('#left-button').click(function() {
    setVisible($('#right-button'));
    var leftPos = outer.scrollLeft();
    outer.animate({
      scrollLeft: leftPos + 200
    }, 800);
  });

  $(window).resize(function() {
    updateUI();
  });
});

/**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle').forEach((faqItem) => {
    faqItem.addEventListener('click', () => {
      faqItem.parentNode.classList.toggle('faq-active');
    });
  });

//    function viewPDF() {
//       var container = document.getElementById("pdfContainer");
//       container.style.display = "block";
//     }

//     function downloadPDF() {
//       var link = document.createElement("a");
//       link.href = "how-to.pdf";
//       link.download = "document.pdf";
//       link.click();
//     }


 function viewPDF() {
      var overlay = document.getElementById("pdfOverlay");
      var container = document.getElementById("pdfContainer");
      overlay.classList.add("show-overlay");
      container.style.display = "block";
      document.body.style.overflow = "hidden"; // Disable scrolling of the page
    }

    function closePDF() {
      var overlay = document.getElementById("pdfOverlay");
      var container = document.getElementById("pdfContainer");
      overlay.classList.remove("show-overlay");
      container.style.display = "none";
      document.body.style.overflow = ""; // Enable scrolling of the page
      // Go back to the previous page
    }

    // function downloadPDF() {
    //   var link = document.createElement("a");
    //   link.href = "{{assets('storage')}}/{{$products->user_manual}}";
    //   link.download = "document.pdf";
    //   link.click();
    // }


    const slider = document.querySelector('.items');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
      isDown = true;
      slider.classList.add('active');
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
      isDown = false;
      slider.classList.remove('active');
    });
    slider.addEventListener('mouseup', () => {
      isDown = false;
      slider.classList.remove('active');
    });
    slider.addEventListener('mousemove', (e) => {
      if(!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 1.5; //scroll-fast
      slider.scrollLeft = scrollLeft - walk;
      console.log(walk);
    });

    // Get the modal element
var modal = document.getElementById("modal");

// Get the button that opens the modal
var btn = document.getElementById("openModal");

// Get the close button element
var closeBtn = document.getElementsByClassName("close")[0];

// Function to open the modal
function openModal() {
  modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
  modal.style.display = "none";
}

// Event listeners
btn.addEventListener("click", openModal);
closeBtn.addEventListener("click", closeModal);
