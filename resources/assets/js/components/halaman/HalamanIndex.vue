<template>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="block-header">
      <router-link :to="{name: 'createHalaman'}" class="btn btn-danger waves-effect"><i class="material-icons">library_add</i><span>CREATE HALAMAN</span></router-link>
    </div>
    <div class="card">

      <div class="header">
        <h2>
            Halaman
        </h2>
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
              <th>Judul</th>
              <th>Slug</th>
              <th width="120px">Aksi</th>
            </tr>
          </thead>
          <tbody v-if="halamen.length" class="data-ada">
            <tr v-for="halaman, index in halamen">

              <td>{{ halaman.judul }}</td>
              <td>{{ halaman.slug }}</td>
              <td width="120px">
                <router-link :to="{name: 'editHalaman', params: {id: halaman.id}}" class="btn btn-xs btn-warning" v-bind:id="'edit-' + halaman.id">
                  <i class="material-icons">edit</i>
                </router-link> <a href="#" class="btn btn-xs btn-danger" v-bind:id="'delete-' + halaman.id" v-on:click="deleteHalaman(halaman.id, index,halaman.name)">
                            <i class="material-icons">delete_sweep</i>
                        </a></td>


            </tr>
          </tbody>
          <tbody class="data-tidak-ada" v-else>
            <tr>
              <td colspan="4" class="text-center">Tidak Ada Data</td>
            </tr>
          </tbody>
        </table>
      </div>
      <vue-simple-spinner v-if="loading"></vue-simple-spinner>
      <div class="body" align="right">
        <vue-pagination :data="halamenData" v-on:pagination-change-page="getHalamen" :limit="3"></vue-pagination>
      </div>

    </div>
  </div>
</div>
</template>

<script>
export default {
  data: function () {
    return {
      halamen: [],
      halamenData: {},
      url : window.location.origin + window.location.pathname,
      loading: true,
      pencarian: ''
    }
  },
  mounted() {
    var app = this;
    app.getHalamen();

  },
  watch: {
        // whenever question changes, this function will run
        pencarian: function (q) {
          if (q != '') {
            this.searchHalaman()
          }
          else {
            this.getHalamen()
          }

        }
      },
      methods: {
        getHalamen(page) {
          var app = this;
          if (typeof page === 'undefined') {
            page = 1;
          }
          axios.get(app.url+'/show-all?page='+page)
          .then(function (resp) {
            app.halamen = resp.data.data;
            app.halamenData = resp.data;
            app.loading = false;
          })
          .catch(function (resp) {
            console.log(resp);
            app.loading = false;
            alert("Could not load halaman");
          });
        },
        searchHalaman(page){
          var app = this;
          if (typeof page === 'undefined') {
            page = 1;
          }
          axios.get(app.url+'/search?q='+app.pencarian+'&page='+page)
          .then(function (resp) {
            app.halamen = resp.data;
            app.halamenData = [];
          })
          .catch(function (resp) {
            console.log(resp);
            alert("Could not load halaman");
          });
        },
         alert(pesan) {
          this.$swal({
            title: "Berhasil Menghapus halaman!",
            text: pesan,
            icon: "success",
          });
        },
         deleteHalaman(id, index,judul) {
          if (confirm("Yakin Ingin Menghapus Halaman "+judul+" ?")) {
            var app = this;
            axios.delete(app.url+'/' + id)
            .then(function (resp) {
              app.getHalamen();
              app.alert("Berhasil Menghapus Halaman "+judul)
            })
            .catch(function (resp) {
              alert("Could not delete halaman");
            });
          }
        }
      }
    }
    </script>
