$(function(){
    var registerBox = new Vue({
        el:'#register-box',
        data:{
            username:'',
            email:'',
            type:'pSelect',
            department:'pSelect',
            group:'pSelect',
            group_disable:true,
            password:'',
            confirm_password:'',
            departArray:[
                {did:0,dn:'Loading...',group:[]}
            ],
            groupArray:[],
            help_text:{
                username:{text:'', success:false, error:false},
                email:{text:'', success:false, error:false},
                type:{text:'', success:false, error:false},
                password:{text:'', success:false, error:false},
                confirmPassword:{text:'', success:false, error:false}
            }
        },
        watch:{
           username:function (newValue) {
                this.help_text.username.text = "请输入2-4个汉字";
                this.checkUsername(newValue);
           },
            email:function(newValue){
               this.help_text.email.text = "请输入正确的电子邮箱地址";
               this.checkEmail(newValue);
            },
            type:function(newValue){
               this.help_text.type.text = "请选择则用户类型";
               this.checkType(newValue);
            },
            department:function(newValue){
                this.group_disable = false;
                this.group='pSelect';
                $.each(this.departArray,function(index,item){
                   if (item.did===newValue){
                        registerBox.groupArray = item.group;
                   }
                });
            },
            password:function(newValue){
                this.help_text.password.text = "请输入6-18位密码";
                if (this.help_text.password.time){
                    clearTimeout(this.help_text.password.time);
                }
               this.help_text.password.time = setTimeout(function () {
                    registerBox.checkPassword(newValue);
                },1000);
            },
            confirm_password:function (newValue) {
                this.help_text.confirmPassword.text = "等待输入.....";
                if (this.help_text.confirmPassword.time){
                    clearTimeout(this.help_text.confirmPassword.time);
                }
                this.help_text.confirmPassword.time = setTimeout(function(){
                    registerBox.checkConfirmPassword(newValue);
                },1000);
            }
        },
        methods:{
            checkUsername:function(value){
                if (value.match(/^[\u4e00-\u9fa5]{2,4}$/g)){
                    this.help_text.username.text = "输入正确";
                    this.help_text.username.success = true;
                    this.help_text.username.error = false;
                }else{
                    this.help_text.username.text = "请输入2-4个汉字";
                    this.help_text.username.error = true;
                    this.help_text.username.success = false;
                }
            },
            checkEmail:function (value) {
                if (value.match(/^\w+(\.\w)*@\w+((\.\w{2,3}){1,3})$/)){
                    this.help_text.email.text = "输入正确";
                    this.help_text.email.success = true;
                    this.help_text.email.error = false;
                }else{
                    this.help_text.email.text = "电子邮箱格式错误";
                    this.help_text.email.error = true;
                    this.help_text.email.success = false;
                }
            },
            checkType:function(value){
               if (value!=='pSelect'){
                   this.help_text.type.text = "输入正确";
                   this.help_text.type.success = true;
                   this.help_text.type.error = false;
               }else{
                   this.help_text.type.text = "你没有选择用户类型";
                   this.help_text.type.success = false;
                   this.help_text.type.error = true;
               }
            },
            checkPassword:function(value){
                if (value.match(/^.{6,16}$/)){
                    this.help_text.password.text = "输入正确";
                    this.help_text.password.success = true;
                    this.help_text.password.error = false;
                }else{
                    this.help_text.password.text = "密码格式有误";
                    this.help_text.password.success = false;
                    this.help_text.password.error = true;
                }
            },
            checkConfirmPassword:function (value) {
                if (value===this.password && value.length!==0){
                    this.help_text.confirmPassword.text = "输入正确";
                    this.help_text.confirmPassword.success = true;
                    this.help_text.confirmPassword.error = false;
                }else{
                    this.help_text.confirmPassword.text = "你两次输入不匹配";
                    this.help_text.confirmPassword.success = false;
                    this.help_text.confirmPassword.error = true;
                }
            },
            submitData:function(){
                var allChecked = true;
                for (x in this.help_text){
                    if (!this.help_text[x].success){
                        this.help_text[x].error = true;
                        this.help_text[x].text = "请输入完整信息";
                        allChecked = false;
                    }
                }
                if (allChecked){
                    var dataObj = {
                        username:this.username,
                        email:this.email,
                        type:this.type,
                        department:this.department,
                        group:this.group,
                        password:this.password,
                        confirm_password:this.confirm_password
                    };
                    $.ajax({
                       url:'http://'+ window.location.hostname + '/workDailySys/user/register.php',
                       type:'post',
                       data:dataObj,
                       dataType:'json',
                       success:function (response) {
                           console.log(response);
                       } 
                    });
                }
            }
        },
        created:function(){
            var _self_ = this;//ajax中this会改变指向，所以先存储这个对象
            $.ajax({
                url:'http://'+ window.location.hostname + '/workDailySys/user/company_structure.php',
                type:'GET',
                dataType:'json',
                success:function (response) {
                    console.log(response);
                    if (response.status){
                        _self_.departArray=[];
                        $.each(response.message,function(index,item){
                           _self_.departArray.push(item);
                        });
                        console.log(_self_);
                    }
                }
            });
        }
    });
});
