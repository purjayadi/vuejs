<template>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="block-header">
      <router-link :to="{ name: 'indexMenu'}" class="btn btn-warning waves-effect"><i class="material-icons">keyboard_backspace</i><span>BACK</span></router-link>
    </div>
    <div class="card">
      <div class="header">
        <h2>Form Menu</h2>
      </div>
      <div class="body">
        <form v-on:submit.prevent="saveForm">
          <label for="parent">Parent</label>
          <div class="form-group">
            <div class="form-line">
              <select class="form-control show-tick" v-model="selected">
                                        <option value="">-- Please select --</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                    </select>
                            <span v-if="errors.jenis" class="label label-danger">{{ errors.jenis[0] }}</span>
              <span v-if="errors.parent" class="label label-danger">{{errors.parent[0]}}</span>
            </div>
          </div>
          <label for="parent">Name</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" name="name" v-model="menu.name" class="form-control" placeholder="Enter name" required autofocus>
              <span v-if="errors.name" class="label label-danger">{{errors.name[0]}}</span>
            </div>
          </div>
          <label for="parent">Order</label>
          <div class="form-group">
            <div class="form-line">
              <input type="number" name="order" v-model="menu.order" class="form-control" placeholder="order">
              <span v-if="errors.order" class="label label-danger">{{errors.order[0]}}</span>
            </div>
          </div>
          <label for="parent">Link</label>
          <div class="form-group">
            <div class="form-line">
              <input type="url" name="link" v-model="menu.link" class="form-control" placeholder="http://">
              <span v-if="errors.link" class="label label-danger">{{errors.link[0]}}</span>
            </div>
          </div>
          <button type="submit" class="btn btn-danger waves-effect" id="btnSimpanmenu"><i class="material-icons">save</i><span>SUBMIT</span></button>
        </form>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      errors: [],
      menuId: null,
      url: window.location.origin + window.location.pathname,
      menu: {
        name: '',
        parent: ''
      },
      message: '',
      settings: {
        placeholder: 'Pilih'
      }
    }
  },
  mounted() {
    this.getData();
  },
  methods: {
    saveForm() {
      var app = this;
      var newMenu = app.menu;
      axios.patch(app.url + '/' + app.menuId, newMenu)
        .then(function(resp) {
          app.message = 'Sukses : Berhasil Ubah menu ' + app.menu.name;
          app.menu.parent;
          app.menu.order;
          app.menu.link;
          app.alert(app.message);
          app.menu.parent = ''
          app.menu.name = ''
          app.menu.order = ''
          app.menu.link = ''
          app.errors = '';
          app.$router.replace('/b');

        })
        .catch(function(resp) {
          app.success = false;
          app.errors = resp.response.data.errors;
        });
    },
    alert(pesan) {
      this.$swal({
        title: "Berhasil!",
        text: pesan,
        icon: "success",
      });
    },
    getData() {
      let app = this;
      let id = app.$route.params.id;
      app.menuId = id;

      axios.get(app.url + '/' + id + '/edit')
        .then(function(resp) {
          app.menu = resp.data;
        })
        .catch(function() {
          alert("Could not load your halaman")
        });
    }

  }
}
</script>
