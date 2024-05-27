
$(document).on("click","#startPtQuiz", function(){
    var thisId = $(this).data('id');
    Swal.fire({
    title: 'Are you sure?',
    text: 'You want to take this practice test now',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, start now!'
}).then((result) => {
if (result.value) {
       $.ajax({
        type : "post",
        url : "selPtAttemptExe.php",
        dataType : "json",  
        data : {thisId:thisId},
        cache : false,
        success : function(data){
          if(data.res == "alreadyExam")
          {
            Swal.fire(
              'Already Taken ',
              'you already take this exam',
              'error'
            )
          }
          else if(data.res == "takeNow")
          {
            window.location.href="home.php?page=pt&id="+thisId;
            return false;
          }
        },
        error : function(xhr, ErrorStatus, error){
          console.log(status.error);
        }

      });




}
});
  return false;
})



// Reset Exam Form
$(document).on("click","#resetPtFrm", function(){
    $('#submitPtAnswerFrm')[0].reset();
    return false;
});
