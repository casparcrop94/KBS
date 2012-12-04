$(document).ready(function() {  
    // if user clicks on checkbox with id="checkall" - all checkboxes are selected  
    // and table row background is highlighted  
    $("#checkall").on('click',function(event){  
        $('input:checkbox:not(#checkall)').prop('checked',this.checked);  
        if ($(this).is(':checked') == true) {  
            $("#tblDisplay").find('tr:not(#chkrow)');  
        } else  {  
            $("#tblDisplay").find('tr:not(#chkrow)');  
        }  
    });      
    // if user clicks on checkbox, diffrent than checkbox with id="checkall" ,   
    // then checkbox is checked/unchecked  
    $('input:checkbox:not(#checkall)').on('click',function(event) {  
        if($("#checkall").is(':checked') == true && this.checked == false) {  
            $("#checkall").prop('checked',false);  
            $(this).closest('tr');  
        }  
        if(this.checked == true) {  
            $(this).closest('tr');  
            // function to check/uncheck checkbox with id="checkbox"  
            CheckSelectAll();   
        }  
        if(this.checked == false)  {  
            $(this).closest('tr');  
        }  
    });  
        // if checkbox is checked on page load, highlight table background  
    $('#tblDisplay tbody tr').filter(':has(:checkbox:checked)').end();      
  
function CheckSelectAll() {  
    var flag = true;  
    $('input:checkbox:not(#checkall)').each(function() {  
        if(this.checked == false)  
        flag = false;  
    });  
    $("#checkall").attr('checked',flag);  
    }  
});