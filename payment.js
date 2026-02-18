function payNow() {
    let name = document.getElementById("name").value;
    let amount = document.getElementById("amount").value;
    let method = document.getElementById("method").value;


    if (name === "" || amount === "") {
        alert("Please fill all details");
        return;
    }


    if (amount <= 0) {
        alert("Please enter a valid amount");
        return;
    }


    document.getElementById("msg").innerHTML =
        "✅ Payment Successful! Thank you " + name + " ☕";


    setTimeout(function () {
        window.location.href = "contact.html";
    }, 2000);
}