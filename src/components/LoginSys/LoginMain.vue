<template>
  <div class="LoginMain">
    <div class="sidebarImage">
      <!-- <img src="./../../assets/bg.jpg" />-->
    </div>
    <div class="inputBar">
      <!--<img src="././../../assets/dark_logo.png" />-->
      <br />
      <p class="err">{{ feedback }}</p>
      <!--Email Form-->
      <transition name="slide-fade" mode="out-in">
        <div v-if="emailLogin == true" key="email">
          <p class="heading2">Welcome back! Please login to your account.</p>
          <input
            type="text"
            placeholder="Email"
            class="inputField"
            v-model="email"
          />
          <br />
          <input
            type="password"
            placeholder="Password"
            class="inputField"
            v-model="password"
          />
          <br />
          <button @click="forgotPasswordForm" class="plainBtn">
            Forgot Password
          </button>
          <br />
          <button class="loginBtn" @click="nextStage">{{ btnText }}</button>
        </div>
        <!--Phone number Form-->
        <div v-if="phoneAuth == true" key="phone">
          <p class="heading2">Please enter your phone number below.</p>
          <input
            type="text"
            placeholder="Your phone number"
            class="inputField"
            v-model="phNo"
          />
          <br />
          <button class="loginBtn" @click="nextStage">{{ btnText }}</button>
        </div>

        <!--Phone code Form-->
        <div v-if="phoneCode == true" key="verify">
          <p class="heading2">
            You should receive a verification code via SMS.
            <br />Please enter the code below
          </p>
          <input
            type="text"
            placeholder="Verification number"
            class="inputField"
            v-model="otp"
          />
          <br />
          <button class="loginBtn" @click="nextStage">{{ btnText }}</button>
        </div>

        <!--Password reset Form-->
        <div v-if="passwordResetForm == true">
          <p class="heading2">
            Enter your email and we will send you a password reset link.
          </p>
          <input
            type="text"
            placeholder="Email"
            class="inputField"
            v-model="email"
          />
          <br />
          <button class="loginBtn" @click="nextStage">{{ btnText }}</button>
        </div>
      </transition>
      <div id="recaptcha-container"></div>
    </div>
  </div>
</template>

