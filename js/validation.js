function validateName() {
    // alert("hello");
    if(document.getElementById("name").value == ""){
        document.getElementById("nameValid").innerHTML = "";
    } else {
        document.getElementById("nameValid").innerHTML = "&#10004;";
    }
}

function validateEngineSize() {
    const pattern = /^[0-9]{2,4}cc$/;
    // alert(pattern.test(String(document.getElementById("engineSize").value)));
    if(document.getElementById("engineSize").value == ""){
        document.getElementById("engineSizeValid").innerHTML = " * Please enter your Engine Size!";
        // document.getElementById("engineSizeValid").style = "color:red;"
    } else if(!pattern.test(String(document.getElementById("engineSize").value))) {
        document.getElementById("engineSizeValid").innerHTML = " * Invalid format! (eg; 125cc or 500cc)";
    } else {
        document.getElementById("engineSizeValid").innerHTML = "&#10004;";
    }
    // alert("hello");
}

function validateListPrice() {
    const pattern = /^[0-9]+$/;
    if(document.getElementById("listPrice").value == ""){
        document.getElementById("listPriceValid").innerHTML = " * Please enter your List Price!";
    } else if(!pattern.test(String(document.getElementById("listPrice").value))) {
        document.getElementById("listPriceValid").innerHTML = " * Invalid format! (Please enter numeric value)";
    } else {
        document.getElementById("listPriceValid").innerHTML = "&#10004;";
    }
}

function validateServiceDate() {
    const pattern = /^(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))$/;
    if(document.getElementById("serviceDate").value == ""){
        document.getElementById("serviceDateValid").innerHTML = " * Please enter your last Service Date!";
    } else if(!pattern.test(String(document.getElementById("serviceDate").value))) {
        document.getElementById("serviceDateValid").innerHTML = " * Invalid format! (YYYY-MM-DD)";
    } else {
        document.getElementById("serviceDateValid").innerHTML = "&#10004;";
    }
}
