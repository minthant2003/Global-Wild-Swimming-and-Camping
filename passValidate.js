const pass = document.getElementById('pass');
const conpass = document.getElementById('conpass');
const passOut = document.getElementById('passOut');

pass.onkeyup = () => {
    if(!(pass.value.match(/[0-9]/))) {
        passOut.innerHTML = "Password must contain at least 1 number.";
        return;
    }
    if(!(pass.value.match(/[a-z]/))) {
        passOut.innerHTML = "Password must contain at least 1 lower-case.";
        return;
    }
    if(!(pass.value.match(/[A-Z]/))) {
        passOut.innerHTML = "Password must contain at least 1 upper-case.";
        return;
    }
    if(!(pass.value.match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/))) {
        passOut.innerHTML = "Password must contain at least 1 special character.";
        return;
    }
    if(pass.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]).*$/)) {        
        passOut.innerHTML = "";
        return;
    }
}

conpass.onchange = () => {
    if(pass.value !== conpass.value) {
        alert("Password & Confirm-password are not the same.");        
    } 
}
