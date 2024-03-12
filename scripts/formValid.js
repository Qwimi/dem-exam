$("document").ready(() => {
  let inputs = $("input");
  let btn = $("#form-submit");
  let form = $("form");
  let formData = {};
  let currentPhone = "";
  let formHref = "";
  inputs.each((i, el) => {
    el.addEventListener("input", (e) => {
      if (el.getAttribute("type") == "tel") {
        el.value = maskEvent(e);
      }
      checkBtn();
    });
  });
  if (form.attr("id") == "reg-form") formHref = "../actions/reg.php";
  if (form.attr("id") == "log-form") formHref = "../actions/log.php";
  if (form.attr("id") == "request-form") formHref = "../actions/request.php";
  form.submit((e) => {
    e.preventDefault();
    inputs.each((i, el) => {
      if (el.getAttribute("type") != "checkbox") {
        formData[el.id] = el.value.trim();
      } else {
        formData[el.id] = el.checked;
      }
    })
    $.ajax({
      url: formHref,
      data: formData,
      type: "POST",
      success: function (data) {

        removeErrors();
        let serverRequest = JSON.parse(data);
        if (serverRequest.status == "error") {
          validationError(serverRequest.errors);
        } else {
          removeErrors();
          alert(serverRequest.msg);
          if (serverRequest.redirect) {
            location.href = serverRequest.redirect;
          }
          $("form")[0].reset()
        }
      },
      error: function () {
        alert("error");
      },
    });
  });

  function checkBtn() {
    let values = [];
    inputs.each((i, el) => {
      if (el.getAttribute("type") != "checkbox") {
        values.push(el.value.trim());
      } else {
        values.push(el.checked);
      }
    });
    let isAlInputed = values.every((el) => el.length != 0 && el != false);
    if (isAlInputed) {
      btn.removeAttr("disabled");
    } else {
      btn.prop("disabled", "true");
    }
  }
  checkBtn();

  function maskEvent(e) {
    const mask = "+7 (___)-___-__-__";
    let curentValue = currentPhone;
    let currentData = e.data;
    let currentLength = curentValue.length;

    if (/[0-9]/.test(currentData) && mask.length > currentLength) {
      if (mask[currentLength] != "_") {
        for (i = currentLength; i < mask.length; i++) {
          if (mask[i] == "_") {
            currentPhone += currentData;
            break;
          } else {
            currentPhone += mask[i];
          }
        }
      } else {
        currentPhone += currentData;
      }
    }
    if (currentData == null) {
      currentPhone = currentPhone.substring(0, currentLength - 1);
    }
    return currentPhone;
  }

  function validationError(errorArray) {
    for (key in errorArray) {
      console.log(key);
      $(`#${key}`).removeClass("success");
      $(`#${key}`).addClass("danger");
      $(`.${key}-err`).html(errorArray[key]);
      $(`.${key}-err`).addClass("show");
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
});
