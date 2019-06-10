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
                                        Список долгов
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                    <li class="nav-item m-tabs__item active">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
                                            Одолжил
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab">
                                            Должен
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_widget4_tab1_content">
                                    <div class="m-widget4 m-widget4--progress">
                                        <div v-for="(pay, key) in debitList">
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--pic">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                                </div>
                                                <div class="m-widget4__info">
                                                    <span class="m-widget4__title">
                                                        {{pay.name}}
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
                                        <div v-for="(pay, key) in creditList">
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--pic">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                                </div>
                                                <div class="m-widget4__info">
                                                    <span class="m-widget4__title">
                                                        {{pay.name}}
                                                    </span>
                                                    <span class="m-widget4__title">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                    </span>
                                                    <span class="m-widget4__title" style="color:red;">
                                                        - {{pay.debit}}
                                                    </span>
                                                    <span class="m-widget4__title">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                    </span>
                                                    <span class="m-widget4__title" style="color:green;">
                                                        + {{pay.credit}}
                                                    </span>
                                                </div>
                                                <div class="m-widget4__progress">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" v-model="listPay[pay.id]" placeholder="Сумма">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-success btn-sm" v-on:click="SetPay(pay.id);">Оплатил</button>
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
        </div>
    </div>
</template>

<script>
    export default {
        props: ['debit','credit'],
        data() {
            return {
                debitList: [],
                creditList: [],
                listPay: [],
            }
        },
        mounted() {   
             
        },
        created: function () {
                this.debitList = this.debit;
                this.creditList = this.credit;
                console.log(this.creditList);
        },
        methods: {

            SetPay(id_request) {
                axios.post('/setCredit', {id_request:id_request, price: this.listPay[id_request]})
                .then(respons => {
                    console.log(respons.data);
                });
            },

        }        
    }
</script>