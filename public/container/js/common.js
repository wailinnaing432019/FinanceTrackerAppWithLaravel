$(document).ready(function () {
  $('.menu-toggle').on('click', function () {
    $(this).toggleClass('active');
      $('.gnav').toggleClass('is-show');
  });

  $('#tabs-nav li:first-child').addClass('active');
      $('.tab-content').hide();
      $('.tab-content:first').show();

      $('#tabs-nav li').click(function(){
        $('#tabs-nav li').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').hide();
        $($(this).find('a').attr('href')).fadeIn();
      });

  $('#inc-btn').on('click', function () {
    $(this).addClass('active');
      $('#exp-btn').removeClass('active');
      $update = document.getElementById('update');
      if ($update) {
          document.getElementById('update').innerText = "Update Income";
      }
    //   $('form button[type="submit"]').text('Save Income');
      document.getElementById('save').innerText = "Save Income";

    //   document.getElementById('g').innerText = "Update Income";


      document.getElementById('save').disabled = false;
      document.getElementById("data").value = "0";
      document.getElementById("amount").placeholder = "Enter Income amount..";
      document.getElementById("note").placeholder = "Please enter note for your income..";
      document.querySelector('label[for="amount"]').innerText = "Income Information";

      // enable to all inputs

      var form = document.getElementById('form-data');
            var inputs = form.getElementsByTagName('input');

            // Loop through all input elements and enable them
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
  });

  $('#exp-btn').on('click', function () {
    $(this).addClass('active');
      $('#inc-btn').removeClass('active');
      $update = document.getElementById('update');
      if ($update) {
          document.getElementById('update').innerText = "Update Expense";
      }
    //   $('form button[type="submit"]').text('Save Expense');
      document.getElementById('save').innerText = "Save Expense";


      document.getElementById('save').disabled = false;
      document.getElementById("data").value = "1";
      document.getElementById("amount").placeholder = "Enter Expense amount..";
      document.getElementById("note").placeholder = "Please enter note for your expense..";
      document.querySelector('label[for="amount"]').innerText = "Experse Information";

            // enable to all inputs

      var form = document.getElementById('form-data');
            var inputs = form.getElementsByTagName('input');

            // Loop through all input elements and enable them
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
  });
});
