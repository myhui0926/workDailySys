$(function(){
    var host = 'http://'+document.domain;
    var  cookieObj = readCookie();
    if (cookieObj.username && cookieObj.user_id){
        var nav = new Vue({
            el:'#nav-html',
            data:{
                username:decodeURI(cookieObj.username)
            }
        });
    }else{
        window.location.href = host+"/workDailySys/user/login.html";
    }
});