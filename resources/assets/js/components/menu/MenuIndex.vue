<template>
<div class="row clearfix">
  <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
    <div class="block-header">
      <router-link :to="{ name: 'createMenu'}" class="btn btn-danger waves-effect"><i class="material-icons">library_add</i><span>CREATE MENU</span></router-link>
    </div>
    <div class="card">
      <div class="header">
        <h2>Menu</h2>
        <ul class="header-dropdown m-r--5">
          <div class="form-group form-float">
            <div class="form-line">
            <input type="text" class="form-control" name="pencarian" placeholder="Pencarian" v-model="pencarian">
          </div>
          </div>
        </ul>
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Parent</th>
              <th>Name</th>
              <th>order</th>
              <th>Link</th>
              <th width="130px">Aksi</th>
            </tr>
          </thead>
          <tbody v-if="menus.length" class="data-ada">
            <tr v-for="menu, index in menus">
              <td>{{menu.parent}}</td>
              <td>{{menu.name}}</td>
              <td>{{menu.order}}</td>
              <td>{{menu.link}}</td>
              <td width="130px">
                <router-link :to="{ name: 'editMenu', params: {id: menu.id} }" class="btn btn-xs btn-warning" :id="'edit-'+menu.id"><i class="material-icons">edit</i></router-link>
                <a href="#" class="btn btn-xs btn-danger" v-bind:id="'delete-' + menu.id" v-on:click="deleteMenu(menu.id, index,menu.name)">
                            <i class="material-icons">delete_sweep</i>
                        </a>
              </td>
            </tr>
          </tbody>
          <tbody class="data-tidak-ada" v-else>
            <tr>
              <td colspan="5" class="text-center">Tidak Ada Data</td>
            </tr>
          </tbody>
        </table>
      </div>
      <vue-simple-spinner v-if="loading"></vue-simple-spinner>
      <div class="body" align="right">
        <vue-pagination :data="menusData" v-on:pagination-change-page="getMenus" :limit="3"></vue-pagination>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data: function () {
    return {
      menus: [],
      menusData: {},
      url : window.location.origin + window.location.pathname,
      loading: true,
      pencarian: ''
    }
  },
  mounted() {
    //do something after mounting vue instance
    var app = this;
    app.getMenus();
  },
  watch: {
        // whenever question changes, this function will run
        pencarian: function (q) {
          if (q != '') {
            this.searchMenu()
          }
          else {
            this.getMenus()
          }

        }
      },
  methods: {
    getMenus(page) {
      var app = this;
      if (typeof page === 'undefined'){
        page = 1;
      }
      axios.get(app.url+'/show-all?page='+page)
      .then(function (resp){
        app.menus = resp.data.data;
        app.menusData = resp.data;
        app.loading = false;
      })
      .catch(function (resp){
        console.log(resp);
        app.loading = false;
        alert("Could not load menu");
      });
    },
    searchMenu(page){
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }
      axios.get(app.url+'/search?q='+app.pencarian+'&page='+page)
      .then(function (resp) {
        app.menus = resp.data;
        app.menusData = [];
      })
      .catch(function (resp) {
        console.log(resp);
        alert("Could not load menu");
      });
    },
    alert(pesan){
      this.$swal({
        title: "Berhasil Menghapus Menu !",
        text: pesan,
        icon:"success",
      });
    },
    deleteMenu(id, index,name){
      if(confirm("Yakin Ingin Menghapus Halaman "+name+" ?")){
        var app = this;
        axios.delete(app.url+'/' +id)
        .then(function (resp) {
          app.getMenus();
          app.alert("Berhasil Menghapus Menu "+ name)
          app.$router.replace('/b');
        })
        .catch(function (resp){
          alert("Could not delete menu");
        });
      }
    }
  }

}
</script>
