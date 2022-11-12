const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box"),
    btnChat = document.querySelector(".button-chat"),
    enviar = document.querySelector(".enviar-chat");

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../../../controller/Chat/Tecnico/PegarChat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);

setInterval(() => {
    let xhr2 = new XMLHttpRequest();
    xhr2.open("GET", "../../../../controller/Chat/Tecnico/VerificarAtendimento.php", true);
    xhr2.onload = () => {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
                let data2 = xhr2.response;
                btnChat.innerHTML = data2;
                scrollToBottom();
            }
        }
    }
    let formData2 = new FormData(form);
    xhr2.send(formData2);
}, 500);

setInterval(() => {
    let xhr3 = new XMLHttpRequest();
    xhr3.open("GET", "../../../../controller/Chat/Tecnico/VerificarMensagem.php", true);
    xhr3.onload = () => {
        if (xhr3.readyState === XMLHttpRequest.DONE) {
            if (xhr3.status === 200) {
                let data3 = xhr3.response;
                enviar.innerHTML = data3;
                scrollToBottom();
            }
        }
    }
    let formData3 = new FormData(form);
    xhr3.send(formData3);
}, 500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}