<script>
import firebase from "firebase";
import db from "./../firebase/init";
export default {
  name: "LoginMain",
  data() {
    return {
      btnText: "Login",
      emailLogin: true, //show the email fomr
      phoneAuth: false, //show the phone form
      phoneCode: false, //show the code form
      passwordResetForm: false, //show the password reset form
      email: null, //email model
      password: null, //password model
      feedback: null, //feedback to show error messages
      appVerifier: "", //app verifcation
      otp: "", //code model
      phNo: "" //phone nubmer model
    };
  },
  methods: {
    //Change the form that is displayed and the text in the button or login into
    nextStage() {
      if (this.emailLogin == true) {
        this.login();
      } else if (this.phoneAuth == true) {
        //If the phone is currently being verifed and the button is clicked
        this.btnText = "Submit";
        this.sendOtp();
      } else if (this.phoneCode == true) {
        this.verifyOtp();
      } else if (this.passwordResetForm == true) {
        this.forgotPassword();
      }
    },
    //Open password reset form
    forgotPasswordForm() {
      (this.emailLogin = false), (this.passwordResetForm = true);
      this.btnText = "Send Request";
    },
    //Login main method with email and passord
    login() {
      if (this.email && this.password) {
        //check if forms are filled in
        this.feedback = null;
        firebase
          .auth()
          .signInWithEmailAndPassword(this.email, this.password)
          .then(cred => {
            //sign user in
            if (firebase.auth().currentUser.phoneNumber !== null) {
              this.$router.push({ name: "Home" }); //check if account is verifed - if not go to phone auth
            } else if (
              firebase.auth().currentUser.uid == "YzA2gHxoX3PJ4Pq8FodQW4Baous2"
            ) {
              //not sure what this does - need to remvoe it
              this.$router.push({ name: "Home" });
            } else {
              this.btnText = "Submit";
              this.emailLogin = false;
              this.phoneAuth = true;
            }
          })
          .catch(err => {
            this.feedback = err.message;
          });
      } else {
        this.feedback = "Please fill in both fields";
      }
    },
    forgotPassword() {
      //send reset email to user
      if (this.email) {
        this.feedback = null;
        firebase
          .auth()
          .sendPasswordResetEmail(this.email)
          .then(cred => {
            this.feedback = "Please check your email and reset your password";
            this.passwordResetForm = false;
            this.emailLogin = true;
          })
          .catch(err => {
            this.feedback = err.message;
          });
      } else {
        this.feedback = "Please enter your email";
      }
    },
    //Send text to user's phone so they can verify their account
    sendOtp() {
      if (this.phNo.length != 10) {
        //check phone number length
        this.feedback = "Please enter a valid phone number";
      } else {
        let countryCode = "+44"; //set the country code for the user - this should probably be var
        let phoneNumber = countryCode + this.phNo;
        let appVerifier = this.appVerifier; //assign verifier
        firebase
          .auth()
          .signInWithPhoneNumber(phoneNumber, appVerifier)
          .then(confirmationResult => {
            //Send sms
            window.confirmationResult = confirmationResult;
            this.feedback = "SMS sent - Please check your phone";
            this.phoneAuth = false;
            this.phoneCode = true;
          })
          .catch(err => {
            this.feedback = err.message;
          });
      }
    },
    //Verify the code
    verifyOtp() {
      if (this.otp.length != 6) {
        this.feedback = "Code is invalid format";
      } else {
        let vm = this;
        let code = this.otp;
        var prevUser = firebase.auth().currentUser;
        //The user entered the correct code
        var credential = firebase.auth.PhoneAuthProvider.credential(
          confirmationResult.verificationId,
          code
        ); //assign the number to the account
        prevUser
          .linkWithCredential(credential)
          .then(usercred => {
            var user = usercred.user;
            vm.$router.push({ name: "Home" });
          })
          .catch(err => {});
      }
    },
    //Set up the captcha that runs the phone auth
    initReCaptcha() {
      setTimeout(() => {
        let vm = this;
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
          "recaptcha-container",
          {
            size: "invisible",
            callback: function(response) {},
            "expired-callback": function() {}
          }
        );
        this.appVerifier = window.recaptchaVerifier;
      }, 1000);
    }
  },
  //When page is created init the Captcha
  created() {
    this.initReCaptcha();
  }
};
</script>

<style>
.slide-fade-enter-active {
  transition: all 0.6s ease;
}
.slide-fade-leave-active {
  transition: all 0.6s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(-20px);
  opacity: 0;
}
.LoginMain {
  background: #d1e8e2;
  display: grid;
  grid-template-columns: 1fr 1fr;
}
.sidebarImage {
  width: 50vw;
  height: 100vh;
  overflow: hidden;
}
.sidebarImage img {
  width: 170%;
  height: 105%;
  margin-bottom: 5%;
  margin-left: -20%;
}
.inputBar {
  width: 50vw;
  height: 100vh;
  text-align: center;
}
.inputBar img {
  padding-top: 9%;
  width: 47%;
}
.heading2 {
  color: #4d4f5c;
  opacity: 0.5;
}
.inputField {
  border: none;
  background: transparent;
  border-bottom: 2px solid #116466;
  margin: 2%;
  padding: 2% 1% 1% 1%;
  width: 47%;
  font-size: 1.2rem;
}
.plainBtn {
  background: transparent;
  border: none;
  cursor: pointer;
  margin-left: 33%;
  margin-top: 2%;
}
.plainBtn:hover {
  color: #116466;
}
.loginBtn {
  background: #116466;
  border: none;
  border-radius: 5px;
  color: #f7f4e9;
  padding: 2% 2%;
  width: 49%;
  margin-top: 4%;
  transition: 0.5s;
  font-size: 1.2rem;
}
.loginBtn:hover {
  background: #008b93;
  transition: 0.5s;
}
.err {
  color: red;
  opacity: 1;
}
</style>
