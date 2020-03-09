<template>
    <div class="contactContainer">
        <h1>My Employee Circle</h1>
        <input type="text" v-model="search" placeholder="Search by name" class="searchBox" />
        <div class="contactList">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Absence Level</th>
                    <th>Position</th>
                    <th>Team(s)</th>
                </tr>
                <tr v-for="(contact,index) in filteredList" :key="index">
                    <th>{{ contact.name }}</th>
                    <th>{{ contact.email }}</th>
                    <th>{{ contact.moblie }}</th>
                    <th>
                        <span :class="contact.class">{{ contact.absenceLevel }}</span>
                    </th>
                    <th>{{ contact.position }}</th>
                    <th>
                        <span
                            v-for="(team,index) in contact.teams"
                            :key="index"
                            class="teams"
                            :data-status="team"
                        >{{ team }}</span>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContactList",
    data() {
        return {
            contacts: [
                //This can be pulled from the database with mroe time
                {
                    name: "Daniel Mackenzie",
                    moblie: "07979780542",
                    email: "d.mackenzie@adelphi.com",
                    absenceLevel: "Low",
                    class: "Low",
                    position: "HR Manager",
                    teams: ["Management", "HR"]
                },
                {
                    name: "Leanne Watt",
                    moblie: "07979780542",
                    email: "l.watt@adelphi.com",
                    absenceLevel: "Average",
                    class: "Average",
                    position: "Design Consultant",
                    teams: ["Design", "Costa", "ASOS"]
                },
                {
                    name: "Jacqui Gellatly",
                    moblie: "07979780542",
                    email: "j.gellatly@adelphi.com",
                    absenceLevel: "High",
                    class: "High",
                    position: "Sales Assistant Manager",
                    teams: ["Management", "Sales"]
                },
                {
                    name: "Pamela Adamiec",
                    moblie: "07979780542",
                    email: "p.adamiec@adelphi.com",
                    absenceLevel: "Low",
                    class: "Low",
                    position: "HR Consultant",
                    teams: ["HR"]
                },
                {
                    name: "Noel Thompson",
                    moblie: "07979780542",
                    email: "n.thompson@adelphi.com",
                    absenceLevel: "High",
                    class: "High",
                    position: "Project Manager",
                    teams: ["Management", "Costa", "ASOS"]
                },
                {
                    name: "Sam French",
                    moblie: "07979780542",
                    email: "s.french@adelphi.com",
                    absenceLevel: "Average",
                    class: "Average",
                    position: "Prototype Designer",
                    teams: ["Design"]
                },
                {
                    name: "Spice Duncan",
                    moblie: "07979780542",
                    email: "s.duncan@adelphi.com",
                    absenceLevel: "Low",
                    class: "Low",
                    position: "Lead Designer",
                    teams: ["Management","Design"]
                },
                {
                    name: "Christine Ross",
                    moblie: "07979780542",
                    email: "c.ross@adelphi.com",
                    absenceLevel: "Low",
                    class: "Low",
                    position: "VP Sales",
                    teams: ["Management"]
                },
                {
                    name: "Dwight Schrute",
                    moblie: "07979780542",
                    email: "d.schrute@adelphi.com",
                    absenceLevel: "Low",
                    class: "Low",
                    position: "Assistant to the Regional Manager",
                    teams: ["Management"]
                },
                {
                    name: "Greg Sixt",
                    moblie: "07979780542",
                    email: "g.sixt@adelphi.com",
                    absenceLevel: "High",
                    class: "High",
                    position: "Project Manager",
                    teams: ["Management"]
                }

            ],
            search: ""
        };
    },
    created() {
        //When pulling data from database check the absenceLevel and apply class name
    },
    computed: {
        filteredList() {
            return this.contacts.filter(contact => {
                return contact.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    }
};
</script>

<style>
.contactContainer {
    margin: 5%;
}
.contactList table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
.contactList tr:nth-child(1) {
    background: #4bcad1;
}
.contactList {
    overflow-x: auto;
}
.contactList td,
th {
    border-bottom: 2px solid #4bcad1;
    text-align: left;
    padding: 8px;
}
.Low,
.Average,
.High {
    padding: 5px;
    border-radius: 5px;
}
.Low {
    background: #67c23a;
}
.Average {
    background: #e6a23c;
}
.High {
    background: #e40c2b;
}
.teams {
    margin-left: 10px;
    padding: 5px;
    border-radius: 5px;
    background: #4bcad1;
    color: #fff;
    font-size: 0.9rem;
}
.teams[data-status="Management"] {
    background: #0486fe;
}
.teams[data-status="HR"] {
    background: #7e3439;
}
.teams[data-status="Design"] {
    background: #10ab3e;
}
.teams[data-status="Costa"] {
    background: #ab1044;
}
.teams[data-status="ASOS"] {
    background: #1081ab;
}
.teams[data-status="Sales"] {
    background: #ab10a1;
}
.searchBox {
    background: #383d3b;
    border: 2px solid #383d3b;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    float: right;
    margin-top: -5%;
}
@media (max-width: 800px) {
    .searchBox {
        float: inherit;
        margin-bottom: 10px;
    }
}
</style>