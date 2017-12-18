
<template>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="block-header">
      <router-link :to="{name: 'indexHalaman'}" class="btn btn-warning waves-effect"><i class="material-icons">keyboard_backspace</i><span>BACK</span></router-link>
    </div>
    <div class="card">
      <div class="header">
        <h2>
           Form Halaman
        </h2>
      </div>
      <div class="body">
        <form v-on:submit.prevent="saveForm()">
          <label for="email_address">Judul</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" name="judul" v-model="halaman.judul" class="form-control" placeholder="judul">
              <span v-if="errors.judul" class="label label-danger">{{ errors.judul[0] }}</span>
            </div>
          </div>
          <label for="email_address">Deskripsi</label>
          <div class="form-group">
            <div class="form-line">
              <ckeditor v-model="halaman.isi" id="test"></ckeditor>
              <span v-if="errors.isi" class="label label-danger">{{ errors.isi[0] }}</span>
            </div>
          </div>
          <label for="email_address">Meta Deskripsi</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" name="meta" v-model="halaman.meta" class="form-control" placeholder="Enter your meta description">
              <span v-if="errors.meta" class="label label-danger">{{ errors.meta[0] }}</span>
            </div>
          </div>
          <button class="btn btn-danger waves-effect" id="btnSimpanhalaman" type="submit"><i class="material-icons">save</i><span>SUBMIT</span></button>
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
      halaman: {
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
      var newHalaman = app.halaman;
      axios.post(app.url, newHalaman)
        .then(function(resp) {
          app.message = 'Sukses : Berhasil Menambah halaman ' + app.halaman.judul;
          app.halaman.judul;
          app.halaman.isi;
          app.alert(app.message);
          app.halaman.judul = ''
          app.errors = '';
          app.$router.replace('/a');

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
