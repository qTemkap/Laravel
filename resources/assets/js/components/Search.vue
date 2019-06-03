<template>
    <div class="container">       
        <hr>    
        <div class="row justify-content-center">     
            <div class="card-body row no-gutters align-items-center">
                <div class="col-lg-10">
                    <input class="form-control form-control-lg form-control-borderless" v-model='textName' type="search" placeholder="Search topics or keywords" @keyup.enter="searchFriend">
                </div>
                <div class="col-lg-12" id="people">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="people-nearby">                              
                                <div v-for="(user, key) in allusers" class="nearby-user">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" class="profile-photo-lg">
                                        </div>
                                        <div class="col-md-7 col-sm-7">
                                            <h5><a :href='"user/"+user.id' class="profile-link">{{user.name}}</a></h5>
                                        </div>
                                        <div class="col-md-3 col-sm-3" v-if="!user.status">
                                            <button class="btn btn-primary pull-right" id="add_friend" v-on:click="addFriend(user.id, key)">Add Friend</button>
                                        </div>                                        
                                        <!-- <div class="col-md-3 col-sm-3" v-if="(user.status == '1' && user.friend_one == userAuth)">
                                            <button class="btn btn-primary pull-right" title="Cancel request">Sent request</button>
                                        </div>
                                        <div class="col-md-3 col-sm-3" v-if="(user.status == '1' && user.friend_two == userAuth)">
                                            <button class="btn btn-primary pull-right" title="Cancel request">Request incoming</button>
                                        </div> -->
                                        <div class="col-md-3 col-sm-3" v-if="user.status == '1'">
                                            <button class="btn btn-primary pull-right" v-on:click="deleteRequest(user.id, key)" title="Cancel request">Request</button>
                                        </div>
                                        <div class="col-md-3 col-sm-3" v-on:click="delFriend(user.id, key)" v-if="user.status == '2'">
                                            <button class="btn btn-primary pull-right">Friend</button>
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
        props: ['user','users'],
        data() {
            return {
                textName: '',
                allusers: [],
                userAuth: this.user,
            }
        },
        mounted() {          
        },
        created: function () {
            this.allusers = this.users;                    
        },
        methods: {   

            changeStatus() {

            },    

            addFriend(id, key) {
                axios.post('/addToFriend', { id:id })
                .then(respons => {
                    this.allusers[key].status = 1;
                });
            },

            delFriend(id, key) {
                axios.post('/delFriend', { id:id })
                .then(respons => {
                    this.allusers[key].status = 1;
                });
            },

            deleteRequest(id, key) {
                axios.post('/deleteRequest', { id:id })
                .then(respons => {
                    this.allusers[key].status = "";
                });
            },

            searchFriend() {
                axios.post('/search_people', { name:this.textName })
                .then(respons => {
                    this.allusers = respons.data;
                });
            }
        }        
    }
</script>