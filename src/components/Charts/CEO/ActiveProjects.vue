<template>
    <div class="ActiveProjects">
        <h2>Active Clients</h2>
        <table>
                <tr>
                    <th>Client Name</th>
                    <th>Country</th>
                    <th>Phone</th>
                </tr>
                <tr v-for="(project, index) in activeProjects" :key="index">
                    <th>{{ project.name }}</th>
                    <th>{{ project.location }}</th>
                    <th>{{ project.number }}</th>
                </tr>
        </table>
    </div>
</template>

<script>
import db from '../../../firebase2/init'
export default {
    name: 'ActiveProjects',
    data(){
        return{
            activeProjects: []
        }
    },
    created(){
        let ref2 = db.collection('contracts').where("status","==","Ongoing")
        ref2.get().then(snapshot => {
            snapshot.forEach(doc => {
                let ref3 = db.collection('clients').where('clientID','==',doc.data().clientID)
                ref3.get().then(snapshot => {
                    snapshot.forEach(doc => {
                        this.activeProjects.push({
                            name: doc.data().clientName,
                            location: doc.data().country,
                            number: doc.data().phoneNumber
                        })
                    })
                })
            })
        })  
    }
}
</script>

<style>
    .ActiveProjects{
        background: #92DCE5;
        padding: 20px;
        width: 40vw;
        margin-top: 5%;
        height: 52vh;
        overflow: scroll;
        
    }
    .ActiveProjects tr:nth-child(1) {
        background: #4bcad1;
    }
    .ActiveProjects {
        overflow-x: auto;
    }
    .ActiveProjects td,
    th {
        border-bottom: 2px solid #383d3b;
        text-align: left;
        padding: 8px;
    }
    @media (max-width: 800px){
        .ActiveProjects{
            height: 32vh;
        }
    }
</style>