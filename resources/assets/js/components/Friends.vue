<template>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Список
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item active">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab" v-on:click="Get_Friends">
                                        Друзья
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab" v-on:click="Get_Request_Out">
                                        Исходящие заявки
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab3_content" role="tab" v-on:click="Get_Request_In">
                                        Входящие заявки
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_widget4_tab1_content">
                                <div class="m-widget4 m-widget4--progress">
                                    <div v-for="(friend, key) in allfriends">
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--pic">
                                                <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    {{friend.name}}
                                                </span>
                                            </div>
                                            <div class="m-widget4__progress">
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a href="#" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
                                                    Удалить
                                                </a>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_widget4_tab2_content">
                                <div class="m-widget4 m-widget4--progress">
                                    <div v-for="(friend, key) in allfriends">
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--pic">
                                                <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    {{friend.name}}
                                                </span>
                                            </div>
                                            <div class="m-widget4__progress">
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a href="#" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
                                                    Отменить
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_widget4_tab3_content">
                                <div class="m-widget4 m-widget4--progress">
                                    <div v-for="(friend, key) in allfriends">
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--pic">
                                                <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    {{friend.name}}
                                                </span>
                                            </div>
                                            <div class="m-widget4__progress">
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a href="#" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
                                                    Отменить
                                                </a>
                                                <a href="#" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary" v-on:click="AddFriend(friend.id_request)">
                                                    Добавить
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>
<script>
    export default {
        props: ['friends'],
        data() {
            return {
                allfriends: [],
            }
        },
        mounted() {
            // window.Echo.private('room.'+this.published)
            //         .listen('PrivateChat', ({data}) => {
            //             this.messages.push(data.body)
            //         });
           
                
             
        },
        created: function () {
                this.allfriends = this.friends;
        },
        methods: {

            Get_Friends() {
                axios.post('/friends_list', {})
                .then(respons => {
                    this.allfriends = respons.data;
                });
            },

            Get_Request_In() {
                axios.post('/request_in', {})
                .then(respons => {
                    this.allfriends = respons.data;
                });
            },

            Get_Request_Out() {
                axios.post('/request_out', {})
                .then(respons => {
                    this.allfriends = respons.data;
                });
            },

            AddFriend(id_request) {
                axios.post('/acceptFriend', {id_request: id_request})
                .then(respons => {
                    this.allfriends = respons.data;
                });
            }

        }        
    }
</script>