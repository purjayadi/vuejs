
<template>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="block-header">
      <router-link :to="{name: 'indexCompany'}" class="btn btn-warning waves-effect"><i class="material-icons">keyboard_backspace</i><span>BACK</span></router-link>
    </div>
    <div class="card">
      <div class="header">
        <h2>
           Form Company
        </h2>
      </div>
      <div class="body">
        <form v-on:submit.prevent="saveForm()">
          <label for="email_address">Name</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" name="name" v-model="company.name" class="form-control" placeholder="name">
              <span v-if="errors.name" class="label label-danger">{{ errors.name[0] }}</span>
            </div>
          </div>
          <label for="email_address">Address</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" name="address" v-model="company.address" class="form-control" placeholder="Enter your address">
              <span v-if="errors.address" class="label label-danger">{{ errors.address[0] }}</span>
            </div>
          </div>
          <label for="email_address">Website</label>
          <div class="form-group">
            <div class="form-line">
              <input type="url" name="website" v-model="company.website" class="form-control" placeholder="url">
              <span v-if="errors.website" class="label label-danger">{{ errors.website[0] }}</span>
            </div>
          </div>
          <label for="email_address">Email</label>
          <div class="form-group">
            <div class="form-line">
              <input type="email" name="email" v-model="company.email" class="form-control" placeholder="email">
              <span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
            </div>
          </div>
          <button class="btn btn-danger waves-effect" id="btnSimpancompany" type="submit"><i class="material-icons">save</i><span>SUBMIT</span></button>
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
      url: window.location.origin + window.location.pathname,
      company: {
        name: '',
        jenis: ''
      },
      message: '',
      settings: {
        placeholder: 'Pilih Jenis Perusahaan'
      }
    }
  },
  methods: {
    saveForm() {
      var app = this;
      var newCompany = app.company;
      axios.post(app.url, newCompany)
        .then(function(resp) {
          app.message = 'Sukses : Berhasil Menambah company ' + app.company.name;
          app.company.address;
          app.company.website;
          app.company.email;
          app.alert(app.message);
          app.company.name = ''
          app.company.address = ''
          app.company.website = ''
          app.company.email = ''
          app.errors = '';
          app.$router.replace('/');

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
    }

  }
}
</script>
