var action_alert = (type,messages) => {
    var html = '<div class="alert alert-'+type+'" role="alert">';
    if(typeof messages == 'string'){
        html += messages;
    }
    console.log(typeof messages);
    if(typeof messages == 'array'){
        $.each(messages,() =>{
            html += messages+'\n';
        });
    }
    html += '</div>';
    $('#response-alert').html(html);
}; 

var ajaxform = (form_class,success,error) => {
    $(form_class).submit(function(e){
        e.preventDefault();
        var form = $(form_class)[0];
        var data = new FormData(form);
        if($(form).find('input[type="file"]').length > 0){
            data.append('image', 'input[type="file"]');
        }
        console.log(data);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            data: data,
            headers: {
                "Accept" : "application/json",
                "authorization": 'Bearer '+getCookie('jwt_token')
            },
            before: () => {
                $('alert').remove();
                $('button[type="submit"]').attr('disabled','disabled');
            },
            complete: () => {
                $('button[type="submit"]').removeAttr('disabled');
            },
            success: (response) => {
                if(response.success){
                    success(response);
                }else{
                    error(response);
                }
            }
        });
    });
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
module.exports = {
    action_alert : action_alert,
    ajaxform:ajaxform
}