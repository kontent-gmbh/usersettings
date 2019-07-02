$(document).ready(function() {
  function saveSettings() {
    OC.msg.startSaving('#usersettings_msg');
    $.ajax({
      url: OC.generateUrl('/apps/usersettings/settings'),
      type: 'POST',
      data: $('#usersettings_form').serialize(),
      success: function(data){
        OC.msg.finishedSaving('#usersettings_msg', data);
      },
      error: function(data){
        OC.msg.finishedError('#usersettings_msg', data.responseJSON.message);
      }
    });
  }

  $('#usersettings_form').change(saveSettings);
  $('#usersettings').keypress(function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
    }
  });
});
