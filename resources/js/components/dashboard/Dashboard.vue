<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Dashboard</h1>
            </b-col>
        </b-row>
        <b-row class="pb-3 pt-3">
            <b-col>
                <b-card class="card-xs bg-primary bg-gradient mycard">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-users batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{ studentcount }}</div>
                        <div class="tile-description">Active Students</div>
                    </div>
                </b-card>
            </b-col>
            <b-col>
                <b-card class="card-xs bg-secondary bg-gradient mycard">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">₱{{ balance }}</div>
                        <div class="tile-description">Total Balance</div>
                    </div>
                </b-card>
            </b-col>
            <b-col>
                <b-card class="card-xs bg-primary bg-gradient mycard">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-list batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{ schedulecount }}</div>
                        <div class="tile-description">Class Schedules this {{ currentmonth }}</div>
                    </div>
                </b-card>
            </b-col>
            <b-col>
                <b-card class="card-xs bg-secondary bg-gradient mycard">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-star batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{ instructorcount }}</div>
                        <div class="tile-description">Active Instructors</div>
                    </div>
                </b-card>
            </b-col>
        </b-row>
        <b-row class="pt-4">
            <b-col cols="8">
                <b-card>
                    <h2>Classes this {{ currentmonth }}</h2>
                    <hr>
                    <canvas id="chart1"></canvas>
                </b-card>
            </b-col>
            <b-col cols="4">
                <b-card>
                    <h2>Classes this {{ currentmonth }}</h2>
                    <hr>
                    <canvas id="chart2"></canvas>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
    import Chart from 'chart.js';    

    export default {
        data() {
            return {
                currentmonth: '',
                studentcount: '',
                instructorcount: '',
                schedulecount: '',
                balance: '',
                subjects: '',
            }
        },
        created() {
            this.getData();
        },
        methods: {
            getData() {
                axios.get('./admin/getdashboard')
                .then(response => {
                    this.currentmonth = response.data.currentmonth;
                    this.studentcount = response.data.studentcount;
                    this.instructorcount = response.data.instructorcount;
                    this.schedulecount = response.data.schedulecount;
                    this.schedulecount = response.data.schedulecount;
                    this.balance = this.formatPrice(response.data.balance);
                    this.subjects = response.data.subjects;

                    this.createChart("chart1", this.graphData(this.subjects, 'bar'));
                    this.createChart("chart2", this.graphData(this.subjects, 'doughnut'));
                })
                .catch(err=>{
                    console.log("error", err);
                });
            },
            formatPrice(value) {
                var data = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return data;
            },
            createChart(id, chartData) {
                var ctx = document.getElementById(id);

                var myChart = new Chart(ctx, {
                    type: chartData.type,
                    data: chartData.data,
                    options: chartData.options,
                });
            },
            graphData(data, type) {

                var dataName = [];
                var dataTotal = [];
                var randColor = [];
                var xtraoScale = '';
                var xtraLegend = true;

                Object.keys(data).forEach(key => {
                    dataName.push(data[key]['name'] + ": " + data[key]['total']);
                    dataTotal.push(data[key]['total']);
                    randColor.push("hsl(" + Math.random() * 360 + ", 100%, 70%)");
                });

                if(type == 'bar') {
                    xtraoScale = {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                padding: 25, 
                            } 
                        }] 
                    };

                    xtraLegend = false;
                }

                const result = {
                    type: type,
                    data: {
                        labels: dataName,
                        datasets: [
                        {
                            "data": dataTotal,
                            "backgroundColor": randColor,
                        }]
                    },
                    options: {
                        responsive: true,
                        cutoutPercentage: 0,
                        scales: xtraoScale,
                        legend: {
                            display: xtraLegend
                        },
                    }
                }

                return result;
            },
        }
    }
</script>
<style type="text/css">
    .mycard {
        border-radius: 10px;
        border-width: 0px;
    }
    .mycard .card-body {
        padding: 1.5rem!important;
    }
</style>