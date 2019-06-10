<template>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-8" style="border-right: solid black 1px;">
                <textarea class="form-control" rows="10" readonly="">{{messages.join('\n')}}</textarea>
                <hr>
                <input placeholder="Message....." type="text" class="form-control" v-model='textMessage' @keyup.enter="sendMessage">
            </div>
            <div class="col-sm-4">
                <div class="text-center">
                    <h3>Поиск людей</h3>
                    <input placeholder="Ваш друг" type="text" class="form-control" v-model='namePeople' @keyup.enter="searchPeople">
                    <br>
                    <ul v-if="peoples.length > 0" class="list-group text-left">
                        <li v-for="(people, key) in peoples" class="list-group-item d-flex justify-content-between align-items-left">
                            {{people.name}}
                            <span class="badge badge-primary badge-pill" data-toggle="modal" data-target="#exampleModal" v-on:click="showModal(key)">отправить письмо</span>
                        </li>
                    </ul>  
                </div>                
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Отправьте письмо ваши друзьям
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h4>                        
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" rows="10" v-model='textMail'></textarea>
                        <br>
                        <input placeholder="Ваша почта" type="text" class="form-control" v-model='emailMail'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" v-on:click="SendMail()">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style type="text/css">
    .list-group{
        max-height: 200px;
        margin-bottom: 10px;
        overflow-y:scroll;
        -webkit-overflow-scrolling: touch;
    }

    .badge {
        cursor: pointer;
    }
</style>

<script>
    export default {
        data() {
            return {
                messages: [],
                textMessage: '',
                peoples: [],
                namePeople: '',
                modalKEY: '',
                textMail: '',
                emailMail: ''
            }
        },
        mounted() {
            window.Echo.channel('chats')
                    .listen('Message', ({message}) => {
                        this.messages.push(message.body)
                    });
        },
        methods: {
            sendMessage() {
                axios.post('/messages', { body: this.textMessage });

                this.messages.push(this.textMessage);

                this.textMessage = "";
            },

            searchPeople() {
                if(this.namePeople != "" && this.namePeople.length > 4) {
                    axios.post('/serchByEmail', { email: this.namePeople})
                    .then(respons => {
                        this.peoples = respons.data
                    });
                }
            },

            showModal(key) {
                this.modalKEY = key;
            },

            SendMail() {
                axios.post('/sendMail', { emailTO:this.peoples[this.modalKEY].email, message:this.textMail, emailMail:this.emailMail })
                .then(respons => {
                    $('#exampleModal').modal('hide');
                });
            }
        }        
    }
</script>
