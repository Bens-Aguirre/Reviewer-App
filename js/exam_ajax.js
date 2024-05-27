// Submit Answer
$(document).on('submit', '#submitAnswerFrm', function(e) {
  e.preventDefault(); // Prevent the default form submission

  var examAction = $('#examAction').val();

  if (examAction != "") {
      Swal.fire({
          title: 'Time Out',
          text: "Your time is over, please click OK",
          icon: 'warning',
          showCancelButton: false,
          allowOutsideClick: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK!'
      }).then((result) => {
          if (result.value) {
              $.post("submitAnswerExe.php", $(this).serialize(), function(data) {
                  handleResponse(data);
              }, 'json');
          }
      });
  } else {
      Swal.fire({
          title: 'Are you sure?',
          text: "You want to submit your answer now?",
          icon: 'warning',
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, submit now!'
      }).then((result) => {
          if (result.value) {
              $.post("submitAnswerExe.php", $(this).serialize(), function(data) {
                  handleResponse(data);
              }, 'json');
          }
      });
  }

  return false;
});

function handleResponse(data) {
  if (data.res == "alreadyTaken") {
      Swal.fire('Already Taken', "You already took this exam", 'error');
  } else if (data.res == "success") {
      Swal.fire({
          title: 'Success',
          text: "Your answer was successfully submitted!",
          icon: 'success',
          allowOutsideClick: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK!'
      }).then((result) => {
          if (result.value) {
              $('#submitAnswerFrm')[0].reset();
              var ex_id = $('#ex_id').val();
              window.location.href = 'home.php?page=result&id=' + ex_id;
          }
      });
  } else if (data.res == "failed") {
      Swal.fire('Error', "Something went wrong", 'error');
  }
}

$(document).ready(function() {
  // Submit Pt Answer
  $(document).on('submit', '#submitPtAnswerFrm', function(e) {
      Swal.fire({
          title: 'Are you sure?',
          text: "You want to submit your answer now?",
          icon: 'warning',
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, submit now!'
      }).then((result) => {
          if (result.value) {
              $.post("submitPtAnswerExe.php", $(this).serialize(), function(data) {
                  handleResponse(data);
              }, 'json');
          }
      });
      
      // Return false to prevent default form submission
      return false;
  });

  function handleResponse(data) {
      if (data.res == "alreadyTaken") {
          Swal.fire('Already Taken', "You already took this exam", 'error');
      } else if (data.res == "success") {
          Swal.fire({
              title: 'Success',
              text: "Your answer was successfully submitted!",
              icon: 'success',
              allowOutsideClick: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK!'
          }).then((result) => {
              if (result.value) {
                  $('#submitPtAnswerFrm')[0].reset();
                  var prac_id = $('#prac_id').val();
                  window.location.href = 'home.php?page=ptresult&id=' + prac_id;
              }
          });
      } else if (data.res == "failed") {
          Swal.fire('Error', "Something went wrong", 'error');
      }
  }
});




  
  // Submit Feedbacks
  $(document).on("submit","#addFeebacks", function(){
     $.post("query/submitFeedbacksExe.php", $(this).serialize(), function(data){
        if(data.res == "limit")
        {
          Swal.fire(
            'Error',
            'You reached the 3 limit maximum for feedbacks',
            'error'
          )
        }
        else if(data.res == "success")
        {
          Swal.fire(
            'Success',
            'your feedbacks has been submitted successfully',
            'success'
          )
            $('#addFeebacks')[0].reset();
          
        }
     },'json');
  
     return false;
  });