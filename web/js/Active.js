$("#AlertMessageB").click(function () {
    "use strict";
    $("#AlertMessage").hide();
});

$('#FormAjax').on('beforeSubmit', function () {
    var data = $(this).serialize();

    $.ajax({
        url: 'site/index',
        type: 'POST',
        data: data,
        data: data,
        success: function (res) {
            $('#myModal').fadeOut();
            $("#simple-msg").fadeIn('slow');

            setTimeout(function () {
                $("#simple-msg").fadeOut('slow');
            }, 6000);
            $("#FormAjax")[0].reset();

        },
        error: function () {
            alert('Непредвиденная ошибка!');
        }
    });
    return false;
});
$('#myBtn').click(function () {
    if (
        $('#reservation-lengthofnights').val() === '' ||
        $('#City').val() === '' ||
        $('#cat-id').val() === '' ||
        $('#reservation-numberofpeople').val() === ''
    ) {

        $('#simple-msg-form').fadeIn();
        setTimeout(function () {
            $("#simple-msg-form").fadeOut('slow');
        }, 900);
    } else
        $('#myModal').fadeIn();
});
$('.close').click(function () {
    $('#myModal').fadeOut();
});
$('.close-alert').click(function () {
    $("#simple-msg").fadeOut('slow');
});
$(window).click(function (e) {

/*	alert(e.target.id);
	alert(e.target.className);*/
    if (e.target.id == '' && e.target.className == 'container' || e.target.className == "wrap" || e.target.className == "custom-body"|| e.target.className == "form-reservation") {
        $('#myModal').fadeOut();

    }
});
$(document).keyup(function (e) {
    if (e.keyCode === 27) {
        $('#myModal').fadeOut();

    }
});
/*

var modal = document.getElementById("myModal");
var carous = document.getElementById("carous");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
	modal.style.display = "block";
	carous.style.opacity = 0.2;
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
	carous.style.opacity = 1;
}

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
	if (event.target == modal) {
		carous.style.opacity = 0.2;
		modal.style.display = "none";

	}
}*/
