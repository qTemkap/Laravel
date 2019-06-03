<template>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sd-12">
                <textarea class="form-control" rows="10" readonly=""><p style="text-align: right;">{{messages.join('\n')}}</p></textarea>
                <hr>
                <input type="text" class="form-control" v-model='textMessage' @keyup.enter="sendMessage">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['published','two_user','user','messages_list'],
        data() {
            return {
                messages: [],
                textMessage: '',
                user_ID: ''
            }
        },
        mounted() {
            window.Echo.private('room.'+this.published)
                    .listen('PrivateChat', ({data}) => {
                        this.messages.push(data.body)
                    });
// window.Echo.private('user.'+this.user)
//                     .listen('NewMessage', ({data}) => {
//                             var item = $('<div class="notification success"><span>qwgsgsd</span></div>');
//       $("#toastem").prepend($(item));
//       $(item).animate({"right":"12px"}, "fast");
//       setInterval(function(){
//         $(item).animate({"right":"-400px"},function(){
//           $(item).remove();
//         });
//       },10000);
                        // console.log("new_massage");
                        // this.messages.push(data.body)
                    // });


        },
        created: function () {
            var mes = [];
            $.each( this.messages_list, function( key, value ) {
                mes.push(value['message']);
            });    
            this.messages = mes;     
        },
        methods: {
            sendMessage() {
                axios.post('/privat_mess', { body: this.textMessage, room_id: this.published, user: this.user });

                axios.post('/new_massage', { body: this.textMessage, message: this.textMessage, room_id: this.published, two_user: this.two_user });

                this.messages.push(this.textMessage);

                this.textMessage = "";
            }
        }        
    }
</script>
