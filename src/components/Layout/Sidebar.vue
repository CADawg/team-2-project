<template>
  <div class="NavBar">
    <div class="topnav">
      <div class="logo">
        <img src="./../../assets/dark_logo.png" />
      </div>
      <button class="logout" @click="logout">Log out</button>
    </div>
    <div class="Sidebar" id="sidebar">
      <button @click="toggleSidebar" class="hamburger">
        <i class="fas fa-bars"></i>
      </button>
      <ul>
        <li v-for="(link, index) in links" :key="index">
          <router-link :to="link.path">
            <i :class="link.icon"></i>
            <span :class="sidebarStatus">{{ link.name }}</span>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import firebase from "firebase";
import db from "../../firebase/init";
export default {
  name: "Sidebar",
  data() {
    return {
      links: [
        {
          name: "Dashboard",
          path: "dash",
          icon: "fas fa-chart-line"
        },
        {
          name: "Messages",
          path: "Chat",
          icon: "fas fa-comment-dots"
        },
        {
          name: "People",
          path: "contacts",
          icon: "fas fa-user-friends"
        },
        {
          name: "Calendar",
          path: "/calendar",
          icon: "fas fa-calendar-alt"
        },
        {
          name: "Help",
          path: "help",
          icon: "fas fa-question"
        }
      ],
      sidebarStatus: "li"
    };
  },
  methods: {
    toggleSidebar() {
      if (this.sidebarStatus == "li") {
        this.sidebarStatus = "liOpen";
        document.getElementById("sidebar").style.width = "15%";
      } else {
        this.sidebarStatus = "li";
        document.getElementById("sidebar").style.width = "5%";
      }
    },
    logout() {
      firebase
        .auth()
        .signOut()
        .then(() => {
          this.$router.push({ path: "/" });
        });
    }
  }
};
</script>

<style>
.Sidebar {
  background: #383d3b;
  text-align: left;
  width: 5%;
  height: 100%;
  position: fixed;
  top: 8%;
  left: 0;
  transition: 0.5s;
}
.Sidebar ul {
  text-align: left;
}
.Sidebar ul li {
  margin: 0 -20%;
  list-style-type: none;
  text-decoration: none;
}

.Sidebar ul li a {
  list-style-type: none;
  text-decoration: none;
  color: #eee5e9;
  font-size: 1.5rem;
}
.Sidebar ul li a i {
  font-size: 1.7rem;
}
.Sidebar ul li a span {
  padding: 20px;
}

.hamburger {
  background: none;
  border: none;
  font-size: 2rem;
  color: #eee5e9;
}
.li {
  display: none;
}
.liOpen {
  display: inline-block;
}
.topnav {
  background: #4bcad1;
  width: 100vw;
  height: 8vh;
}
.logo img {
  width: 7%;
}
.logout {
  position: absolute;
  right: 2%;
  top: 2.2%;
}
</style>
