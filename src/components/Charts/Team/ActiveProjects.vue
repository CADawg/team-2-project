<template>
    <div class="ClientDet">
            <div class="tabs">
                <ul class="tabHeader">
                    <li class="tab" v-for="(tab,index) in tabs" :key="index">
                        <a @click="selectTab(tab.name)">{{ tab.name }}</a>
                    </li>
                </ul>
            </div>

            <div class="tabs-details">
               <Client1 :clientID ="selectedTab" :startDate="startDate" :endDate="endDate" :budget="budget" :team="team" :contact="contact"/>    
            </div>
    </div>
</template>

<script>
import db from '../../../firebase2/init'
import Client1 from './ClientComp'
export default {
    name: 'ActiveProjects',
    data(){
        return{
            selectedTab: "Costa",
            startDate: '20/03/2020',
            endDate: '25/03/2020',
            budget: 200,
            team: 'Leanne Watt, Greg Sixt, Spice Duncan',
            contact: '07979780542',
            tabs: [
                {
                    name: 'Costa',
                },
                {
                    name: 'ASOS',
                },
                {
                    name: 'Spotify',
                }
            ]
        }
    },
    components: {
        Client1
    },
    methods: {
        selectTab(tab){
            this.selectedTab = tab
            if(tab == "Costa"){
                this.startDate = '20/03/2020',
                this.endDate = '25/03/2020',
                this.budget = 200,
                this.team = 'Leanne Watt, Greg Sixt, Spice Duncan'
            }
            if(tab == "ASOS"){
                this.startDate = '10/03/2020',
                this.endDate = '15/03/2020',
                this.budget = 500,
                this.team = 'Aidan Humpidge, Craig Troup, Spice Duncan'
            }
            if(tab == "Spotify"){
                this.startDate = '10/01/2020',
                this.endDate = '20/05/2020',
                this.budget = 5000,
                this.team = 'Craig Troup, Spice Duncan, Christine Ross, Noel Thompson'
            }
        }
    }
    
}
</script>

<style>
    .tab{
        list-style-type: none;
        display: inline-block;
        padding: 4px 15px;
        cursor: pointer;
        font-size: 1.4rem;
    }
    .tabHeader{
        margin-left: 0%;
        padding: 0;
        border-bottom: 5px solid #383D3B;
    }

    .ClientDet{
        background: #92DCE5;
        padding: 20px;
        width: 40vw;
        height: 58vh;
    }
    @media (max-width: 800px){
        .ClientDet{
            height: 32vh;
        }
    }
</style>