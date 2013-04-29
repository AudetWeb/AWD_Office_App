// JavaScript Document
//
// <a href="javascript:mailto('yourdomain.com','you')">you@yourdomain.com</a>
//
function mailto(domain,user) 
{ 
document.location.href = "mailto:" + user + "@" + domain;
}

function showImg(theImgId){
document.getElementById(theCurrentImgId).style.display = "none";
theCurrentImgId = theImgId;
document.getElementById(theImgId).style.display = "block";
}
