<template>
  <div class="newMessage">
    <form @submit.prevent="addMessage">
      <label for="newMessage">New Message (Enter to add)</label>
      <input
        type="text"
        name="newMessage"
        v-model="newMessage"
        autocomplete="off"
        placeholder="message..."
      />
    </form>
    <p class="red-text">{{ feedback }}</p>
  </div>
</template>

<script>
import db from "../../firebase/init";
import firebase from 'firebase'
export default {
  name: "NewMessage",
  props: ["name"],
  data() {
    return {
      newMessage: null,
      feedback: null,
      currentChat: "departmentChat",
      user: null,
      roloe: null,
    };
  },
  methods: {
    addMessage() {
      if (this.newMessage) {
        this.feedback = null;
        let path = this.currentChat;
        db.collection(path)
          .add({
            content: this.newMessage,
            name: this.user,
            timestamp: Date.now()
          })
          .catch(err => {
            console.log(err);
          });
        this.newMessage = null;
      } else {
        this.feedback = "You must enter a message in order to send one";
      }
    }
  },
  beforeCreate(){
        var user = firebase.auth().currentUser
            if(user){
                this.user = user.email
                let ref = db.collection("Users").where("email","==",this.user)
                ref.get().then(snapshot => {
                     snapshot.forEach(doc => {
                         this.role = doc.data().role
                         console.log(this.role)
                        if(this.role == 'CEO'){
                            this.user = "Jara"
                        }
                        else if(this.role == 'Department Head'){
                            this.user = "Aidan"

                        }
                        else if (this.role == "Team Leader"){
                            this.user = "Craig"
                        }
                     })
                 })
            }
            else{
                this.user = null
            }
    }
};
</script>

<style>
.newMessage label {
  padding-left: 5%;
}
.newMessage input {
  background: none;
  border: none;
  border-bottom: 2px solid #383d3b;
  padding: 5px;
  font-size: 1.3rem;
  width: 90%;
  margin-left: 5%;
}
</style>
