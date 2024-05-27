</section>
</section>
<!--main content end-->

<!--footer start-->

<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/main.js"></script>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/exam_myjs.js"></script>
<script type="text/javascript" src="js/pt_myjs.js"></script>
<script type="text/javascript" src="js/exam_ajax.js"></script>
<script type="text/javascript" src="js/sweetalert.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/jquery.sparkline.js" type="text/javascript"></script>
<script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.customSelect.min.js"></script>
<script src="js/respond.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var carousels = document.querySelectorAll('.carousel');
    carousels.forEach(function(carousel) {
        new bootstrap.Carousel(carousel);
    });
});
</script>

<!--right slidebar-->
<script src="js/slidebars.min.js"></script>
<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js">
</script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
<script src="js/dynamic_table_init.js"></script>
<!--common script for all pages-->
<script src="js/common-scripts5e1f.js?v=2"></script>

<script>
$(document).ready(function() {
    $('.view-flashcards').on('click', function() {
        var subjectId = $(this).data('id');
        
        $.ajax({
            url: 'user_fc.php',
            method: 'GET',
            data: { id: subjectId },
            success: function(response) {
                $('#flashcards-content').html(response);
                $('#flashcards-container').show();
            }
        });
    });
});
</script>

<!--script for this page-->
<script src="js/sparkline-chart.js"></script>
<script src="js/easy-pie-chart.js"></script>
<script src="js/count.php"></script>
<!--summernote-->
<script src="assets/summernote/dist/summernote.min.js"></script>

<script>
jQuery(document).ready(function() {

    $('.summernote').summernote({
        height: 200, // set editor height

        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor

        focus: true // set focus to editable area after initializing summernote
    });
});
</script>
</body>

</html>