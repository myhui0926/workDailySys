$(function(){
    var host = 'http://'+document.domain;
    var  cookieObj = readCookie();
    console.log('Running check cookie!');
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