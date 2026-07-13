<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
$(function(){
  // Submenu toggle
  $('.adm-nav .has-sub>a').on('click', function(e){
    e.preventDefault();
    var li = $(this).parent();
    li.toggleClass('open');
    li.find('.adm-submenu').toggleClass('open');
  });

  // Set active link
  var cur = window.location.pathname.split('/').pop();
  $('.adm-nav a[href="'+cur+'"]').addClass('active')
    .closest('li.has-sub').addClass('open')
    .find('.adm-submenu').addClass('open');

  // Mobile sidebar toggle
  $('#admToggle').on('click', function(){
    $('#admSidebar').toggleClass('open');
    $('#admOverlay').toggleClass('active');
  });

  // Close sidebar when overlay clicked
  $('#admOverlay').on('click', function(){
    $('#admSidebar').removeClass('open');
    $('#admOverlay').removeClass('active');
  });

  // Close sidebar when a nav link is clicked on mobile
  $('.adm-nav a:not(.has-sub>a), .adm-submenu a').on('click', function(){
    if($(window).width() <= 768){
      $('#admSidebar').removeClass('open');
      $('#admOverlay').removeClass('active');
    }
  });
});
</script>
