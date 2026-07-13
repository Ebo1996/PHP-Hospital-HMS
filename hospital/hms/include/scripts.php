<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script>
$(function(){
  // Set active nav link
  var cur = window.location.pathname.split('/').pop();
  $('.hms-nav a[href="'+cur+'"]').addClass('active');

  // Mobile sidebar toggle - Enhanced
  $('#hmsToggle').on('click', function(e){
    e.stopPropagation();
    $('#hmsSidebar').toggleClass('open');
    $('#hmsOverlay').toggleClass('active');
    $('body').toggleClass('sidebar-open');
  });
  
  // Close sidebar when clicking overlay
  $('#hmsOverlay').on('click', function(){
    $('#hmsSidebar').removeClass('open');
    $('#hmsOverlay').removeClass('active');
    $('body').removeClass('sidebar-open');
  });
  
  // Close on nav link click (mobile)
  $('.hms-nav a, .sidebar-footer a').on('click', function(){
    if($(window).width() <= 768){
      $('#hmsSidebar').removeClass('open');
      $('#hmsOverlay').removeClass('active');
      $('body').removeClass('sidebar-open');
    }
  });
  
  // Close sidebar on window resize to desktop
  $(window).on('resize', function(){
    if($(window).width() > 768){
      $('#hmsSidebar').removeClass('open');
      $('#hmsOverlay').removeClass('active');
      $('body').removeClass('sidebar-open');
    }
  });
  
  // Prevent body scroll when sidebar is open on mobile
  var style = $('<style>@media(max-width:768px){body.sidebar-open{overflow:hidden;}}</style>');
  $('head').append(style);
  
  // Smooth scroll for anchor links
  $('a[href^="#"]').on('click', function(e){
    var target = $(this.getAttribute('href'));
    if(target.length){
      e.preventDefault();
      $('html, body').animate({
        scrollTop: target.offset().top - 80
      }, 500);
    }
  });
  
  // Auto-hide alerts after 5 seconds
  $('.hms-alert').each(function(){
    var alert = $(this);
    setTimeout(function(){
      alert.fadeOut(400, function(){
        $(this).remove();
      });
    }, 5000);
  });
  
  // Add close button to alerts
  $('.hms-alert').prepend('<i class="fa fa-times" style="cursor:pointer;margin-left:auto;opacity:0.7;" onclick="$(this).parent().fadeOut(300, function(){$(this).remove();})"></i>');
  
  // Form input animations
  $('.hms-input, .cf-input').on('focus', function(){
    $(this).parent().addClass('focused');
  }).on('blur', function(){
    if(!$(this).val()){
      $(this).parent().removeClass('focused');
    }
  });
  
  // Table row hover effect
  $('.hms-table tbody tr').on('mouseenter', function(){
    $(this).css('transform', 'scale(1.005)');
  }).on('mouseleave', function(){
    $(this).css('transform', 'scale(1)');
  });
  
  // Initialize tooltips if Bootstrap tooltips are available
  if(typeof $().tooltip === 'function'){
    $('[data-toggle="tooltip"]').tooltip();
  }
  
  // Datepicker configuration for mobile
  if(typeof $.fn.datepicker === 'function'){
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      orientation: 'auto'
    });
  }
  
  // Timepicker configuration
  if(typeof $.fn.timepicker === 'function'){
    $('.timepicker').timepicker({
      showMeridian: true,
      defaultTime: false
    });
  }
  
  // Print functionality
  window.printPage = function(){
    window.print();
  };
  
  // Confirm before delete
  window.confirmDelete = function(message){
    return confirm(message || 'Are you sure you want to delete this item?');
  };
});
</script>
