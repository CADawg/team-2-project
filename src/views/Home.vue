<template>
    <div>
        <div class="mainClosed">
            <h1>This site is under <br/> construction</h1>
        </div>
        <div class="main">
            <sidebar-menu :menu="menu" width="200px" collapsed @item-click="onItemClick" id="sidenav">
                <span slot="toggle-icon">  <i class="material-icons">dehaze</i></span>
            </sidebar-menu>

            <div class="header">
                <img src="../assets/mini-logoL.png" class="logo"/>
                <button class="upload" @click="upload" v-if="this.role == 'Department Head'">Upload</button>
                <button class="notBell" @click="change('Chat')"><i class="fas fa-bell"></i></button>
                <div class="dropdown" >
                    <button class="dropbtn"><i class="fas fa-user-circle"></i> </button>
                    <div class="dropdown-content">
                        <a href="/dash">{{ role }}</a>
                        <a @click="logout">Log out</a>
                    </div>
                </div> 
            </div> 
            <div class="headerLower" v-if="currentTabComponent == 'Depdash' || currentTabComponent == 'CEOdash' || currentTabComponent == 'Teamdash'">
                <div class="lowerGrid">
                   <div><i class="fas fa-thumbs-up Green"></i><p>This is on target</p></div>
                   <div><i class="fas fa-exclamation-triangle Amber"></i><p>This requires attention</p></div>
                   <div><i class="fas fa-thumbs-down Red"></i><p>This is not on target</p></div>
                </div>
            </div> 
            <div class="body">
                <transition name="component-fade" mode="out-in">
                    <component id="displayPage" class="displayPage" :is="currentTabComponent"></component>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import firebase from "firebase";
import db from "../firebase/init";


import Dashboard from "@/components/Dashboard";
import Calendar from "@/components/Calender";
import Chat from "@/components/Messaging/Chat";
import ContactList from "@/components/ContactList";
import CEOdash from "@/components/CEOdash";
import Depdash from "@/components/Depdash";
import Teamdash from '@/components/Teamdash';
import Upload from '@/components/Upload';
import Help1 from '../components/Help';
import Admin from '../components/Admin'

import { SidebarMenu } from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
export default {
    name: "Home",
    props: {
        collapsed: {
        type: Boolean,
        default: false
        },
        width: {
        type: String,
        default: '350px'
        },
        widthCollapsed: {
        type: String,
        default: '50px'
        }
    },
    data() {
        return {
            currentTabComponent: "Dashboard",
            menu: [
                {
                    title: "Dashboard",
                    path: "Dashboard",
                    icon: "fas fa-chart-line",
                },
                {
                    title: "Announcements",
                    path: "Chat",
                    icon: "fas fa-comment-dots"
                },
                {
                    title: "People",
                    path: "ContactList",
                    icon: "fas fa-user-friends"
                },
                {
                    title: "Calendar",
                    path: "Calendar",
                    icon: "fas fa-calendar-alt"
                },
                {
                    title: "Help",
                    path: "Help1",
                    icon: "fas fa-question"
                }
            ],

            sidebarStatus: "li",
            role: null,
            user: null
        };
    },
    components: {
        Dashboard,
        Calendar,
        Chat,
        ContactList,
        CEOdash,
        Depdash,
        SidebarMenu,
        Teamdash,
        Upload,
        Help1,
        Admin
    },
    methods: {
        logout() {
            firebase
                .auth()
                .signOut()
                .then(() => {
                    this.$router.push({ path: "/" });
                });
        },
        onItemClick(event, item){
            this.change(item.path)
        },
        change(x) {
            console.log(x)
            this.currentTabComponent = x;
            
        },
        upload(){
            this.currentTabComponent =  "Upload"
        }
    },
    beforeCreate(){
        firebase.auth().onAuthStateChanged((user) => {
            if(user){
                this.user = user.email
                let ref = db.collection("Users").where("email","==",this.user)
                ref.get().then(snapshot => {
                     snapshot.forEach(doc => {
                         this.role = doc.data().role
                         
                        if(this.role == 'CEO'){
                            this.menu[0].path = 'CEOdash'
                            this.currentTabComponent = 'CEOdash'
                        }
                        else if(this.role == 'Department Head'){
                            this.menu[0].path = 'Depdash'
                            this.currentTabComponent = 'Depdash'

                        }
                        else if (this.role == "Team Leader"){
                            this.menu[0].path = 'Teamdash'
                            this.currentTabComponent = 'Teamdash'
                        }
                        else if (this.role == "Admin"){
                            this.menu = []
                            this.currentTabComponent = "Admin"
                        }
                     })
                 })
            }
            else{
                this.user = null
            }
        })
    }
};
</script>

<style>
#sidenav{
    position: fixed;
    height: 110vh;
}
.v-sidebar-menu .vsm--toggle-btn {
    order: -1;
    background: #383D3B;
}
.v-sidebar-menu{
    background: #383D3B;
    position: fixed;
}
.v-sidebar-menu .vsm--mobile-item {
  display: none;
}
.v-sidebar-menu.vsm_collapsed .vsm--link_level-1 .vsm--icon:hover {
    background: #4bcad1
}
.logo{
    width: 100%
}
.logout, .upload, .username {
    position: absolute;
    right: 5%;
    top: 15px;
    background: none;
    border: none
}
.upload{
    right: 20%;
}
.component-fade-enter-active,
.component-fade-leave-active {
    transition: opacity 0.5s ease;
}
.component-fade-enter,
.component-fade-leave-to {
    opacity: 0;
}
.header {
    position: fixed;
    width: 100%;
    z-index: 600;
    height: 44px;
    background-color: #4bcad1;
    border-bottom: 3px solid #4bcad1;
}
.headerLower{
    position: fixed;
    width: 100%;
    z-index: 10;
    height: 52px;
    top: 46px;
    left: 50px;
    background-color: #383D3B;
}
.lowerGrid{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    margin-top: 0.5%;
    margin-left: 6%;
    color: #EEE5E9;
}
.lowerGrid i{
    font-size: 2rem;
}
.lowerGrid p{
    display: inline-block;
    margin-left: 2%;
}
/* main content styles */
.displayPage {
    padding: 60px;
    padding-top: 80px;
    margin-top: 0;
    margin-right: 0;
    padding-right: 0;
    height: 100%;
    z-index: -10;
    width: 87vw;
    margin-left: 5%;

}
.dropdown {
  float: right;
  margin-right: 11%;
  margin-top: -0.6%;
  overflow: hidden;
}
.dropdown .dropbtn, .notBell {
  font-size: 2rem;  
  border: none;
  outline: none;
  color: #383D3B;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #EEE5E9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 9000;
}
.dropdown-content a{
  float: none;
  color: #383D3B;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  cursor: pointer;
}
.dropdown-content a:hover {
  background-color: #D3D1D2;
}
.dropdown:hover .dropdown-content {
  display: block;
}
.notBell{
    position: absolute;
    right: 15%;
    margin-top: -0.6%;
    background: transparent;
}
.logo{
    position: absolute;
    left: 5%;
    top: 17%;
    height: 80%;
    width: 6%;
}
.mainClosed{
    display: none;
}
@media (max-width: 800px)  {
    .logout{
        left: 15%
    }
    .notBell{
        right: 17%;
    }
    .logo{
        left: 7%;
        width: 9%;
    }
    .displayPage{
        padding-right: 50px;
    }
    .upload{
        right: 25%;
    }
}
@media (max-width: 799px){
    .main{
        display: none;
    }
    .mainClosed{
        display: block;
    }
}
</style>
