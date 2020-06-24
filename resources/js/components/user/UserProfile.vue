<template>
  <div class="row">
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-header">
          <i class="nav-icon fa fa-user"></i> Profile
        </div>
        <div class="card-body text-center">
          <img class="profile-img" :src="'uploads/'+user.photo" />
          <br />
          <br />
          <span style="font-weight: bold;">User Name:</span>
          {{ user.name}}
          <br />
          <br />
          <span style="font-weight: bold;">Email:</span>
          {{user.email}}
          <br />
          <br />

          <span style="font-weight: bold;">Number:</span>
          {{user.number}}
          <br />
          <br />
          <span style="font-weight: bold;">Address:</span>
          {{ user.address}}
          <br />
          <br />
          <span style="font-weight: bold;">Date Of Birth:</span>
          {{ user.dob}}
          <br />
          <br />
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-8">
      <div class="card">
        <div class="card-header">
          <i class="nav-icon fa fa-list-alt"></i> Reports
        </div>
        <div class="card-body" style="padding:0px">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>Request</th>
                  <th>Quantity</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Note</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(report,index) in reports" :key="report.id">
                  <td>{{ report.title }}</td>
                  <td>{{ report.quantity }}</td>
                  <td>{{ report.latitude }} , {{ report.longitude }}</td>
                  <td>
                    <div
                      v-if="report.responded != 2"
                      id="dropdown"
                      class="dropdown"
                      style="margin-bottom:5px;"
                    >
                      <button
                        class="btn btn-secondary dropdown-toggle"
                        type="button"
                        id="dropdownMenu"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >Status</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a
                          class="dropdown-item"
                          href="#"
                          @click="responded(report.id,0, index)"
                        >Unresponded</a>
                        <a
                          class="dropdown-item"
                          href="#"
                          @click="responded(report.id,1, index)"
                        >Responded</a>
                        <a
                          class="dropdown-item"
                          href="#"
                          @click="responded(report.id,2, index)"
                        >Closed</a>
                      </div>
                    </div>
                    <!-- <select  @change="responded(report.id,$event, index)" >
                    <option value=0 v-if="report.responded === 0" selected>Unresponded</option>
                    <option value=0 v-else >Unresponded</option>
                    <option value=1 v-if="report.responded === 1" selected>Responded</option>
                    <option value=1 v-else >Responded</option>
                    <option value=2 v-if="report.responded === 2" selected>Closed</option>
                    <option value=2 v-else >Closed</option>
                    </select>-->
                    <a
                      v-if="report.responded == 0"
                      class="btn btn-sm btn-warning"
                      v-on:click="responded(report.id,1, index)"
                    >Unresponded</a>
                    <a v-else-if="report.responded == 1" class="btn btn-sm btn-success">Responded</a>
                    <a v-else class="btn btn-sm btn-secondary">Closed</a>
                  </td>
                  <td>{{report.admin_note}}</td>
                  <td>{{ report.created_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    let app = this;
    let id = app.$route.params.email;
    app.userId = id;
    axios
      .get("/user/profile/" + id)
      .then(function(resp) {
        app.user = resp.data.user;
        app.reports = resp.data.records;
      })
      .catch(function() {
        alert("Could not load your profile");
      });
  },
  data: function() {
    return {
      userId: null,
      reports: [],
      user: {
        id: null,
        name: "",
        address: "",
        dob: "",
        photo: "default.png",
        email: "",
        password: "",
        created_at: "",
        updated_at: ""
      }
    };
  },
  methods: {
    saveForm() {
      event.preventDefault();
      var app = this;
      var newCompany = app.company;
      axios
        .patch("/api/companies/" + app.companyId, newCompany)
        .then(function(resp) {
          app.$router.replace("/");
        })
        .catch(function(resp) {
          console.log(resp);
          alert("Could not create your company");
        });
    },
    responded(id, status, index) {
      // var status = event.target.value;
      var consceice = "Do you really want to Respond it?";
      if (status == 1) {
        consceice = "Do you really want to Respond it?";
      } else if (status == 2) {
        consceice = "Do you really want to Close it?";
      } else {
        consceice = "Do you really want to Unrespond it?";
      }
      var app = this;
      if (status == 2) {
        var Note = prompt("Please Drop a Note", "");
        if (Note != null) {
          app.sendRequest(id, status, index, Note);
        }
      } else {
        if (confirm(consceice)) {
          app.sendRequest(id, status, index, "");
        }
      }
    },
    sendRequest(id, status, index, note) {
      var app = this;
      var url = "/report/responded/" + id + "/" + status;
      if (status == 2) {
        url = "/report/responded/" + id + "/" + status + "/" + note;
      }
      app.isLoading = true;

      axios
        .put(url)
        .then(function(resp) {
          app.reports[index].responded = status;
          app.reports[index].admin_note = note;
          app.isLoading = false;
        })
        .catch(function(resp) {
          alert("Could not Change status");
          app.isLoading = false;
        });
    }
  }
};
</script>
<style type="text/css">
.profile-img {
  max-width: 150px;
  border: 5px solid #fff;
  border-radius: 100%;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
}
</style>