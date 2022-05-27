<template>
<div class="dashboard">
    <menu__2 />

    <main class="content-wrap">

        <div class="content" v-if="stats">
            <section class="info-boxes">
                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M21 20V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1zm-2-1H5V5h14v14z" />
                            <path d="M10.381 12.309l3.172 1.586a1 1 0 0 0 1.305-.38l3-5-1.715-1.029-2.523 4.206-3.172-1.586a1.002 1.002 0 0 0-1.305.38l-3 5 1.715 1.029 2.523-4.206z" /></svg>
                    </div>

                    <div class="box-content">
                        <span class="big">{{stats.emp}}</span>
                        Employées
                    </div>
                </div>

                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M20 10H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1zm-1 10H5v-8h14v8zM5 6h14v2H5zM7 2h10v2H7z" /></svg>
                    </div>

                    <div class="box-content">
                        <span class="big">{{stats.mat}}</span>
                        Matériels
                    </div>
                </div>

                <div class="info-box active">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3,21c0,0.553,0.448,1,1,1h16c0.553,0,1-0.447,1-1v-1c0-3.714-2.261-6.907-5.478-8.281C16.729,10.709,17.5,9.193,17.5,7.5 C17.5,4.468,15.032,2,12,2C8.967,2,6.5,4.468,6.5,7.5c0,1.693,0.771,3.209,1.978,4.219C5.261,13.093,3,16.287,3,20V21z M8.5,7.5 C8.5,5.57,10.07,4,12,4s3.5,1.57,3.5,3.5S13.93,11,12,11S8.5,9.43,8.5,7.5z M12,13c3.859,0,7,3.141,7,7H5C5,16.141,8.14,13,12,13z" /></svg>
                    </div>

                    <div class="box-content">
                        <span class="big">{{stats.Pemp}}</span>
                        Pointage des employées
                        <br>par jour
                    </div>
                </div>

                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z" /></svg>
                    </div>

                    <div class="box-content">
                        <span class="big">{{stats.Pmat}}</span>
                        Pointage matériel
                    </div>

                </div>
                <div class="info-box">
                    <!-- <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z" /></svg>
                    </div> -->
                    <div>
                        <!-- <i class='bx bxs-user-check' id="iconDep"></i> -->
                        <i class='bx bx-money' id="iconDep"></i>
                    </div>
                    <div class="box-content">
                        <span class="big">{{stats.dep}}</span>
                        Dépenses du jour
                    </div>

                </div>
            </section>

        </div>
    </main>

    <div class="chart_">
        <div class="chart_content">
            <h3 class="H3_style"> Matériels les plus demandé</h3>
            <canvas id="myChart1" width="100%" height="100%"></canvas>
        </div>
        <div class="chart_content">
            <h3 class="H3_style"> Employées très présent</h3>
            <canvas id="myChart2" width="100%" height="100%"></canvas>
        </div>

    </div>
    <div class="chart_">
        <div class="chart_content">
            <h3 class="H3_style"> Matériels les plus demandé</h3>
            <canvas id="myChart3" width="100%" height="100%"></canvas>
        </div>
        <div class="chart_content">
            <h3 class="H3_style"> Matériels les plus demandé</h3>
            <canvas id="myChart4" width="100%" height="100%"></canvas>
        </div>

    </div>
</div>
</template>

<script>
import menu__2 from "../menu/menu.vue";
// import VueApexCharts from 'vue-apexcharts'
import axios from "axios";
import Chart from "chart.js/auto";

