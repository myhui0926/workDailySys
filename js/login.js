$(function(){
    var host = 'http://' + document.domain;
    var allCookiie = document.cookie;
    if (allCookiie.indexOf("username")!=-1 && allCookiie.indexOf("user_id")!=-1){
        window.location.href = host+"/WorkDailySys/user-agent/_index.php";
    }else{
        var loginBox = new Vue({
            el:'#login-box',
            data:{
                email:'',
                pass:''
            },
            methods:{
                login:function () {
                    var _self = this;
                    $.ajax({
                        url:host +'/workDailySys/user/login.php',
                        type:'POST',
                        dataType:'json',
                        data:{email:_self.email,pass:_self.pass},
                        success:function(response){
                            console.log(response);
                            if(response.status){
                                let modalBodyText = [];
                                $.each(response.msg,function(index,item){
                                    modalBodyText.push({text:item});
                                });
                                siteModel.items = modalBodyText;
                                $('#siteModal').modal('show');
                                setTimeout(function(){
                                    $('#siteModal').modal('hide');
                                    window.location.href = host+"/workDailySys/user-agent/_index.php";
                                },1000);
                            }else{
                                let modalBodyText = [];
                                $.each(response.errors,function(index,item){
                                    modalBodyText.push({text:item});
                                });
                                siteModel.items = modalBodyText;
                                $('#siteModal').modal('show');
                                setTimeout(function(){
                                    $('#siteModal').modal('hide');
                                },2000);
                            }
                        }
                    });
                }
            }
        });

        var siteModel = new Vue({
            el:'#siteModal',
            data:{
                items:[],
                modalHeader:"登录状态",
                btn1:{
                    text:"关闭",
                    show:true,
                    classList:{
                        'btn-default':true,
                        'btn-primary':false
                    }
                },
                btn2:{
                    text:"确定",
                    show:false,
                    classList:{
                        'btn-default':true,
                        'btn-primary':false
                    }
                }
            }
        });
    }
});