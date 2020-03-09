import firebase from 'firebase'
import firestore from 'firebase/firestore'

var secondCongif = {
  apiKey: "AIzaSyB_ClCbkCc65_hASqUzQSy2pO1vBk9cZHY",
  authDomain: "dsp-database.firebaseapp.com",
  databaseURL: "https://dsp-database.firebaseio.com",
  projectId: "dsp-database",
  storageBucket: "dsp-database.appspot.com",
  messagingSenderId: "114515194092",
  appId: "1:114515194092:web:a7f9056d6bfce3001375c9"
};
//Initialize Firebase
const secondApp = firebase.initializeApp(secondCongif, 'secondary');

//Export database
export default secondApp.firestore()