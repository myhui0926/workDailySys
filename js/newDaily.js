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
                        console.log(response);
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
});