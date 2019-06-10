<template>
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-5">{{info.name_group}}</div>                        
                        <div class="col-sm-3">   
                            <button type="button" v-on:click="toggleDiv()" class="btn btn-success btn-sm">Долги</button>
                            <button type="button" v-on:click="Run()" class="btn btn-success btn-sm">Расчитать</button>
                            <button type="button" v-on:click="" class="btn btn-success btn-sm">Чат</button>
                        </div>     
                        <div class="col-sm-2">   
                            <button type="button" data-toggle="modal" data-target="#usersModal" class="btn btn-success btn-sm">Список участников</button>
                        </div>                         
                        <div class="col-sm-2">                            
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm" v-on:click="GetFriends(info.id)">Добавить участника</button>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div v-if="!showGroup" class="debts">
                    	<div class="row ">
                    		&nbsp;
                    		<div class="col-sm-3 text-center">
                    			Должник
                    		</div>
                    		<div class="col-sm-4 text-center">
                    			Сумма
                    		</div>
                    		<div class="col-sm-4 text-center">
                    			Получатель
                    		</div>
						</div>
                    	<div class="row ">
	                    	<div class="col-sm-12">	                    	
								<ul class="list-group text-center">
									<li class="list-group-item" v-for="(debt, key) in listDebts">
									&nbsp;										
										<div class="col-sm-3 text-center" >
			                    			{{debt.name1}}
			                    		</div>
			                    		<div class="col-sm-4 text-center" style="border-left: solid black 1px;">
			                    			{{debt.debit}}
			                    		</div>
			                    		<div class="col-sm-4 text-center" style="border-left: solid black 1px;">
			                    			{{debt.name2}}
			                    		</div>
									</li>
								</ul>
							</div>
						</div>
                    </div>
                    <div v-if="showGroup" class="group">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-center">Покупки</p>                           
                            </div>
                            <div class="col-sm-4">
                                <p class="text-center">Товары</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8" style="border-right: solid black 1px;">
                                <div class="col-sm-6">
                                    <ul class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action" v-for="(buy, key) in buysList" v-on:click="ShowListProduct(buy.id, key);activeBuy = 'btn'+key; activeProd = ''; GetAllUsers();" :class="{active: activeBuy === 'btn'+key }">{{buy.name_buy}}</a>
                                    </ul>                            
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#buyModal">Добавить покупку</button>
                                </div>
                                <div class="col-sm-6">
                                    <div class="tab-pane " id="list-home" role="" aria-labelledby="list-home-list" v-for="(buy, key) in buysList" v-if="buy.ViewProducts==2">                                        
                                        <ul class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" v-for="(product, keyp) in products_list" v-on:click="activeProd = 'btnBuy'+key+'Prod'+keyp;GetListUsersToProducts(product.id);" :class="{active: activeProd === 'btnBuy'+key+'Prod'+keyp }">
                                                {{product.name_products}} - {{product.price}}
                                                <button type="button" class="btn btn-danger btn-sm float-right">Удалить</button>
                                            </a>                                            
                                        </ul>     
                                        <br>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#productModal">Добавить товар</button>
                                    </div>                            
                                </div>
                            </div>
                            <div class="col-sm-4" style="border-left: solid black 1px;">
                                <div class="tab-pane active" id="m_widget4_tab1_content">
                                    <div class="m-widget4 m-widget4--progress">
                                        <button type="button" class="btn btn-success btn-sm" v-if="activeBuy && !activeProd" v-on:click="SavePrice()">Сохранить</button>
                                        <div v-for="(user, key) in allusers_groupe" v-if="activeBuy && !activeProd">
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--pic">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                                </div>
                                                <div class="m-widget4__info">
                                                    <span class="m-widget4__title">
                                                        {{user.name}}
                                                    </span>
                                                </div>
                                                <div class="m-widget4__progress">
                                                    <div class="">
                                                        <input type="text" class="form-control" v-bind:id="'price'+key" placeholder="Price" v-model="listPrice[key]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-for="(user, key) in users_to_produtcs" v-if="activeProd">
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--pic">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                                </div>
                                                <div class="m-widget4__info">
                                                    <span class="m-widget4__title">
                                                        {{user.name}}
                                                    </span>
                                                </div>
                                                <div class="m-widget4__progress">
                                                </div>
                                                <div class="m-widget4__ext">
                                                    <a href="#" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
                                                        <toggle-button v-if="user.status == 2" v-bind:id="'request'+user.id_products_to_users" :value="false"
                                                            v-on:change="SetStatusProd(user.id_products_to_users, $event);"
                                                           color="#82C7EB"
                                                           :sync="true"
                                                           :labels="true"/>
                                                        <toggle-button v-if="user.status == 1" v-bind:id="'request'+user.id_products_to_users" :value="true"
                                                            v-on:change="SetStatusProd(user.id_products_to_users, $event);"
                                                           color="#82C7EB"
                                                           :sync="true"
                                                           :labels="true"/>
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

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Добавить товар
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>                        
                </div>
                <div class="modal-body">    
                    <div class="row">
                        <input placeholder="Название" type="text" class="form-control" v-model='productName'>
                    </div>   
                    <br> 
                    <div class="row">            
                        <input placeholder="Описание" type="text" class="form-control" v-model='productDesc'>
                    </div>
                    <br>
                    <div class="row">
                        <input placeholder="Цена" type="text" class="form-control" v-model='productPrice'>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" v-on:click="AddProduct(actionBuy, info.id)">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Добавить покупку
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>                        
                </div>
                <div class="modal-body">                    
                        <input placeholder="Название" type="text" class="form-control" v-model='nameBuy'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" v-on:click="AddBuy(info.id)">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Участники группы
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>                        
                </div>
                <div class="modal-body">
                    <div class="tab-pane active" id="m_widget4_tab1_content">
                        <div class="m-widget4 m-widget4--progress">
                            <div v-for="(user, key) in users_groupe">
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            {{user.name}}
                                        </span>
                                    </div>
                                    <div class="m-widget4__progress">
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
                                            <button type="button" class="btn btn-primary" v-on:click="DelOfGroup(user.id_groupe_to_users, key)">Удалить</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Друзья
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>                        
                </div>
                <div class="modal-body">
                    <div class="tab-pane active" id="m_widget4_tab1_content">
                        <div class="m-widget4 m-widget4--progress">
                            <div v-for="(friend, key) in friends">
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
                                            <button type="button" class="btn btn-primary" v-on:click="AddToGroupe(friend.id, info.id, key)" v-if="friend.status_in_groupe==1">Добавить</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<style type="text/css">

