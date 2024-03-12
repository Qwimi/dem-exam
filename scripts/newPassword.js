$('document').ready(() => {
    var currentURL = window.location.search.replace('?token=', '')
    // console.log(currentURL);

    let inputs = $("input");
    let btn = $("#form-submit");
    let form = $("form");
    let formData = { 'hash': currentURL };
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
            url: "../actions/new_password.php",
            data: formData,
            type: "POST",
            success: function (data) {
                removeErrors();
                console.log(data);
                let serverRequest = JSON.parse(data);
                console.log(serverRequest);

                if (serverRequest.status == "error") {
                    validationError(serverRequest.errors);
                } else {
                    if (serverRequest.redirect) {
                        location.href = serverRequest.redirect;
                    }
                    removeErrors();
                    $("form")[0].reset()
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
})