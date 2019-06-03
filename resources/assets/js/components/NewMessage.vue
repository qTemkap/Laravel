<template>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                messages: [],
                textMessage: '',
                user_ID: ''
            }
        },
        mounted() {
            window.Echo.private('user.'+this.user)
            .listen('NewMessage', ({data}) => {
                var item = $('<div class="notification success"><span class="text-dark">New message</span><br><a href="/room/'+data.room_id+'"><span class="message_new">'+data.body+'</span></a></div>');
                $("#toastem").prepend($(item));
                $(item).animate({"right":"12px"}, "fast");
                setInterval(function(){
                    $(item).animate({"right":"-400px"},function(){
                        $(item).remove();
                    });
                },10000);
            });
        },
         
    }
</script>
