import firebase from 'firebase'
import firestore from 'firebase/firestore'

// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyAvvVPTFpo1OvIR6SB6UeJ6yob1rxi30UQ",
    authDomain: "dsploginsystem.firebaseapp.com",
    databaseURL: "https://dsploginsystem.firebaseio.com",
    projectId: "dsploginsystem",
    storageBucket: "dsploginsystem.appspot.com",
    messagingSenderId: "590092025862",
    appId: "1:590092025862:web:9980cf99d515bdaf268387"
};

//Initialize Firebase
const firebaseApp = firebase.initializeApp(firebaseConfig);

//Export database
export default firebaseApp.firestore()