export default {
    components: {
        menu__2
        // VueApexCharts
    },
    data() {
        return {
            status: 1,
            stats: false
        };
    },
    methods: {
        async load() {
            let res = await axios.get('/stats/get/');
            this.stats = res.data;
            this.load_charts();
        },
        load_charts() {
            const ctx1 = document.getElementById('myChart1').getContext('2d');
            const ctx2 = document.getElementById('myChart2').getContext('2d');
            const ctx3 = document.getElementById('myChart3').getContext('2d');
            const ctx4 = document.getElementById('myChart4').getContext('2d');

            let data_1 = {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: '# of Votes',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }
            let data_2 = {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: '# of Votes',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }
            let data_3 = {
                labels: [],
                datasets: [{
                    label: 'My First Dataset',
                    data: [],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };
            let data_4 = {
                labels: [],
                datasets: [{
                    label: 'My First Dataset',
                    data: [],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            let i = 0;
            for (i = 0; i < this.stats.chart1.length; i++) {
                data_1.data.labels.push(this.stats.chart1[i].marqueM)
                data_1.data.datasets[0].data.push(this.stats.chart1[i].count1)
            }

            for (i = 0; i < this.stats.chart2.length; i++) {
                data_2.data.labels.push(this.stats.chart2[i].nom + " " + this.stats.chart2[i].prenom)
                data_2.data.datasets[0].data.push(this.stats.chart2[i].count1)
            }
            for (i = 0; i < this.stats.chart3.length; i++) {
                data_3.labels.push(this.stats.chart3[i].libelleMateriel)
                data_3.datasets[0].data.push(this.stats.chart3[i].count1)
            }
            for (i = 0; i < this.stats.chart4.length; i++) {
                data_4.labels.push(this.stats.chart4[i].libelleFonction)
                data_4.datasets[0].data.push(this.stats.chart4[i].count1)
            }
            let config3 = {
                type: 'doughnut',
                data: data_3,
            };
            let config4 = {
                type: 'doughnut',
                data: data_4,
            };
            let myChart1 = new Chart(ctx1, data_1);
            let myChart2 = new Chart(ctx2, data_2);
            let myChart3 = new Chart(ctx3, config3);
            let myChart4 = new Chart(ctx4, config4);

        }
    },
    mounted() {
        this.load();

    },

    computed: {}
}
</script>

<style>
.chart_ {
    background: white;
    width: 100%;
    height: max-content;
    padding: 0 3em;
    margin-top: 10px;
    display: inline-flex;
    justify-content: space-between;
    height: max-content;

}

.chart_ .chart_content {
    height: max-content;
    width: 45%;
}

#myChart1,
#myChart2 {
    height: 100%;
    width: 100%;
}

.dashboard {
    width: 100%;
    height: 100%;
    grid-gap: 0;
    grid-template-columns: 300px auto;
    grid-template-rows: 80px auto;
    grid-template-areas: 'menu search', 'menu content';
}

.search-wrap {
    grid-area: search;
    background: #fff;
    border-bottom: 1px solid #ede8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 3em;
}

.search-wrap .search {
    height: 40px;
}

.search-wrap .search label {
    display: flex;
    align-items: center;
    height: 100%;
}

.search-wrap .search label svg {
    display: block;
}

.search-wrap .search label svg path,
.search-wrap .search label svg circle {
    fill: #b6bbc6;
    transition: fill 0.15s ease;
}

.search-wrap .search label input {
    display: block;
    padding-left: 1em;
    height: 100%;
    margin: 0;
    border: 0;
}

.search-wrap .search label input:focus {
    background: #f5f5fa;
}

.search-wrap .search label:hover svg path,
.search-wrap .search label:hover svg circle {
    fill: #2b3a60;
}

.search-wrap .user-actions button {
    border: 0;
    background: none;
    width: 32px;
    height: 32px;
    margin: 0;
    padding: 0;
    margin-left: 0.5em;
}

.search-wrap .user-actions button svg {
    position: relative;
    top: 2px;
}

.search-wrap .user-actions button svg path,
.search-wrap .user-actions button svg circle {
    fill: #b6bbc6;
    transition: fill 0.15s ease;
}

.search-wrap .user-actions button:hover svg path,
.search-wrap .user-actions button:hover svg circle {
    fill: #2b3a60;
}

.menu-wrap {
    grid-area: menu;
    padding-bottom: 3em;
    overflow: auto;
    background: #fff;
    border-right: 1px solid #ede8f0;
}

.menu-wrap .user {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin: 0;
    padding: 0 3em;
}

.menu-wrap .user .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
}

.menu-wrap .user .user-avatar img {
    display: block;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.menu-wrap .user figcaption {
    margin: 0;
    padding: 0 0 0 1em;
    color: #1b253d;
    font-weight: 700;
    font-size: 0.875em;
    line-height: 100%;
}

.menu-wrap nav {
    display: block;
    padding: 0 3em;
}

.menu-wrap nav section {
    display: block;
    padding: 3em 0 0;
}

.menu-wrap nav h3 {
    margin: 0;
    font-size: 0.875em;
    text-transform: uppercase;
    color: #4b84fe;
    font-weight: 600;
}

.menu-wrap nav ul {
    display: block;
    padding: 0;
    margin: 0;
}

.menu-wrap nav li {
    display: block;
    padding: 0;
    margin: 1em 0 0;
}

.menu-wrap nav li a {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    color: #99a0b0;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875em;
    transition: color 0.15s ease;
}

.menu-wrap nav li a svg {
    display: block;
    margin-right: 1em;
}

.menu-wrap nav li a svg path,
.menu-wrap nav li a svg circle {
    fill: #b6bbc6;
    transition: fill 0.15s ease;
}

.menu-wrap nav li a:hover {
    color: #1b253d;
}

.menu-wrap nav li a:hover svg path,
.menu-wrap nav li a:hover svg circle {
    fill: #2b3a60;
}

.menu-wrap nav li a.active {
    color: #4b84fe;
}

.menu-wrap nav li a.active svg path,
.menu-wrap nav li a.active svg circle {
    fill: #4b84fe;
}

.content-wrap {
    position: relative;
    grid-area: content;
    padding: 3em;
    width: 100%;
    /* overflow: auto; */
}

.content-wrap .content-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.content-wrap .content-head h1 {
    font-size: 1.375em;
    line-height: 100%;
    color: #1b253d;
    font-weight: 500;
    margin: 0;
    padding: 0;
}

.content-wrap .content-head .action button {
    border: 0;
    background: #4b84fe;
    color: #fff;
    width: auto;
    height: 3.5em;
    padding: 0 2.25em;
    border-radius: 3.5em;
    font-size: 1em;
    text-transform: uppercase;
    font-weight: 600;
    transition: background-color 0.15s ease;
}

.content-wrap .content-head .action button:hover {
    background-color: #1861fe;
}

.content-wrap .content-head .action button:hover:active {
    background-color: #0149e2;
    transition: none;
}

.content-wrap .info-boxes {
    padding: 3em 0 2em;
    display: flex;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    grid-gap: 2em;
}

.content-wrap .info-boxes .info-box {
    background: #fff;
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 3em;
    border: 1px solid #ede8f0;
    border-radius: 5px;
}

.content-wrap .info-boxes .info-box .box-icon svg {
    display: block;
    width: 48px;
    height: 48px;
}

.content-wrap .info-boxes .info-box .box-icon svg path,
.content-wrap .info-boxes .info-box .box-icon svg circle {
    fill: #99a0b0;
}

.content-wrap .info-boxes .info-box .box-content {
    padding-left: 1.25em;
    white-space: nowrap;
}

.content-wrap .info-boxes .info-box .box-content .big {
    display: block;
    font-size: 2em;
    line-height: 150%;
    color: #1b253d;
}

.content-wrap .info-boxes .info-box.active svg circle,
.content-wrap .info-boxes .info-box.active svg path {
    fill: #4b84fe;
}

.content-wrap .person-boxes {
    padding: 0;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    grid-gap: 2em;
}

.content-wrap .person-boxes .person-box {
    background: #fff;
    height: 320px;
    text-align: center;
    padding: 3em;
    border: 1px solid #ede8f0;
    border-radius: 5px;
}

.content-wrap .person-boxes .person-box:nth-child(2n) .box-avatar .no-name {
    background: #4b84fe;
}

.content-wrap .person-boxes .person-box:nth-child(5n) .box-avatar .no-name {
    background: #ffbb09;
}

.content-wrap .person-boxes .person-box .box-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
}

.content-wrap .person-boxes .person-box .box-avatar img {
    display: block;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.content-wrap .person-boxes .person-box .box-avatar .no-name {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    font-size: 1.5em;
    font-weight: 600;
    text-transform: uppercase;
    width: 100%;
    height: 100%;
    background: #fa5b67;
}

.content-wrap .person-boxes .person-box .box-bio {
    white-space: no-wrap;
}

.content-wrap .person-boxes .person-box .box-bio .bio-name {
    margin: 2em 0 0.75em;
    color: #1b253d;
    font-size: 1em;
    font-weight: 700;
    line-height: 100%;
}

.content-wrap .person-boxes .person-box .box-bio .bio-position {
    margin: 0;
    font-size: 0.875em;
    line-height: 100%;
}

.content-wrap .person-boxes .person-box .box-actions {
    margin-top: 1.25em;
    padding-top: 1.25em;
    width: 100%;
    border-top: 1px solid #ede8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.content-wrap .person-boxes .person-box .box-actions button {
    border: 0;
    background: none;
    width: 32px;
    height: 32px;
    margin: 0;
    padding: 0;
}

.content-wrap .person-boxes .person-box .box-actions button svg {
    position: relative;
    top: 2px;
}

.content-wrap .person-boxes .person-box .box-actions button svg path,
.content-wrap .person-boxes .person-box .box-actions button svg circle {
    fill: #b6bbc6;
    transition: fill 0.15s ease;
}

.content-wrap .person-boxes .person-box .box-actions button:hover svg path,
.content-wrap .person-boxes .person-box .box-actions button:hover svg circle {
    fill: #2b3a60;
}

.H3_style {
    text-align: center;
    font-family: cursive;
    font-size: 30px;
    margin-bottom: 10px;
    color: darkblue;

}

#iconDep {
    font-size: 69px !important;
    color: darkolivegreen;
}
</style>
