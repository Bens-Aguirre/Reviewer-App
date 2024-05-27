// Add Flashcard 
$(document).on("submit", "#addFlashFrm", function() {
  $.post("save_flash.php", $(this).serialize(), function(data) {
      if (data.res === "existQuestion") {
          Swal.fire(
              'Already Exist',
              data.question + ' Already Exist',
              'error'
          );
      } else if (data.res === "existAnswer") {
          Swal.fire(
              'Already Exist',
              data.answer + ' Already Exist',
              'error'
          );
      } else if (data.res === "success") {
          Swal.fire(
              'Success',
              data.question + ' Successfully Added',
              'success'
          );
          // $('#course_name').val("");
          refreshDiv();
          setTimeout(function() {
              $('#body').load(document.URL);
          }, 2000);
      } else if (data.res === "missingData") {
          Swal.fire(
              'Missing Data',
              'Please provide both question and answer',
              'error'
          );
      } else if (data.res === "failed") {
          Swal.fire(
              'Error',
              'Failed to add the flashcard',
              'error'
          );
      }
  }, 'json');
  return false;
});


// Delete Exam
$(document).on("click", "#deleteExam", function(e){
    e.preventDefault();
    var id = $(this).data("id");
     $.ajax({
      type : "post",
      url : "delete_exam.php",
      dataType : "json",  
      data : {id:id},
      cache : false,
      success : function(data){
        if(data.res == "success")
        {
          Swal.fire(
            'Success',
            'Selected Subject successfully deleted',
            'success'
          )
          refreshDiv();
        }
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }

    });
    
   

    return false;
  });



// Add Exam 
$(document).on("submit","#addExamFrm" , function(){
  $.post("save_exam.php", $(this).serialize() , function(data){
    if(data.res == "noSelectedSub")
   {
      Swal.fire(
          'No Subject',
          'Please select subject',
          'error'
       )
    }
    if(data.res == "noSelectedTime")
   {
      Swal.fire(
          'No Time Limit',
          'Please select time limit',
          'error'
       )
    }
    if(data.res == "noDisplayLimit")
   {
      Swal.fire(
          'No Display Limit',
          'Please input question display limit',
          'error'
       )
    }

     else if(data.res == "exist")
    {
      Swal.fire(
        'Already Exist',
        data.examTitle.toUpperCase() + '<br>Already Exist',
        'error'
      )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
        data.examTitle.toUpperCase() + '<br>Successfully Added',
        'success'
      )
          $('#addExamFrm')[0].reset();
          refreshDiv();
    }
  },'json')
  return false;
});

// Add Practice Test 
$(document).on("submit","#addPracFrm" , function(){
  $.post("save_pt.php", $(this).serialize() , function(data){
    if(data.res == "noSelectedSub")
   {
      Swal.fire(
          'No Subject',
          'Please select subject',
          'error'
       )
    }
    if(data.res == "noDisplayLimit")
   {
      Swal.fire(
          'No Display Limit',
          'Please input question display limit',
          'error'
       )
    }

     else if(data.res == "exist")
    {
      Swal.fire(
        'Already Exist',
        data.ptTitle.toUpperCase() + '<br>Already Exist',
        'error'
      )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
        data.ptTitle.toUpperCase() + '<br>Successfully Added',
        'success'
      )
          $('#addPracFrm')[0].reset();
          refreshDiv();
    }
  },'json')
  return false;
});

// Update Exam 
$(document).on("submit","#updateExamFrm" , function(){
  $.post("update_exam.php", $(this).serialize() , function(data){
    if(data.res == "success")
    {
      Swal.fire(
          'Update Successfully',
          data.msg + ' <br>are now successfully updated',
          'success'
       )
          refreshDiv();
    }
    else if(data.res == "failed")
    {
      Swal.fire(
        "Something's went wrong!",
         'Somethings went wrong',
        'error'
      )
    }
   
  },'json')
  return false;
});

// Update Practice Test
$(document).on("submit","#updatePtFrm" , function(){
  $.post("update_pt.php", $(this).serialize() , function(data){
    if(data.res == "success")
    {
      Swal.fire(
          'Update Successfully',
          data.msg + ' <br>are now successfully updated',
          'success'
       )
          refreshDiv();
    }
    else if(data.res == "failed")
    {
      Swal.fire(
        "Something's went wrong!",
         'Somethings went wrong',
        'error'
      )
    }
   
  },'json')
  return false;
});

// Update Flashcard
$(document).on("submit", "#updateFcFrm", function(event) {
  event.preventDefault(); // Prevent default form submission

  $.post("update_fc.php", $(this).serialize(), function(data) {
      if (data.res == "success") {
          Swal.fire({
              icon: 'success',
              title: 'Update Successfully',
              html: data.msg + ' <br>are now successfully updated',
          }).then(() => {
              location.reload(); // Reload the page after successful update
          });
      } else if (data.res == "failed") {
          Swal.fire({
              icon: 'error',
              title: 'Something went wrong!',
              text: data.msg, // Show error message from the response
          });
      }
  }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
      Swal.fire({
          icon: 'error',
          title: 'Something went wrong!',
          text: 'Request failed: ' + textStatus + ', ' + errorThrown,
      });
  });
});


