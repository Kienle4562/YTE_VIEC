$("#btnSendFeedBack").click(function(){
    var btn = $(this);
    var frm = $("form[name=frmSendFeedback]");
    if($(frm)[0].checkValidity()) {
        $.ajax({
            url: 'customer-contact',
            type: 'POST',
            dataType: 'JSON',
            data: $("form[name=frmSendFeedback]").serialize(),
            beaforeSend: function(){
                btn.prop("disabled", true);
            },
            success: function(response){
                if(response.status == 1){
                    btn.prop("disabled", false);
                    $("#SendFeedbackContent").html(response.toastr);
                }else if(response.status == 0){
                    var elementError = $("input[name="+response.toastr+"]");
                    elementError.addClass('required').focus();
                    elementError.nextAll("p.has-error").html(response.message);
                }else{
                    btn.prop("disabled", false);
                    alert(response.message);
                }
            }
        })
    }else{
		$(frm).find(":invalid").addClass('required').first().focus();
		$(frm).find(":invalid").each(function(index, node) {
			$(this).next("p.has-error").html(node.validationMessage);
		})
		event.preventDefault();
	}
})