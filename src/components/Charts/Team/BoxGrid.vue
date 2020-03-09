<template>
    <div class="BoxGrid">
        <div class="box">
            <h3>Deadlines upcoming</h3>
            <p>{{ dead }}</p>
            <span><i :class="deadStat"></i></span>
        </div>
        <div class="box">
            <h3>Problem Employees </h3>
            <p>{{ probEmploy }}</p>
            <span><i :class="probEmployStat"></i></span>
        </div>
        <div class="box">
            <h3>Projects over budget</h3>
            <p>{{ proBud }}</p>
            <span ><i :class="proBudStat"></i></span>
        </div>
        <div class="box">
            <h3>projects overdue</h3>
            <p>{{ proOver }}</p>
            <span><i :class="proOverStat"></i></span>
        </div>
    </div>
</template>

<script>
import db from '../../../firebase2/init'
export default {
    name: 'BoxGrid',
    data(){
        return{
            dead: 1,
            deadStat: 'fas fa-exclamation-triangle Amber',
            probEmploy: 3,
            probEmployStat: 'fas fa-thumbs-down Red',
            proBud: "0",
            proBudStat: 'fas fa-thumbs-up Green',
            proOver: 1, 
            proOverStat: 'fas fa-thumbs-down Red',
        }
    },
    created(){
        
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