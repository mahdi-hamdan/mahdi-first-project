


$('#deleteuser').on('click', function() {
  var idofuser= $('#idofuser').val();
  $.ajax({
  url:"delete.php",
  type:"POST",
  async: false,
  data :{
  "done":1,
  "idofuser":idofuser
  },
  success :function(data){
    display_from_database();

  }

});


});


$('#submit_add').click(function(){

var idofuser= $('#idofuser').val();
var email= $('#email').val();
var nameofuser= $('#nameofuser').val();
var phone= $('#phone').val();

var rr = new Array();

$("input:checked").each(function() {
          rr.push($(this).val());
       });

$.ajax({
url:"add.php",
type:"POST",
async: false,
data :{
"done":1,
"idofuser":idofuser,
"email":email,
"nameofuser":nameofuser,
"phone":phone,
"r":rr
},
success :function(data){
  display_from_database();
 $('#idofuser').val('');
  $('#email').val('');
  $('#nameofuser').val('');
  $('#phone').val('');
   $('#checkboxcourse').val('');
}

})
}
);
function display_from_database(){
  $.ajax({
  url:"viewdata.php",
  type:"POST",
  async: false,
  data :{

  },
  success :function(d){
  $("#show").html(d);
  }

});
}
  function deselect(e) {
  $('.pop').slideFadeToggle(function() {
    e.removeClass('selected');
  });
}
$(function() {
  $('#addstudent').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect($(this));
    } else {
      $(this).addClass('selected');
      $('.pop').slideFadeToggle();
    }
    return false;
  });

  $('.close').on('click', function() {
    deselect($('#addcourse'));
    return false;
  });
});



$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};
