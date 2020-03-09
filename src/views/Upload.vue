<template>
  <div class="upload">
    <input type="file" id="selectFiles" />
    <button @click="loadFile">Upload</button>
  </div>
</template>

<script>
import JQuery from "jquery";
import db from "../firebase2/init";
export default {
  name: "Upload",
  data() {
    return {
      data: [],
      data3: []
    };
  },
  methods: {
    loadFile() {
      var files = document.getElementById("selectFiles").files;

      var fr = new FileReader();
      fr.onload = function(e) {
        var result = JSON.parse(e.target.result);
        this.data3 = result;
        //console.log(this.data3[3].Bill);
        this.data3.forEach(obj => {
          db.collection("assignments").add({
            assignmentID: obj.AssignmentID,
            employeeID: obj.EmployeeID,
            contractID: obj.ContractID,
            startDate: obj.StartDate,
            endDate: obj.EndDate,
            expectedHours: obj.ExpectedHours,
            role: obj.Role
          });
        });
      };

      fr.readAsText(files.item(0));

      // this.data3.forEach(obj => {
      //   db.collection("holidays").add({
      //     holidayID: obj.
      //})
      //})
    }
  },
  created() {
    db.collection("staff")
      .get()
      .then(snapshot => {
        snapshot.forEach(doc => {
          this.data.push(doc.data());
        });
      });
  }
};
</script>

<style></style>
