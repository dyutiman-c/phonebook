$(document).ready(function() {

    var clear_form = function()
    {
        $('#entryForm .modal-title').html('Adding Contact');
        $('#entryForm form .contactid').remove();
        $('#entryForm form input').val('');
        $('#entryForm form textarea').val('');
    }

    var load_form = function(elem) {
        clear_form();
        if(typeof elem !== 'undefined') {
            $('#entryForm .modal-title').html('Updating Contact');
            $('#entryForm form').append('<input type="hidden" value="'+ elem.attr('cid') +'" name="cid" class="contactid"/>');
            $('#staticName').val(elem.find('.name').html());
            $('#staticPhone').val(elem.find('.phone').html());
            $('#staticNote').val(elem.find('.note').html());
        }
        $('#entryForm').modal();
    };


    $('.datepicker').datepicker({
        todayBtn: "linked",
        autoclose: true
    });
    $('.addcontact').click(function() {
        load_form();
        return false;
    })
    $('.save-contact').click(function() {
        $('#contact-form').submit();
        return false;
    });
    $('#contact-form').submit(function() {
        if(!$('#staticName').val()) {
            alert('Name is required');
            return false;
        }
        if(!$('#staticPhone').val()) {
            alert('Phone number is required');
            return false;
        }
        return true;
    });
    $('.delcontact').click(function() {
        return confirm('Are you sure to want to delete the selected contact?')
    });
    $('.editcontact').click(function() {
        load_form($(this).parent().parent());
        return false;
    });
});