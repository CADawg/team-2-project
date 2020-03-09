<template>
    <div class="BoxGrid">
        <div class="box">
            <h3>Current absences</h3>
            <p>{{ curAbs }}</p>
            <span><i :class="curAbsStat"></i></span>
        </div>
        <div class="box">
            <h3>Problem Employees </h3>
            <p>{{ probEmploy }}</p>
            <span><i :class="probEmployStat"></i></span>
        </div>
        <div class="box">
            <h3>Payroll Budget</h3>
            <p>£{{ payroll }}</p>
            <span ><i :class="payrollStat"></i></span>
        </div>
        <div class="box">
            <h3>Employee hours</h3>
            <p>{{ employHours }}</p>
            <span><i :class="employHoursStat"></i></span>
        </div>
    </div>
</template>

<script>
import db from '../../../firebase2/init'
export default {
    name: 'BoxGrid',
    data(){
        return{
            curAbs: 2,
            curAbsStat: 'fas fa-thumbs-up Green',
            probEmploy: 0,
            probEmployStat: 'fas fa-thumbs-down Red',
            payroll: "30k",
            payrollStat: 'fas fa-thumbs-up Green',
            employHours: 150, 
            employHoursStat: 'fas fa-exclamation-triangle Amber',
            start: null,
            end: null 
        }
    },
    created(){
        //Todays absences 
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = dd + '/' + mm + '/' + yyyy;

        let ref1 = db.collection("Absences").where("date","==",today)
        ref1.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.curAbs = this.curAbs + 1
            })
        })

        //Problem employees
        let ref2 = db.collection("employeeEvaluations").where("potential","==","Low")
        ref2.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.probEmploy = this.probEmploy + 1
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
    @media (max-width: 801px) {
        .BoxGrid{
            grid-template-columns: 20vw 20vw 20vw 20vw;
            grid-gap: 3vw;
        }
        .box{
            width: 90%
        }
        .box h3{
            font-size: 1rem;
        }

    }
</style>