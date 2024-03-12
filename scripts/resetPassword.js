$("document").ready(() => {
    let inputs = $("input");
    let btn = $("#form-submit");
    let form = $("form");
    let formData = {};
    let getUser = {};
    inputs.each((i, el) => {
        el.addEventListener("input", (e) => {
            checkBtn();
        });
    });
    form.submit((e) => {
        e.preventDefault();
        inputs.each((i, el) => {
            formData[el.id] = el.value.trim();
        })
        $.ajax({
            url: "../actions/reset_password.php",
            data: formData,
            type: "POST",
            success: function (data) {
                removeErrors();
                let serverRequest = JSON.parse(data);
                if (serverRequest.status == "error") {
                    validationError(serverRequest.errors);
                } else {
                    removeErrors();
                    $("form")[0].reset()
                    getUser = serverRequest.msg;
                    toSecondSlide(getUser)
                }
            },
            error: function () {
                alert("error");
            },
        });
    });

    function checkBtn() {
        if (inputs[0].value.trim()) {
            btn.removeAttr("disabled");
        } else {
            btn.prop("disabled", "true");
        }
    }
    checkBtn();

    function validationError(errorArray) {
        for (key in errorArray) {
            $(`#${key}`).removeClass("success");
            $(`#${key}`).addClass("danger");
            $(`.${key}-err`).html(errorArray[key]);
            $(`.${key}-err`).addClass("show");
            console.log(`${key} ${errorArray[key]}`);
        }
        inputs.each((i, el) => {
            if (!el.classList.contains("danger")) el.classList.add("success");
        });
    }
    function removeErrors() {
        inputs.each((i, el) => {
            if (el.classList.contains("danger")) {
                el.classList.remove("danger");
            }
            el.classList.add("success");
        });
        $(".error").each((i, el) => {
            if (el.classList.contains("show")) {
                el.innerHTML = "";
                el.classList.remove("show");
            }
        });
    }

    $('#wrong-user').click(() => {
        alert('Проверьте правильность введенных данных')
        toFirstSlide()
    })

    $('#right-user').click(() => {
        $.ajax({
            url: "../actions/sent_reset_letter.php",
            data: { id: getUser.id },
            type: "POST",
            success: function (data) {
                // console.log(data);
            },
            error: function () {
                alert("error");
            },
        });
        toThirdSlide()
    })

    function toThirdSlide() {
        $('.slider').css({
            transform: 'translateX(calc(100%/-3 * 2 + 5px))'
        });
    }

    function toSecondSlide(name) {
        console.log(name.fcs);
        $('#user-fcs').html(name.fcs)
        console.log($('#user-fcs'));
        $('.slider').css({
            transform: 'translateX(calc(100%/-3 + 5px))'
        });
    }

    function toFirstSlide() {
        $('.slider').css({
            transform: 'translateX(0)'
        });
    }

});
