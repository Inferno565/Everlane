const mail = document.getElementById("email");
const pass = document.getElementById("pass");
const e = document.getElementById("form1");
mail.addEventListener("keyup", () => {
    RegExpMail = "([A-Za-z]+)[0-9]*@{1}([A-Za-z0-9])+.com";
    inpMail = mail.value;
    let match1 = inpMail.match(RegExpMail);
    if (!match1) {
        document.styleSheets[0].addRule(
            "#mail-label::after",
            'content: " * Invalid ";'
        );
    } else {
        document.styleSheets[0].addRule("#mail-label::after", 'content: " ";');
    }
});

pass.addEventListener("keyup", () => {
    RegExpPass = "regex";
    inpPass = pass.value;
    let match1 = inpPass.match(RegExpPass);
    if (!match1) {
        document.styleSheets[0].addRule(
            "#pass-label::after",
            'content: " * Password should be a combination of letters and numbers and should be min 8 characters  ";'
        );
    } else {
        document.styleSheets[0].addRule("#pass-label::after", 'content: " ";');
    }
});

// function locate() {
//     const successCallback = (position) => {
//         console.log(position);
//     };

//     const errorCallback = (error) => {
//         console.log(error);
//     };

//     navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

// }

