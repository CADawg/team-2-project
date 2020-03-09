<template>
    <div>
    <div class="contactDetails">
        <h2>{{ clientID }}</h2>
        <h3>Contact number: {{ contact }}</h3>
       </div>
       <div class="details">
           <ul>
               <li>Project Start Date<br/><span>{{ startDate }}</span></li>
               <li>Project End Date<br/><span>{{ endDate }}</span></li>
               <li>Budget<br/><span>£{{ budget }}</span></li>
               <li>Team member<br/><span>{{ team }}</span></li>
           </ul>
       </div>
    </div>
</template>

<script>
export default {
    name: 'Client1',
    data(){
        return{

        }
    },
    props: [
        'clientID',
        'startDate',
        'endDate',
        'budget',
        'team',
        'contact'
    ],
}
</script>

<style>
    .details{
        width: 100%;
        height: 100%;
        border: 2px solid #383D3B;
        background: #EEE5E9;
    }
    .details li{
        list-style: none;
        font-size: 1rem;
    }
    .details span{
        opacity: 0.5;;
    }
    .contactDetails{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
</style>