</style>

<script>

    export default {   
        props:['group'],  
        data() {
            return {
                showGroup: true,
                info: [],
                friends: [],
                users_groupe: [],
                allusers_groupe: [],
                nameBuy: '',
                buysList: [],
                actionBuy: '',
                actionID: '',
                nextID: 777,
                productName: '',
                productDesc: '',
                productPrice: '',
                products_list: [],
                activeBuy: '',
                activeProd: '',
                actionProd: '',
                users_to_produtcs: [],
                actionCheck: '',
                listPrice: [],
                listDebts: [],
            }
        },
        mounted() {
        },
        created: function () {     
            this.info = this.group;
            this.GetListBuys(this.info.id);
            this.GetUsers(this.info.id);
            //this.GetAllUsers(this.info.id);
        },
        methods: {

            GetFriends(idGroup) {
                axios.post('/friends_list_for_groupe', {idGroup:idGroup})
                .then(respons => {
                    this.friends = respons.data;
                });
            },

            GetUsers: function(idGroup) {
                axios.post('/get_list_for_groupe', {idGroup:idGroup})
                .then(respons => {     
                    this.users_groupe = respons.data;
                });
            },

            GetAllUsers: function() {
                axios.post('/get_alllist_for_groupe', {idGroup:this.info.id, id_buy: this.actionBuy})
                .then(respons => {
                    this.allusers_groupe = respons.data.users;
                    for (var key in this.allusers_groupe) {
                        //console.log(respons.data.price);
                        if(typeof respons.data.price[key] != "undefined")
                            this.listPrice[key] = respons.data.price[key].price;
                        else 
                            this.listPrice[key] = 0;
                    }
                });
            },

            AddToGroupe(idUser, idGroup, id_list) {
                axios.post('/add_to_groupe', {idUser:idUser, idGroup:idGroup})
                .then(respons => {                  
                    this.friends[id_list].status_in_groupe = 2;
                    this.GetUsers(this.info.id);   
                    //this.GetAllUsers(this.info.id);   
                });
            },

            DelOfGroup(id_request, index) {
                axios.post('/del_to_groupe', {id_request:id_request})
                .then(respons => {                  
                    this.users_groupe.splice(index, 1);
                });
            },

            AddBuy(idGroup) {
                axios.post('/addBuy', {idGroup:idGroup, nameBuy:this.nameBuy})
                .then(respons => {            
                    this.GetListBuys(this.info.id);    
                    
                    $('#buyModal').modal('hide');
                });
            },

            GetListBuys: function(idGroup) {
                axios.post('/getListBuys', {idGroup:idGroup})
                .then(respons => {                  
                    this.buysList = respons.data;
                });                
            },

            ShowListProduct(id_buy,index) {
                this.actionBuy = id_buy;
                this.buysList[index].ViewProducts = 2;
                this.actionID=index;
                if(this.nextID!=777 && this.nextID!=index)
                    this.buysList[this.nextID].ViewProducts = 1;
                this.nextID=this.actionID;

                this.GetProductsForBuy(this.info.id, id_buy);
            },

            AddProduct(id_buy, id_group) {
                axios.post('/add_products', {id_buy:id_buy, id_group:id_group, productName: this.productName, productDesc: this.productDesc, productPrice: this.productPrice})
                .then(respons => {                       
                    this.GetProductsForBuy(id_group, id_buy);
                });  
                $('#productModal').modal('hide');
            },

            GetProductsForBuy: function(id_group, id_buy) {
                axios.post('/get_products', {id_buy:id_buy, id_group:id_group})
                .then(respons => {
                    this.products_list = respons.data;
                });  
            },

            GetListUsersToProducts(id_product) {
                axios.post('/get_users_to_products', {id_buy:this.actionBuy, id_group:this.info.id, id_product: id_product})
                .then(respons => {
                    this.users_to_produtcs = respons.data;
                });  
            },

            SetStatusProd(id_request, e) {
                var status;
                if(e.value)
                    status = 1;
                else
                    status = 2;

                axios.post('/setStatusProd', {id_request: id_request, status: status})
                .then(respons => {

                    //this.products_list = respons.data;
                }); 
            },

            SavePrice() {
                var users = [];
                
                for (var key in this.allusers_groupe) {
                    users[this.allusers_groupe[key].id] = this.listPrice[key];
                }

                axios.post('/setPayUsers', {id_buy:this.actionBuy, id_group:this.info.id, users: users})
                .then(respons => {
                }); 
            },

            Run() {
                axios.post('/setPay', {id_group:this.info.id})
                .then(respons => {
                }); 
            }, 

            toggleDiv() {
                if(this.showGroup == true) {
                    axios.post('/getPay', {id_group:this.info.id})
                    .then(respons => {
                        this.listDebts = respons.data;
                        console.log(respons.data);
                    }); 
                    this.showGroup = false;
                } else {
                    this.showGroup = true;
                }
            }

        }        
    }
</script>

