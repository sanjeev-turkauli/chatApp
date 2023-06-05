let loginLoad = document.querySelector(".submit_login");
let txt = document.querySelector(".registerTxt");
let contant = document.querySelector(".signup-content");
let settingAccount = document.querySelector(".settingAccount");
let loader = document.querySelector(".submit_load");
let usersList = document.querySelector(".usersList");

export class authentication {
    constructor() {
        console.log("javascript running...");
    }

    emailValidate(email) {
        // Check if the email matches the regex pattern
        var mailFormat =
            /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (!mailFormat.test(email)) {
            return false;
        }
        return true;
    }

    set_error(current_error) {
        current_error.parentElement
            .querySelector(".form-group label")
            .classList.remove("isValid");
        current_error.classList.remove("isValid");

        current_error.parentElement
            .querySelector(".form-group label")
            .classList.add("isInvalid");
        current_error.classList.add("isInvalid");
    }

    set_success(current_success) {
        current_success.parentElement
            .querySelector(".form-group label")
            .classList.add("isValid");
        current_success.classList.add("isValid");

        current_success.parentElement
            .querySelector(".form-group label")
            .classList.remove("isInvalid");
        current_success.classList.remove("isInvalid");
    }

    request(requetUrl, method, token, formData,type) {
        $.ajax({
            url: requetUrl,
            type: method,
            _token: token,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                if(type == "login"){ loginLoad.parentElement.setAttribute("disabled",true);loginLoad.classList.remove("visually-hidden");}else{beforeFunction();} 
            },
            success: function (response) {
    
                if(type == "register"){
                    successFunction(response)
                }else{
                    if(response.status){
                        sendMessage(response.message,"success");
                        setTimeout(()=>{sendMessage("redirecting...","warning");},2000);
                        setTimeout(()=>{window.location.href="chat"},3500);
                    }else{
                        loginLoad.classList.add("visually-hidden");
                        loginLoad.parentElement.removeAttribute("disabled",false);
                        sendMessage(response.message,"error");
                    }
                }

            },
            error: function (error) {
                loginLoad.parentElement.removeAttribute("disabled",false);
                sendMessage(error,"error");

            },
        });
    }

    check_checkbox(input) {
        return input.checked == true ? true : false;
    }

    message(msg,status){
        sendMessage(msg, status)
    }

    logOut(){
        Swal.fire({
            title: 'Are You sure you want to logout?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, LogOut!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"logOut",
                    type:"post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        if(response.status){
                            location.reload();
                        }
                    }
                });
            }
        })

    }

    loadUsers(){
        let limit = 1;
        var html = "";
        $.ajax({
            url:"get_user",
            type:"get",
            data:{"limit":limit},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
               let image = "";
               response.data.forEach((data,index)=>{
                    if(data.image == null){image = "https://bootdey.com/img/Content/avatar/avatar1.png";}else{image = "/images/"+data.image;}

                    html += `<li class="clearfix active mt-1">`;
                    html += `<img src="${image}" alt="avatar">`;
                    html += `<div class="about">`;
                    html += `<div class="name">${data.name}</div>`;
                    html += `<div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>`;
                    html += `</div>`;
                    html += `</li>`;
               });

               usersList.innerHTML=html;
            }
        });
    }
}

function sendMessage(msg, status) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
    Toast.fire({ icon: status, title: msg });
}


function beforeFunction(){
    txt.classList.add("text-primary");
    txt.classList.remove("text-danger");
    contant.classList.add("hidePopUp");
    settingAccount.classList.add("showPopUp");
    txt.innerHTML="Please Wait...";
}

function successFunction(data){

    if(data.status == true){
        loader.classList.add("visually-hidden");
        txt.innerHTML="Creating...";
        setTimeout(()=>{txt.innerHTML="Setting Your Account..."; },2000);
        setTimeout(()=>{txt.innerHTML="Finising Your Account..."; },5000);
        setTimeout(()=>{txt.innerHTML="Completing Your Account..."; },8000);
        setTimeout(()=>{txt.innerHTML="redirecting..."; },9000);
        setTimeout(()=>{ window.location.href="chat";},11000);
    }else{
        txt.classList.remove("text-primary");
        txt.classList.add("text-danger");
        txt.innerHTML="try again";

        setTimeout(()=>{
            contant.classList.remove("hidePopUp");
            settingAccount.classList.remove("showPopUp");
        },1200);
        
    }

}
