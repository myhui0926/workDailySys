function readCookie() {
    var allCookie = document.cookie;
    var cookieArray = allCookie.split('; ');
    var cookieObj = {};
    for (var i=0;i<cookieArray.length;i++){
        var tmp = cookieArray[i].split('=');
        cookieObj[tmp[0]] = tmp[1];
    }
    return cookieObj;
}