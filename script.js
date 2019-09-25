document.writeln("<script src='https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js'></script>");
document.writeln("<script src='http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js'></script>");
function encrypt() {
	var pass=document.getElementById('password').value;
	if(pass=="") {
		document.getElementById('err').innerHTML='Error:Password is missing';
		return false;
	}
	else {
		var hash = CryptoJS.MD5(pass);
		document.getElementById('password').value=hash;
		return true;
	}
}
function show(ele) {
	if (document.getElementById(ele).type==="password") {
		document.getElementById(ele).type="text";
	} 
	else {
		document.getElementById(ele).type="password";
	}
}