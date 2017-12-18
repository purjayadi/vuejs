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
        <form v-on:submit.prevent="saveForm()">
          <label for="parent">Parent</label>
          <div class="form-group">
            <div class="form-line">
              <multiselect
                  v-model="menu.parent.id"
                  :options="menus"
                  placeholder="Select one"
                  label="name"
                  track-by="id"
                  >
              </multiselect>
              <!-- <pre class="language-json"><code name="parent">{{ menu.parent }}</code></pre> -->
              <span v-if="errors.parent" class="label label-danger">{{errors.parent[0]}}</span>
            </div>
          </div>
          <label for="parent">Name</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text"  v-model="menu.name" class="form-control" placeholder="Enter name" required autofocus>
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
import Multiselect from 'vue-multiselect'

export default {
  components: {
    Multiselect
  },
  data: function(){
    return {
      errors: [],
      url: window.location.origin + window.location.pathname,
      menus: [],
      menu: {
        name: '',
        parent: ''
      }
    }
  },
  mounted() { // when the Vue app is booted up, this is run automatically.
     axios.get('getmenu')
    .then((response)=>{
        this.menus = response.data;
    })
  },
  methods: {
    saveForm() {
      var app = this;
      var newMenu = app.menu;
      axios.post(app.url, newMenu)
      .then(function(resp){
        app.message = 'Sukses : Berhasil Menambah Menu' +
        app.menu.name;
        app.alert(app.message);
        app.errors ='';
        app.$router.replace('/b');
      })
      .catch(function (resp){
        app.success = false;
        app.errors = resp.response.data.errors;
      });
    },
    alert(pesan){
      this.$swal({
        title: "Berhasil !",
        text: pesan,
        icon: "success",
      });
    }

  }
}

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
