<!-- Placed js at the end of the page so the pages load faster -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-ui-touch/jquery.ui.touch-punch-improved.js"></script>
    <script src="assets/vendor/lobicard/js/lobicard.js"></script>
    <script class="include" type="text/javascript" src="assets/vendor/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/vendor/jquery.scrollTo.min.js"></script>

    <!--datatables-->
    <script src="assets/vendor/data-tables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>


    <!--[if lt IE 9]>
    <script src="assets/vendor/modernizr.js"></script>
    <![endif]-->
    <!--select2-->
    <script src="assets/vendor/select2/js/select2.min.js"></script>
    <script src="assets/vendor/select2-init.js"></script>
 <!--form basic wizard init-->
    <script src="assets/vendor/form-wizard-init.js"></script>

    <!--jquery validate-->
    <script src="assets/vendor/form-validator/jquery.form-validator.js"></script>

    <!--jquery steps-->
    <script src="assets/vendor/jquery-steps/jquery.steps.min.js"></script>

    <!--Dropzone-->
    <script src="assets/vendor/dropzone/dropzone.js"></script>
    <script src="assets/vendor/dropzone-init.js"></script>

     <!--date picker-->
    <script src="assets/vendor/date-picker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/date-picker-init.js"></script>
    <script src="assets/vendor/month-picker/monthpicker.min.js"></script>

    <script src="assets/vendor/datetime-picker/js/bootstrap-datetimepicker.js"></script>
    <script src="assets/vendor/timepicker/js/bootstrap-timepicker.js"></script>
    <script src="assets/vendor/datetime-picker-init.js"></script>

    
    <!--jquery stepy-->
    <script src="assets/vendor/jquery-steps/jquery.stepy.js"></script>
    <!-- Sweet Alert-->
    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
    <!-- Modal -->
    <script src="assets/vendor/jquery-modal/jquery.modal.min.js"></script>
    <!-- Auto Number -->
    <script src="assets/vendor/autonumeric/autoNumeric-1.9.41.js"></script>
    <!--echarts-->
    <script type="text/javascript" src="assets/vendor/echarts/echarts-all-3.js"></script>
    <!--init scripts-->

     <!--input mask-->
    <script src="assets/vendor/input-mask/jquery.inputmask.bundle.js"></script>
    <script src="assets/vendor/input-mask-init.js"></script>

    <script src="assets/vendor/dropzone/dropzone.js"></script>
    <script src="assets/vendor/dropzone-init.js"></script>

    <!--toastr-->
    <script src="assets/vendor/toastr-master/toastr.js"></script>
    <script src="assets/vendor/toastr-master/toastr-init.js"></script>

    <script src="assets/js/scripts.min.js"></script>



    <script>
        $('.MonthYear').MonthPicker({ Button: false, MonthFormat: 'MM yy' });
        $(".form-control").attr('autocomplete', 'off');

        $(document).ready(function () {          
        $.extend($.fn.autoNumeric.defaults, {              
            aSep: ',',              
            aDec: '.'          
        });      
    });  

        $(document).on("keypress", 'input', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});

    jQuery(function($) {
        $('.inr').autoNumeric('init',{mDec:0,dGroup:2});    
    });
    
        $(document).ready(function() {
            $('#bs4-table').DataTable();
        } );

       

    function checkmember(memberid){
        
        $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'id':memberid, type: 'validate_member'},
        success: function(obj) { 
           data = jQuery.parseJSON(obj);
           if(data['data']==1) {
            $("#member_name").val(data['uname']);
            $("#memberid_error").hide();
           } else {            
            $("#member_name").val();
            $("#memberid_error").show();
           }
        }
    });
    }

    </script>

    