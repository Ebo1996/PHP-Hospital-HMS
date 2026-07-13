<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
$(function(){
  // Set active nav link
  var cur = window.location.pathname.split('/').pop();
  $('.doc-nav a[href="'+cur+'"]').addClass('active');

  // Mobile sidebar toggle
  $('#docToggle').on('click', function(){
    $('#docSidebar').toggleClass('open');
    $('#docOverlay').toggleClass('active');
  });
  $('#docOverlay').on('click', function(){
    $('#docSidebar').removeClass('open');
    $('#docOverlay').removeClass('active');
  });
  $('.doc-nav a').on('click', function(){
    if($(window).width() <= 768){
      $('#docSidebar').removeClass('open');
      $('#docOverlay').removeClass('active');
    }
  });
});
</script>
