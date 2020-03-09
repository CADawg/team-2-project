<template>
    <div class="BoxGrid">
        <div class="box">
            <h3>Active Clients</h3>
            <p>{{ totalClients }}</p>
            <span><i :class="clientStat"></i></span>
        </div>
        <div class="box">
            <h3>Ongoing Contracts</h3>
            <p>{{ totalContracts }}</p>
            <span><i :class="contractStat"></i></span>
        </div>
        <div class="box">
            <h3>Projects behind</h3>
            <p>{{ projectBehind }}</p>
            <span ><i :class="projectBehindStat"></i></span>
        </div>
        <div class="box">
            <h3>Monthly Revenue</h3>
            <p>£{{ monthRev }}</p>
            <span><i :class="revStat"></i></span>
        </div>
    </div>
</template>

<script>
import db from '../../../firebase2/init'
export default {
    name: 'BoxGrid',
    data(){
        return{
            totalClients: 0,
            clientStat: 'fas fa-thumbs-up Green',
            totalContracts: 0,
            contractStat: 'fas fa-thumbs-down Red',
            currentStaff: null,
            leftStaff: null,
            projectBehind: 0,
            projectBehindStat: 'fas fa-thumbs-up Green',
            monthRev: 0, 
            revStat: 'fas fa-exclamation-triangle Amber',
            start: null,
            end: null 
        }
    },
    created(){
        //Get revenue between dates
        var startDate = "01/02/2020"
        var endDate = "31/02/2020"
        let ref1 = db.collection("contractsTest").where("startDate", ">", startDate).where("startDate", "<", endDate).where("stat","==","comp")
        ref1.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.monthRev = this.monthRev + parseInt(doc.data().bill)
            })
        })

    
      //Get total active clients
        let ref = db.collection('clients').where("status","==","Active")
        ref.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.totalClients = this.totalClients + 1  
                if(this.totalClients > 25){
                    this.clientStat = 'fas fa-thumbs-up Green'
                }
                if(this.totalClients < 25){
                    this.clientStat = 'fas fa-exclamation-triangle Amber'
                }
                if(this.totalClients < 10 || this.totalClients > 60){
                    this.clientStat = 'fas fa-thumbs-down Red'
                }
            })
        })  
        //Get total ongoing contracts
        let ref2 = db.collection('contractsTest').where("stat","==","ongoing")
        ref2.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.totalContracts = this.totalContracts + 1  
                if(this.totalContracts > 5){
                    this.contractStat = 'fas fa-thumbs-up Green'
                }
                if(this.totalContracts < 5){
                    this.contractStat = 'fas fa-exclamation-triangle Amber'
                }
                if(this.totalContracts < 2 || this.totalContracts > 10){
                    this.contractStat = 'fas fa-thumbs-down Red'
                }
            })
        })  
        //Get contracts behind
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = dd + '/' + mm + '/' + yyyy;
        
        let ref4 = db.collection("contractsTest").where("endDate","<",today).where("stat","==","ongoing")
        ref4.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.projectBehind = this.projectBehind + 1
                if(this.projectBehind > 0){
                    this.projectBehindStat = 'fas fa-thumbs-down Red'
                }
                else{
                    this.projectBehindStat = 'fas fa-thumbs-up Green'
                }
            })
        })

        
        
}
}
</script>

<style>
    .BoxGrid{
        display: grid;
        grid-template-columns: 15vw 15vw 15vw 15vw;
        grid-gap: 5vw;
    }
    .box{
        background: #383D3B;
        width: 15vw;
        color: #fff;
        padding: 5%;
    }
    .box h3{
        padding: 0;
        margin: 0;
        color: #92DCE5;
    }
    .box p{
        padding: 0;
        margin: 0;
        font-size:2.5rem;
       
        display: inline-block
    }
    .box span{
        font-size: 3rem;
        display: inline-block;
        float: right;
    }
    .Green{
        color: #67C23A;
    }
    .Amber{
        color: #E6A23C;
    }
    .Red{
        color: #FF6060;
    }
</style>