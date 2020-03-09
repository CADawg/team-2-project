<template>
    <div class="helpPage">
        <h1>User Guide</h1>
        <h2>Roles</h2>
        <p>There are three main roles for this dashboard:</p>
        <ul>
            <li>CEO</li>
            <li>Department Manager</li>
            <li>Team Leader</li>
        </ul>
        <p>
            The administrator will have allocated you to the appropriate role.<br/>
            All roles have the same functionality, except the Department Manager who can upload Excel files to be added to the database.
        </p>

        <h2>Logging In</h2>
        <p>
            The first time you login, you will be prompted to add your phone number and we will send a text to your phone with a code.<br/>
            Please enter the code on the login page to confirm your identity.<br/>
            If you access the dashboard from another location e.g. if you signed up when in the office then attempt to access at home, you will be prompted to authenticate again.<br/>
        </p>

        <h2>Using the Webapp</h2>
        <p>
            The webapp is responsive which means that it should display correctly on any device. This also means that it will work whether you are holding your device in portrait or landscape orientation.<Br/>
            To navigate, use the options on the left side of the screen. To read the description click on the icon with horizontal lines at the top of the page. 
        </p>
        <p>The main sections are:</p>
        <ul>
            <li>Dashboard (Your main page with data visualisations tailored to your requirements)</li>
            <li>Messages (Company announcements)</li>
            <li>People (Details about the most relevant employees to you)</li>
            <li>Calendar (Important dates of note)</li>
            <li>Help (This user guide)</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Help1',
    data(){
        return{}
    }
}
</script>

<style>
</style>