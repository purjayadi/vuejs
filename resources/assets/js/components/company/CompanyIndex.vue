<template>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="block-header">
      <router-link :to="{name: 'createCompany'}" class="btn btn-danger waves-effect"><i class="material-icons">library_add</i><span>CREATE COMPANY</span></router-link>
    </div>
    <div class="card">

      <div class="header">
        <h2>
            Company
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
              <th>Name</th>
              <th>Address</th>
              <th>Website</th>
              <th>Email</th>
              <th width="130px">Aksi</th>
            </tr>
          </thead>
          <tbody v-if="companies.length" class="data-ada">
            <tr v-for="company, index in companies">

              <td>{{ company.name }}</td>
              <td>{{ company.address }}</td>
              <td>{{ company.website }}</td>
              <td>{{ company.email }}</td>
              <td width="130px">
                <router-link :to="{name: 'editCompany', params: {id: company.id}}" class="btn btn-xs btn-warning" v-bind:id="'edit-' + company.id">
                  <i class="material-icons">edit</i>
                </router-link> <a href="#" class="btn btn-xs btn-danger" v-bind:id="'delete-' + company.id" v-on:click="deleteCompany(company.id, index,company.name)">
                            <i class="material-icons">delete_sweep</i>
                        </a></td>


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
        <vue-pagination :data="companiesData" v-on:pagination-change-page="getCompanies" :limit="3"></vue-pagination>
      </div>

    </div>
  </div>
</div>
</template>

<script>
export default {
  data: function () {
    return {
      companies: [],
      companiesData: {},
      url : window.location.origin + window.location.pathname,
      loading: true,
      pencarian: ''
    }
  },
  mounted() {
    var app = this;
    app.getCompanies();

  },
  watch: {
        // whenever question changes, this function will run
        pencarian: function (q) {
          if (q != '') {
            this.searchCompany()
          }
          else {
            this.getCompanies()
          }

        }
      },
      methods: {
        getCompanies(page) {
          var app = this;
          if (typeof page === 'undefined') {
            page = 1;
          }
          axios.get(app.url+'/show-all?page='+page)
          .then(function (resp) {
            app.companies = resp.data.data;
            app.companiesData = resp.data;
            app.loading = false;
          })
          .catch(function (resp) {
            console.log(resp);
            app.loading = false;
            alert("Could not load companies");
          });
        },
        searchCompany(page){
          var app = this;
          if (typeof page === 'undefined') {
            page = 1;
          }
          axios.get(app.url+'/search?q='+app.pencarian+'&page='+page)
          .then(function (resp) {
            app.companies = resp.data;
            app.companiesData = [];
          })
          .catch(function (resp) {
            console.log(resp);
            alert("Could not load Company");
          });
        },
         alert(pesan) {
          this.$swal({
            title: "Berhasil Menghapus Company!",
            text: pesan,
            icon: "success",
          });
        },
         deleteCompany(id, index,name) {
          if (confirm("Yakin Ingin Menghapus Company "+name+" ?")) {
            var app = this;
            axios.delete(app.url+'/' + id)
            .then(function (resp) {
              app.getCompanies();
              app.alert("Berhasil Menghapus Company "+name)
            })
            .catch(function (resp) {
              alert("Could not delete company");
            });
          }
        }
      }
    }
    </script>
