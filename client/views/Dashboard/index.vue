<template>
    <div>


<router-link :to="{path: '/items/add'}">
  <el-button>Добавить</el-button>
</router-link>


<div style="margin-top: 15px;">
  <el-input placeholder="Please input" v-model="input5" class="input-with-select">
    <el-button slot="append">Найти</el-button>
  </el-input>
</div>

    
    <span v-loading="loading"></span>

    <el-card class="box-card" v-for="item in zzzz" :key="item">
    <div slot="header" class="clearfix">
        <span>{{item.items_name}}</span>
        <el-button style="float: right; padding: 3px 0" type="button">В список</el-button>
    </div>
    <div class="text item">
        <span class="badge badge-success">мин.:{{item.min_itemprice_price}}</span>
        <span class="badge badge-danger">макс.:{{item.max_itemprice_price}}</span>
        <span class="badge badge-primary">макс.:{{item.max_itemprice_price}}</span>
    </div>
    </el-card>





    </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Dash333board',
  components: {},
data() {
      return {
        loading:false,
        selected:1,
        test: '',
        zzzz: [],
        errors:[],
        columns: [
            { label: 'Имя', field: 'items_name',filterable: true, },                        
            { label: 'мин.', field: 'min_itemprice_price', filterable: false, },
            { label: 'макс.', field: 'max_itemprice_price', filterable: false, },
            { label: 'pcs', field: 'items_pcs',filterable: false, },
            { label: 'р./ед.', field: 'pcs_price', filterable: false, },
            { label: 'Где', field: 'shop_name', filterable: false, },
            { label: ''},

          ],
                  
    }},
    created: function () {
        this.getDefaultList();
        this.selected = 1;
    },
    methods: {
        getDefaultList() {
            this.loading = true;
            //this.options.texts = this.$store.getters.getState.texts;
            this.errors.push('get data...');
            axios.get("http://vuetest.vhost20350.cpsite.ru/server_api/api.php")
                .then(response => {
                this.zzzz = response.data.items;
                console.log(response.data.items);
                this.loading = false;
                })
                .catch(e => {
                this.errors.push(e);
                this.loading = false;
                });
        }

  }





}
</script>
