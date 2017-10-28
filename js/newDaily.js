$(function(){
    var host = 'http://'+document.domain;
    var daily = new Vue({
        el:'#daily',
        data:{
            subject:'',
            primary:'',
            html:''
        },
        methods:{
            submitData:function(){
                this.html = document.getElementById('editor').innerHTML;
                var _self = this;
                $.ajax({
                    url:host+'/workDailySys/message/addMessage.php',
                    type:'POST',
                    dataType:'json',
                    data:{type:'workDaily',subject:_self.subject,primary:_self.primary,html:_self.html},
                    success:function(response){
                        if(response.status){
                            var modalBodyText = [];
                            $.each(response.msg,function(index,item){
                                modalBodyText.push({text:item});
                            });
                            siteModel.items = modalBodyText;
                            $('#siteModal').modal('show');
                            setTimeout(function(){
                                $('#siteModal').modal('hide');
                                window.location.reload();
                            },1000);
                        }else{
                            var modalBodyText = [];
                            $.each(response.errorMsg,function(index,item){
                               modalBodyText.push({text:item});
                            });
                            siteModel.items = modalBodyText;
                            $('#siteModal').modal('show');
                            setTimeout(function(){
                                $('#siteModal').modal('hide');
                            },10000);
                        }
                    }
                });
            },
            applyTag:function (e) {
                var targetNode = e.target;
                var role = '';
                if (targetNode.tagName != 'A'){
                    role = targetNode.parentNode.getAttribute('data-role');
                }else{
                    role = targetNode.getAttribute('data-role');
                }
                switch(role) {
                    case 'h1':
                    case 'h2':
                    case 'h3':
                    case 'h4':
                    case 'p':
                        document.execCommand('formatBlock', false, '<' + role + '>');
                        break;
                    default:
                        document.execCommand(role, false, null);
                        break;
                }
            }
        },
        created:function(){
            var editControls = document.getElementById('editControls');
            var controller = editControls.getElementsByTagName('a');
            for (var i=0;i<controller.length;i++){
                controller[i].setAttribute('v-on:click','applyTag');
            }
        }
    });

    var siteModel = new Vue({
        el:'#siteModal',
        data:{
            items:[],
            modalHeader:"提交状态",
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

});