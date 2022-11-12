const pswrdField = document.querySelector(".field input[type='password']"),
    toggleBtn = document.querySelector(".field i");

toggleBtn.onclick = () => {
    if (pswrdField.type == "password") {
        pswrdField.type = "text";
        toggleBtn.classList.add("active");
    } else {
        pswrdField.type = "password";
        toggleBtn.classList.remove("active");
    }
}