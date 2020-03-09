<template>
  <div class="Chat">
    <h1>Company Announcements</h1>
    <div class="chatContainer">
      <div class="contacts">
        <ul>
          <li v-for="(contact, index) in contacts" :key="index" class="message">
             <img :src="contact.image" class="smallProfile" />
            <span class="nameText">{{ contact.name }}</span>
          </li>
        </ul>
      </div>
      <div class="currentChat">
        <ul v-chat-scroll>
          <li v-for="(message, index) in messages" :key="index">
            <span>{{ message.name }}:</span>
            <span>{{ message.content }}</span>
            <span class="time">{{ message.timestamp }}</span>
          </li>
        </ul>
        <NewMessage class="msgInput"/>
      </div>
      
    </div>
      
  </div>
</template>

<script>
import db from "../../firebase/init";
import NewMessage from "./NewMessage";
import moment from "moment";
export default {
  name: "Chat",
  data() {
    return {
      messages: [],
      currentChat: "departmentChat",
      contacts: [
        {
          name: "Daniel Mackenzie",
          image:
            "https://www.pngitem.com/pimgs/m/22-223925_female-avatar-female-avatar-no-face-hd-png.png"
        },
        {
          name: "Leanne Watt",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQejcwhuq3EiHISlrbZlw6D9A7vNB_G08uSIPuM3AxasNK0QYAB"
        },
        {
          name: "Jacqui Gellatly",
          image:
            "https://www.pngitem.com/pimgs/m/22-223925_female-avatar-female-avatar-no-face-hd-png.png"
        },
        {
          name: "Pamela Adamiec",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQejcwhuq3EiHISlrbZlw6D9A7vNB_G08uSIPuM3AxasNK0QYAB"
        },
        {
          name: "Noel Thompson",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQejcwhuq3EiHISlrbZlw6D9A7vNB_G08uSIPuM3AxasNK0QYAB"
        },
        {
          name: "Christine Ross",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQejcwhuq3EiHISlrbZlw6D9A7vNB_G08uSIPuM3AxasNK0QYAB"
        },
        {
          name: "Craig Troup",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQejcwhuq3EiHISlrbZlw6D9A7vNB_G08uSIPuM3AxasNK0QYAB"
        },
        {
          name: "Jara Corchero",
          image:
            "https://www.pngitem.com/pimgs/m/22-223925_female-avatar-female-avatar-no-face-hd-png.png"
        },
        {
          name: "Aidan Humpidge",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQejcwhuq3EiHISlrbZlw6D9A7vNB_G08uSIPuM3AxasNK0QYAB"
        },
      ]
    };
  },
  components: {
    NewMessage
  },
  created() {
    let ref = db.collection(this.currentChat).orderBy("timestamp");

    ref.onSnapshot(snapshot => {
      snapshot.docChanges().forEach(change => {
        if (change.type == "added") {
          let doc = change.doc;
          this.messages.push({
            id: doc.id,
            name: doc.data().name,
            content: doc.data().content,
            timestamp: moment(doc.data().timestamp).format("lll")
          });
        }
      });
    });
  },
};
</script>

<style>
.smallProfile {
  border-radius: 50%;
  width: 30%;
  padding: 10%;
}
.Chat {
  margin: 5%;
}
.chatContainer {
  display: grid;
  grid-template-columns: 1fr 4fr;
  border: 4px solid #707070;
}
.contacts ul {
  height: 51vh;
  overflow: scroll;
  background: #eee5e9;
  border-right: 4px solid #707070;
  width: 80%
}
.contacts ul li {
  display: grid;
  grid-template-columns: 50% 40%;
  grid-gap: 20px;
  list-style: none;
  background: #4bcad1;
  border: 2px solid #383d3b;
  padding: 2%;
  width: 110%;
  margin-left: -18%;
  color: #383d3b;
}
.nameText {
  margin-top: 20%;
  margin-left: -90%;
}
.currentChat {
  height: 51vh;
}
.currentChat ul {
  background: #eee5e9;
  height: 40vh;
  overflow: auto;
  
}
ul::-webkit-scrollbar {
  width: 6px;
}
ul::-webkit-scrollbar-track {
  background: #ddd;
}
ul::-webkit-scrollbar-thumb {
  background: #4bcad1;
}
.currentChat ul li {
  list-style-type: none;
  padding: 5px;
}
.time {
  display: block;
  color: #aaa;
  font-size: 0.8rem;
}
.msgInput{

}
</style>
