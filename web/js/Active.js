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

            $("#simple-msg").fadeIn('slow');

            setTimeout(function () {
                $("#simple-msg").fadeOut('slow');
            }, 6000);
            $("#FormAjax")[0].reset();
            $('.country-choice').html('').fadeOut('10000').css({display : 'none'});
            $('.resort-choice').html('').fadeOut('10000').css({display : 'none'});
            $('.hotel-choice').html('').fadeOut('10000').css({display : 'none'});
            $('.glob-form').fadeOut();
        },
        error: function () {
            alert('Непредвиденная ошибка!');
        }
    });
    return false;
});
/*$('#myBtn').click(function () {
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
});*/

$('.close-alert').click(function () {
    $("#simple-msg").fadeOut('slow');
});


$(window).on('scroll', function() {

    if ($(this).scrollTop() > 0) {

    if ($('#upbutton').is(':hidden')) {
        $('#upbutton').css({opacity : 1}).fadeIn('slow');
    }
} else {
    $('#upbutton').stop(true, false).fadeOut('fast');
}
});
$('#upbutton').on('click', function() {
    $('html, body').stop().animate({scrollTop : 0}, 300);
});


$('#ter').click(function () {
    $('.glob-form').fadeIn('easing').css({display : 'flex'});

});
$('.close').click(function () {
    $('.glob-form').fadeOut();
});
$(document).keyup(function (e) {
    if (e.keyCode === 27) {
        $('.glob-form').fadeOut();

    }
});
$(window).click(function (e) {
/*
    	alert(e.target.id);
        alert(e.target.className);*/
    if (e.target.id == null && e.target.className == 'container' || e.target.className == "wrap" || e.target.className == "custom-body"|| e.target.className == "form-reservation") {
        $('.glob-form').fadeOut();

    }
});

$('#reservation-roomtype').change(function () {
    var RoomType=$('#reservation-roomtype').val();
    var Leng=$('#reservation-lengthofnights').val();
    var Ammount=$('#reservation-numberofpeople').val();
    if (RoomType ==='' && Leng ===''  && Ammount ==='' ) { $('.other-choice').fadeOut('easy');}
    if (RoomType !=='') {
        $('.TypeRoom').html("Количество комнат в номере: " + RoomType);
        $('.other-choice').fadeIn('10000').css({display: 'flex'});
    }
    else $('.TypeRoom').html("");
});
$('#reservation-lengthofnights').change(function () {
    var RoomType=$('#reservation-roomtype').val();
    var Leng=$('#reservation-lengthofnights').val();
    var Ammount=$('#reservation-numberofpeople').val();
    if (RoomType ==='' && Leng ===''  && Ammount ==='' ) { $('.other-choice').fadeOut('easy');}
    if (Leng !=="") {
        $('.AmmountNigths').html("Количество ночей: " + Leng).delay(3000);
        $('.other-choice').fadeIn('10000').css({display: 'flex'});
    }
    else  $('.AmmountNigths').html("");
});
$('#reservation-numberofpeople').change(function () {
    var RoomType=$('#reservation-roomtype').val();
    var Leng=$('#reservation-lengthofnights').val();
    var Ammount=$('#reservation-numberofpeople').val();
    if (RoomType ==='' && Leng ===''  && Ammount ==='' ) { $('.other-choice').fadeOut('easy');}
    if (Ammount !=='') {
        $('.AmmountTourists').html("Количество Туристов: " + Ammount);
        $('.other-choice').fadeIn('10000').css({display: 'flex'});
    }
    else  $('.AmmountTourists').html("");
});


$('#cat-id').change(function () {
if ($('#cat-id').val()=="")
{
/*    $('.resort-choice').html('').fadeOut('10000').css({display : 'none'});
    $('.hotel-choice').html('').fadeOut('10000').css({display : 'none'});*/
    $('.country-choice').fadeOut('easy');
    $('.resort-choice').fadeOut('easy');

    $('.hotel-choice').fadeOut('easy');
}
    var data = $(this).serialize();
    $.ajax({
        url: 'site/index',
        type: 'POST',
        data: data,
        success: function (res) {
            if (!$('#cat-id').val()=="") {

                $('.country-choice').html("Выбранная страна: "+res).fadeIn('10000').css({display : 'flex'});

            }

        },
        error: function () {
            alert('Непредвиденная ошибка!');
        }
    });

});
$('#subcat-id').change(function () {
    if ($('#subcat-id').val()=="")
    {

        $('.resort-choice').fadeOut('easy');
    }
    var data = $(this).serialize();
    $.ajax({
        url: 'site/index',
        type: 'POST',
        data: data,
        success: function (res) {

            if (!$('#subcat-id').val()=="") {


                $('.resort-choice').html("Выбранный курорт: "+res).fadeIn('10000').css({display : 'flex'});

            }

        },
        error: function () {
            alert('Непредвиденная ошибка!');
        }
    });

});

$('#City').change(function () {
/*    var City=$('#City').val();

    if (City !=='') {
        $('.city-choice').html("Город вылета: " + City).fadeIn('10000').css({display : 'flex'});

    }
    else $('.city-choic').fadeOut("easy");*/

    if ($('#City').val()=="")
    {

        $('.city-choice').fadeOut('easy');
    }
    var data = $(this).serialize();
    $.ajax({
        url: 'site/index',
        type: 'POST',
        data: data,
        success: function (res) {

            if (!$('#City').val()=="") {


                $('.city-choice').html('Город вылета: '+res).fadeIn('10000').fadeIn('10000').css({display : 'flex'});

            }

        },
        error: function () {
            alert('Непредвиденная ошибка!');
        }
    });


});


$('#reservation-idhotel').change(function () {
    if ($('#reservation-idhotel').val()=="")
    {

        $('.hotel-choice').fadeOut('easy');
    }
    var data = $(this).serialize();
    $.ajax({
        url: 'site/index',
        type: 'POST',
        data: data,
        success: function (res) {

            if (!$('#reservation-idhotel').val()=="") {


                $('.hotel-choice').html("Выбранный отель: "+res).fadeIn('10000').css({display : 'flex'});

            }

        },
        error: function () {
            alert('Непредвиденная ошибка!');
        }
    });

});
// 1 - Указание ключа в localstorage, в котором будет храниться отпечаток браузера
const keyLS = 'fingerprint';
// 2 - Указание URL файла, в котором находится сценарий диалога для чат-бота
const url = 'SimpleChatbot-1.2.0/data/data-1.json';
// 3 - Указание CSS селектора кнопки, с помощью которой будем вызывать окно диалога с чат-ботом
const chatbotBtnSel = '.chatbot-btn';
// 4 - URL к chatbot.php
const urlChatbot = 'SimpleChatbot-1.2.0/chatbot/chatbot.php';
// добавление хэша fingerprint в localstorage
let fingerprint = localStorage.getItem(keyLS);
/*if (!fingerprint) {
    Fingerprint2.get(function (components) {
        fingerprint = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31)
        localStorage.setItem(keyLS, fingerprint)
    });
}*/
// получение json-файла, содержащего сценарий диалога для чат-бота через AJAX
const request = new XMLHttpRequest();
request.open('GET', url, true);
request.responseType = 'json';
request.onload = function () {
    const status = request.status;
    if (status === 200) {
        const data = request.response;
        // инициализация ChatBotByItchief посредством вызова следующей функции с передачи ей нужных параметров
        chatBotByItchiefInit({
            chatbotBtnSel: chatbotBtnSel,
            data: data,
            url: urlChatbot,
            keyLS: keyLS
        });
    } else {
        console.log(status, request.response);
    }
};
request.send();