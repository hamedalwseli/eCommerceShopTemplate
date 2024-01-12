$(document).ready(function () {
    // fire the select box page 
    $('select').selectBoxIt({
        autoWidth: false
    });
    // =======================================
    // start edit page 
    // start label effict 
    let editMemberInput = document.querySelectorAll(".edit-page .container form .input-box input");
    $(editMemberInput).parent().addClass('active');
    $(editMemberInput).focus(function () {
        $(this).parent().addClass('active');
        $(editMemberInput).focusout(function () {
            if ($(this).val() == '') {
                $(this).parent().removeClass('active');
            }
        })
    })
    // end label effict

    // start validate confirm password 
    // end validate confirm password 

    // end edit page

    // ===============================================
    // start confirmation on delete button in member page 
    $('.confrim').click(() => {
        return confirm('are you sure to delete a member');
    })
    // end confirmation on delete button in member page

    $('.cat-box .cat').click(function () {
        console.log('ha')
        $(this).next('.full-view').fadeToggle(500);
    })

    $('.options .ch').click(function () {
        $(this).addClass('active').siblings('.ch').removeClass('active');
        if ($(this).data('view') === 'full') {
            $('.full-view').fadeIn(200);
        } else {
            $('.full-view').fadeOut(200);

        }
    })

});



// start seting

//local stroage
let laoc = window.localStorage.getItem("color_option")
if (laoc !== null) {
    document.documentElement.style.setProperty("--main-color", laoc)
    document.querySelectorAll(".setting .seting-container .colors ul li").forEach(e => {
        e.classList.remove("color-active")
        if (e.dataset.color === laoc) {
            e.classList.add("color-active")
        }
    })

}

// let body = document.querySelector("body")
let gear = document.querySelector(".setting .toggle-setting .fa-gear");
let setting = document.querySelector(".setting");
gear.onclick = function () {
    this.classList.toggle("fa-spin")

    setTimeout(() => {
        this.classList.remove("fa-spin")
    }, 1000)
    setting.classList.toggle("open")

    setTimeout(() => {
        document.querySelector(".setting .seting-container ul").classList.toggle("active")
    }, 300)
    setTimeout(() => {
        document.querySelector(".setting .seting-container .colors").classList.toggle("active")
    }, 300)


}

// body.onclick = function () {
//     setting.classList.remove("open")
// }
//switching color
let colorLi = document.querySelectorAll(".setting .seting-container .colors ul li")
colorLi.forEach((li) => {
    li.addEventListener("click", (e) => {
        e.target.parentElement.querySelectorAll(".color-active").forEach((ele) => {
            ele.classList.remove("color-active")
        })
        e.target.classList.add("color-active")
        document.documentElement.style.setProperty('--main-color', e.target.dataset.color)
        //local storage
        window.localStorage.setItem("color_option", e.target.dataset.color)
    })
});
// end seting