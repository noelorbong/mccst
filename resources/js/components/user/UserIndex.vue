<template class="vld-parent">
  <div >
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
      :loader="loader"
      :color="loaderColor"
    ></loading>
    <div class="card">
      <div class="card-header">
        User list
        <div style="float:right" class="search-wrapper panel-heading col-sm-4">
          <input class="form-control" type="text" v-model="inputSearchMessage" placeholder="Search" />
        </div>
      </div>
      <div class="card-body" style="padding:0px">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Created At</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in searchResult" :key="user.id">
                <td>
                  <router-link :to="{name: 'userProfile', params: {email: user.email}}">
                    <img
                      :src="'uploads/'+user.photo"
                      style="border-radius: 50%;"
                      height="40"
                      width="40"
                    />
                  </router-link>
                </td>
                <td>{{ user.name }}</td>
                <td>{{ user.number }}</td>
                <td>{{ user.address }}</td>
                <td>{{ user.dob }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>
                <td>
                  <a
                    href="#"
                    class="btn btn-sm btn-danger"
                    v-on:click="deleteEntry(user.id, index)"
                  >
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      inputSearchMessage: "",
      users: [],
      isLoading: false,
      fullPage: true,
      loader: "dots",
      loaderColor: "rgb(255,0,0)"
    };
  },
  created: function() {
    var app = this;
    app.isLoading = true;
    axios
      .get("/user/list")
      .then(function(resp) {
        app.users = resp.data.records;
        app.isLoading = false;
      })
      .catch(function(resp) {
        console.log(resp);
        alert("Could not load users");
        app.isLoading = false;
      });
  },
  computed: {
    searchResult: function() {
      var self = this;
      return this.users.filter(item => {
        return (
          (
            item.name +
            " " +
            item.address +
            " " +
            item.dob +
            " " +
            item.email +
            " " +
            item.created_at
          )
            .toLowerCase()
            .indexOf(this.inputSearchMessage.toLowerCase()) > -1
        );
      });
    }
  },
  methods: {
    deleteEntry(id, index) {
      if (confirm("Do you really want to delete it?")) {
        var app = this;
        axios
          .delete("/user/list/" + id)
          .then(function(resp) {
            app.users.splice(index, 1);
          })
          .catch(function(resp) {
            alert("Could not delete User");
          });
      }
    },
    onCancel() {
      console.log("User cancelled the loader.");
    }
  }
};
</script>
<style lang='scss' scoped>
// .table-responsive {
//   height: 68vh;
//   margin: 0px;
//   padding: 0px;
// }
.table {
  margin: 0px;
  padding: 0px;
  text-align: center;
}
td {
  vertical-align: middle;
  text-align: center;
}
</style>