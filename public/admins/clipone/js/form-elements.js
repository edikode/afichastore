var FormElements = function () {
    //function to initiate jquery.inputlimiter
    var runInputLimiter = function () {
        $('.limited').inputlimiter({            
			remText: 'Kurang %n karakter lagi...',
			remFullText: 'Maaf!',
			limitText: 'Maksimal %n karakter pada inputan ini.'
			//remText: 'You only have %n character%s remaining...',
            //remFullText: 'Stop typing! You\'re not allowed any more characters!',
            //limitText: 'You\'re allowed to input %n character%s into this field.'
        });
    };
    //function to initiate query.autosize    
    var runAutosize = function () {
        $("textarea.autosize").autosize();
    };
    //function to initiate Select2
    var runSelect2 = function () {
        $(".search-select").select2({
            placeholder: "Klik Disini Untuk Memilih",
            allowClear: true
        });
    };
    //function to initiate jquery.maskedinput
    var runMaskInput = function () {
        $.mask.definitions['~'] = '[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999", {
            placeholder: " ",
            completed: function () {
                alert("You typed the following: " + this.val());
            }
        });
    };
    //function to initiate bootstrap-datepicker
    var runDatePicker = function () {
        $('.date-picker').datepicker({
            autoclose: true
        });
    };
    //function to initiate bootstrap-timepicker
    var runTimePicker = function () {
        $('.time-picker').timepicker({
			showSeconds: false,
			showMeridian: false
		});				
    };
    //function to initiate daterangepicker
    var runDateRangePicker = function () {
        $('.date-range').daterangepicker();
        $('.date-time-range').daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            format: 'MM/DD/YYYY h:mm A'
        });
    };
    //function to initiate bootstrap-colorpicker
    var runColorPicker = function () {
        $('.color-picker').colorpicker({
            format: 'hex'
        });
        $('.color-picker-rgba').colorpicker({
            format: 'rgba'
        });
        $('.colorpicker-component').colorpicker();
    };
    //function to initiate jquery.tagsinput
    var runTagsInput = function () {
        $('#tag').tagsInput({
            width: 'auto'
        });
    };
    
    return {
        //main function to initiate template pages
        init: function () {
            runInputLimiter();
            runAutosize();
            runSelect2();
            runMaskInput();
            runDatePicker();
            runTimePicker();
            runDateRangePicker();
            runColorPicker();
            runTagsInput();          
        }
    };
}();