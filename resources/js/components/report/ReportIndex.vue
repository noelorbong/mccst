<template>
  <div class="vld-parent">
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
        Report list
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
                <th>Email</th>
                <th>Request</th>
                <th>Quantity</th>
                <th>Location</th>
                <th>Status</th>
                <th>Note</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(report,index) in searchResult" :key="report.id">
                <td>
                  <router-link :to="{name: 'userProfile', params: {email: report.email}}">
                    <img
                      :src="'uploads/'+report.photo"
                      style="border-radius: 50%;"
                      height="40"
                      width="40"
                    />
                  </router-link>
                </td>
                <td>{{ report.name }}</td>
                <td>{{ report.number }}</td>
                <td>{{ report.email }}</td>
                <td>{{ report.title }}</td>
                <td>{{ report.quantity }}</td>
                <td>
                  <a
                    :href="'https://www.google.com.ph/maps/place/'+report.latitude+','+report.longitude"
                    target="_blank"
                  >{{ report.latitude }} , {{ report.longitude }}</a>
                </td>
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
                <td>
                  <a
                    href="#"
                    class="btn btn-sm btn-danger"
                    v-on:click="deleteEntry(report.id, index)"
                  >
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-muted">
        Start Date:
        <input v-model="startdate" type="date" required />
        End Date:
        <input v-model="enddate" type="date" required />
        <button @click="getRecords()" class="btn btn-primary">
          <i class="nav-icon fa fa-hand-o-right"></i> Pick
        </button>
        Count:
        <input
          v-model="reportcount"
          type="number"
          style="width:60px; text-align:center;"
          readonly
        />
        <button @click="printData()" class="btn btn-primary" style="float:right; margin-left:10px;">
          <i class="nav-icon fa fa-clipboard"></i> Print
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      inputSearchMessage: "",
      startdate: "",
      enddate: "",
      reports: [],
      isLoading: false,
      fullPage: true,
      loader: "dots",
      loaderColor: "rgb(255,0,0)",
      reportcount: 0
    };
  },
  created: function() {
    this.getCurrentDate();
  },
  computed: {
    searchResult: function() {
      var self = this;
      return this.reports.filter(item => {
        return (
          (
            item.name +
            " " +
            item.address +
            " " +
            item.title +
            " " +
            item.email +
            " " +
            item.quantity +
            " " +
            item.latitude +
            " " +
            item.admin_note +
            " " +
            item.longitude +
            " " +
            (item.responded == 1 ? "Responded" : "Unresponded") +
            item.created_at
          )
            .toLowerCase()
            .indexOf(this.inputSearchMessage.toLowerCase()) > -1
        );
      });
    }
  },
  methods: {
    getRecords() {
      var app = this;
      app.isLoading = true;
      console.log(app.startdate);
      axios
        .get("/report/list/" + app.startdate + "/" + app.enddate)
        .then(function(resp) {
          app.reports = resp.data.records;
          app.reportcount = app.reports.length;
          app.isLoading = false;
        })
        .catch(function(resp) {
          console.log(resp);
          alert("Could not load users");
          app.isLoading = false;
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
    },
    deleteEntry(id, index) {
      if (confirm("Do you really want to delete it?")) {
        var app = this;
        app.isLoading = true;

        axios
          .delete("/report/list/" + id)
          .then(function(resp) {
            app.isLoading = false;
            app.reports.splice(index, 1);
          })
          .catch(function(resp) {
            app.isLoading = false;
            alert("Could not Report User");
          });
      }
    },
    getCurrentDate() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();

      if (dd < 10) {
        dd = "0" + dd;
      }

      if (mm < 10) {
        mm = "0" + mm;
      }
      today = yyyy + "-" + mm + "-" + dd;
      console.log(today);
      this.startdate = today;
      this.enddate = today;
      this.getRecords();
    },
    onCancel() {
      console.log("User cancelled the loader.");
    },
    printData() {
      window.open(
        "/print/" + this.startdate + "/" + this.enddate,
        "_blank" // <- This is what makes it open in a new window.
      );
    }
  }
};
</script>
<style lang='scss' scoped>
.table-responsive {
  height: 60vh;
  margin: 0px;
  padding: 0px;
}
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