$(document).on("click", ".deleteFlashcard", function(e) {
  e.preventDefault();
  var id = $(this).data("id");
  console.log("Deleting flashcard with ID:", id);

  $.ajax({
      type: "POST",
      url: "delete_fc.php",
      dataType: "json",
      data: { id: id },
      cache: false,
      success: function(data) {
          console.log("AJAX Success Response:", data);
          if (data.status === "success") {
              Swal.fire(
                  'Deleted!',
                  'Flashcard has been deleted.',
                  'success'
              ).then(() => {
                  location.reload();
              });
          } else {
              Swal.fire(
                  'Failed!',
                  data.message || 'Unknown error',
                  'error'
              );
          }
      },
      error: function(xhr, status, error) {
          console.log("AJAX Error: ", error);
      }
  });
});











// Update Question
$(document).on("submit","#updateQuestionFrm" , function(){
  $.post("update_question.php", $(this).serialize() , function(data){
     if(data.res == "success")
     {
        Swal.fire(
            'Success',
            'Selected question has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});

// Update PT Question
$(document).on("submit","#updatePtQuestionFrm" , function(){
  $.post("update_ptquestion.php", $(this).serialize() , function(data){
     if(data.res == "success")
     {
        Swal.fire(
            'Success',
            'Selected question has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});


// Delete Question
$(document).on("click", "#deleteQuestion", function(e){
    e.preventDefault();
    var id = $(this).data("id");
     $.ajax({
      type : "post",
      url : "delete_question.php",
      dataType : "json",  
      data : {id:id},
      cache : false,
      success : function(data){
        if(data.res == "success")
        {
          Swal.fire(
            'Deleted Success',
            'Selected question successfully deleted',
            'success'
          )
          refreshDiv();
        }
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }

    });
    
   

    return false;
  });

  // Delete PT Question
$(document).on("click", "#deletePtQuestion", function(e){
  e.preventDefault();
  var id = $(this).data("id");
   $.ajax({
    type : "post",
    url : "delete_ptquestion.php",
    dataType : "json",  
    data : {id:id},
    cache : false,
    success : function(data){
      if(data.res == "success")
      {
        Swal.fire(
          'Deleted Success',
          'Selected question successfully deleted',
          'success'
        )
        refreshDiv();
      }
    },
    error : function(xhr, ErrorStatus, error){
      console.log(status.error);
    }

  });
  
 

  return false;
});


// Add Question 
$(document).on("submit","#addQuestionFrm" , function(){
  $.post("add_question.php", $(this).serialize() , function(data){
    if(data.res == "exist")
    {
      Swal.fire(
          'Already Exist',
          data.msg + ' question <br>already exist in this exam',
          'error'
       )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
         data.msg + ' question <br>Successfully added',
        'success'
      )
        $('#addQuestionFrm')[0].reset();
        refreshDiv();
    }
   
  },'json')
  return false;
});

// Add PT Question 
$(document).on("submit","#addPtQuestionFrm" , function(){
  $.post("add_ptquestion.php", $(this).serialize() , function(data){
    if(data.res == "exist")
    {
      Swal.fire(
          'Already Exist',
          data.msg + ' question <br>already exist in this exam',
          'error'
       )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
         data.msg + ' question <br>Successfully added',
        'success'
      )
        $('#addPtQuestionFrm')[0].reset();
        refreshDiv();
    }
   
  },'json')
  return false;
});

// Add Examinee
$(document).on("submit","#addExamineeFrm" , function(){
  $.post("query/addExamineeExe.php", $(this).serialize() , function(data){
    if(data.res == "noGender")
    {
      Swal.fire(
          'No Gender',
          'Please select gender',
          'error'
       )
    }
    else if(data.res == "noCourse")
    {
      Swal.fire(
          'No Course',
          'Please select course',
          'error'
       )
    }
    else if(data.res == "noLevel")
    {
      Swal.fire(
          'No Year Level',
          'Please select year level',
          'error'
       )
    }
    else if(data.res == "fullnameExist")
    {
      Swal.fire(
          'Fullname Already Exist',
          data.msg + ' are already exist',
          'error'
       )
    }
    else if(data.res == "emailExist")
    {
      Swal.fire(
          'Email Already Exist',
          data.msg + ' are already exist',
          'error'
       )
    }
    else if(data.res == "success")
    {
      Swal.fire(
          'Success',
          data.msg + ' are now successfully added',
          'success'
       )
        refreshDiv();
        $('#addExamineeFrm')[0].reset();
    }
    else if(data.res == "failed")
    {
      Swal.fire(
          "Something's Went Wrong",
          '',
          'error'
       )
    }


    
  },'json')
  return false;
});



// Update Examinee
$(document).on("submit","#updateExamineeFrm" , function(){
  $.post("query/updateExamineeExe.php", $(this).serialize() , function(data){
     if(data.res == "success")
     {
        Swal.fire(
            'Success',
            data.exFullname + ' <br>has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});


function refreshDiv()
{
  $('#tableList').load(document.URL +  ' #tableList');
  $('#refreshData').load(document.URL +  ' #refreshData');

}


