// Legacy timekeeper interactions retained from the archived prototype.

// All form boxes are closed by default.  Comment line to toggle
$('.hidden').hide('slow');

$('body').click( function(event) 
{
   // Toggles form boxes
   if ($(event.target).is('h3')) 
   {
      $(event.target).next().slideToggle('slow'); 
   }

   // AJAX requests for Time-Punches
   if ($(event.target).is('button.clock')) 
   {
      var id = $(event.target).attr('id');
      var password = $('li#'+id+' #password').val();
      var form_data = 
      {
         user_id:    id,
         password:   password   
      };

      $.ajax(
      {
         url: "index.php/ntime/punch",
         type: 'POST',
         data: form_data,
         success: function(msg) 
         {
            // Repopulates user list item
            $('li#'+id).html(msg);
         }
      });
      // Stops form from submitting 
      return false;
   }
});
