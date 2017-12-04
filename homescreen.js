window.onload = function () {
    var b = document.getElementById("compose");
    b.addEventListener("click",compose);
     var a = document.getElementById("send");
    a.addEventListener("click",send);
    var c = document.getElementById("view");
    c.addEventListener("click",view);
};
function compose (e) {
    e.preventDefault();
    $('#table').toggle();
    $('#letter').animate({
        height: 'toggle'
    });
}

function send (e) {
    var receipient = document.getElementById('receipient').value;
    var subject = document.getElementById('subject').value;
    var body = document.getElementById("body").value;
    var vempty = /^[A-za-z0-9]+/;
    if (vempty.test(receipient) === false){
        e.preventDefault();
        document.getElementById('rreq').innerHTML = '<strong>Receipient feild cannot be empty.<strong>';
    }
    if (vempty.test(subject) === false){
        e.preventDefault();
        document.getElementById('sreq').innerHTML = '<strong>Subject feild cannot be empty.<strong>';
    }
    if (vempty.test(body) === false){
        e.preventDefault();
        document.getElementById('breq').innerHTML = '<strong>Body feild cannot be empty.<strong>';
    }
}