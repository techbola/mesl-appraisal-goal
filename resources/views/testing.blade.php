@extends('layouts.master')

@section('content')


<style>
.section-1 {
background-color: #eee;
}
.section-2 {
background-color: #555;
min-height:450px;
}

.section-3 {
background-color: #333;
min-height:450px;"
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<div class="section-1">
  <iframe name="reviewCarousel" id="reviewCarousel" style="border: 0px; width:100%" src="//app.ratesight.com/Iframe-Carousel.aspx?ID=2122&min=4"></iframe>
</div>

<div class="section-2">
  <h1> New Section </h1>
  <p>New section content</p>
</div>

  <div class="section-3">
  <h1> New Section </h1>
  <p>New section content</p>
</div>



  <script src="//app.ratesight.com/Scripts/iframeResizer.min.js" type="text/javascript"></script>

  <script>
    window.onload = function(){

      iFrameResize({
    autoResize: true,
    scrolling: false,
    checkOrigin: false,

 heightCalculationMethod : 'min'
//  heightCalculationMethod : 'bodyScroll'

}, '#reviewCarousel');

/*var iframe = document.getElementById('reviewCarousel'),
    lastheight;

setInterval(function(){
    if (iframe.document.body.scrollheight != lastheight) {
        // adjust the iframe's size

        lastheight = iframe.document.body.scrollheight;
    }
}, 200);
*/
    };
  </script>

    <script>
// $('#reviewCarousel').on('beforeChange', function(event, slick, currentSlide){
//       console.log(currentSlide);
//     });
  setInterval(function(){
    var c_height = $('.slick-current.slick-active').height();
    var i_height = $('iframe').height();
     console.log(c_height);
    console.log(i_height);
    //$('iframe').css({height: 50});
    //$('.slick-slide').on('show', function(){ this.hide(); });
  }, 5000);
     </script>


@endsection
