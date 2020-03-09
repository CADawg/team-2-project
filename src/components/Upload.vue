<template>
  <div class="Upload">
    <h1 style="color:Red; padding:0; margin:0; margin-top:5%;">Remember only upload the correct time file here</h1>
    <div class="uploadPanel">
      <input class="xlUpload" type="file" id="selectFiles" />
      <div class="icons">
        <i class="fas fa-upload"></i>
        <p>Drag and drop here <br/>Or click to browse</p>
      </div>
    </div>
     <button class="uploadBtn" @click="loadFile">Upload</button>
  </div>
</template>

<script>
import db from "../firebase2/init";
import XLSX  from "xlsx"
export default {
  name: "Upload",
  data() {
    return {

    };
  },
  methods: {
    loadFile() {
        var files = document.getElementById("selectFiles").files;
        var result = {};
    
        var fr = new FileReader();
        fr.onload = function(e) {
            
        var file = new Uint8Array(e.target.result);
        var workbook = XLSX.read(file, {type: 'array'});
        for (var sheet of workbook.SheetNames){
            var ws = workbook.Sheets[sheet];
            var data = XLSX.utils.sheet_to_json(ws);
            result[sheet] = data;
        }

        result[sheet].forEach(obj => {
          db.collection("timesheetTest").doc(obj.teamID).update({
            hours: obj.hours,
            lastUpdate: obj.date,
          })
        })
        };

        fr.readAsArrayBuffer(files.item(0));
    }
  }
};
</script>

<style>
  .Upload{
    text-align: center
  }
  .Upload .uploadPanel{
    margin-top: 10%; 
    margin-left:  auto;
    margin-right: auto;
  }
  .uploadPanel{
    border: 5px solid #383D3B;
    height: 50vh;
    width: 50vw;
    text-align: center
  }
  .xlUpload input{
    display: none;
  }
  .uploadPanel .xlUpload{
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }
  .icons{
    margin-top: -30%;
    color: #383D3B;
    opacity: 0.3;
    padding: 0;
    width: 100%;
    pointer-events: none;
  }
  .icons i{
    font-size: 4rem;
  }
  .uploadBtn{
    margin-top: 2%;
    background: #92DCE5;
    border: none;
    border-radius: 5px;
    padding: 1% 3%;
    font-size: 1.4rem;
    color: #383D3B;
    transition: 0.5s;
  }
  .uploadBtn:hover{
    background: #7DD8E4;
    transition: 0.5s;
  }
  @media(max-width: 800px){
    .icons{
      margin-top: -90%;
    }
  }
</style>
