<template>
    <div class="Admin">
        <h1>Welcome to the Admin center</h1>
        <h2>Would you like to:</h2> 
        <ul>
            <li><button @click="openResetPassword">Reset a password</button></li>
            <div v-if="showEmailInput == true">
                <input type="text" placeholder="Account email" v-model="inputEmail"/>
                <button @click="resetPassword">Send reset email</button>
                <button @click="cancel2">Close</button>
                </div>
            <!--<li><button @click="deleteAccount">Delete a user's account</button></li>-->
            <li><button @click="openSetup">Setup a new user account</button></li>
            <div v-if="showSetup == true">
                <h1>Set up new account</h1>
                <input type="text" placeholder="New email" v-model="email"/>
                <input type="text" placeholder="New password" v-model="password"/>
                <select v-model="selectedValue">
                    <option value="Admin">Admin</option>
                    <option value="CEO">CEO</option>
                    <option value="Department Head">Department Head</option>
                    <option value="Project Leader">Project Leader</option>
                    <option value="Employee">Employee</option>
                </select>
                <p>Remember that creating a new account will first sign you<br/> into that account so you can ensure it works</p>
                <button @click="newUser">Create new account</button>
                <button @click="cancel">Cancel</button>
            </div>
        </ul>
        <p>{{ feedback }}</p>
    </div>
</template>

<script>
import firebase from "firebase"
import db from "../firebase/init"
export default {
    name: 'Admin',
    data(){
        return{
            inputEmail: null,
            feedback: null,
            showSetup: false,
            showEmailInput: false,
            num: null,
            email: null,
            password: null,
            selectedValue: null
        }
    },
    methods: {
        openSetup(){
            this.showSetup = true
        },
        cancel(){
            this.showSetup = false
        },
        cancel2(){
            this.showEmailInput = false
        },
        openResetPassword(){
            this.showEmailInput = true
        },
        newUser(){
            if(this.email && this.password){
                this.feedback = null
                firebase.auth().createUserWithEmailAndPassword(this.email, this.password).then(cred => {
                     db.collection("Users").add({
                        role: this.selectedValue,
                        email: this.email
                    }).catch(err => {
                        console.log(err)
                    })
                    this.feedback = "Account created"
                    this.email = null
                    this.password = null
                }).catch(err => {
                    this.feedback = err.message
                })
            }
            else{
                this.feedback = "Please fill in both fields"
            }
        },
        resetPassword(){
            if(this.inputEmail){
                this.feedback  = null
                firebase.auth().sendPasswordResetEmail(this.inputEmail).then(cred => {
                    this.feedback = "Email sent to user"
                    this.inputEmail = ""
                })
            }
            else{
                this.feedback = "Please enter an email account you wish to change"
            }
        }
    }
}
</script>

<style>

</style>