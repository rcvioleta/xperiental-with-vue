<template>
  <div class="card card-md">
    <div class="card-header">
      Sales Overview
      <div class="header-btn-block">
        <span class="data-range dropdown">
          <a
            href="#"
            class="btn btn-primary dropdown-toggle waves-effect waves-light"
            id="navbar-dropdown-sales-overview-header-button"
            data-toggle="dropdown"
            data-flip="false"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="batch-icon batch-icon-calendar"></i>
          </a>
          <div
            class="dropdown-menu dropdown-menu-right"
            aria-labelledby="navbar-dropdown-sales-overview-header-button"
          >
            <a class="dropdown-item" href="today.html">Today</a>
            <a class="dropdown-item" href="week.html">This Week</a>
            <a class="dropdown-item" href="month.html">This Month</a>
            <a class="dropdown-item active" href="year.html">This Year</a>
          </div>
        </span>
      </div>
    </div>
    <div class="card-body" v-show="highest_revenue">
      <div class="revenue-stats" v-for="(data, index) in revenue_data" :key="index">
        <div>{{ data.enrolled_date }}</div>
        <div class="progress-background">
          <div
            class="real-progress"
            :style="{width: `${Math.round(100 - (1 - (data.revenue / highest_revenue)) * 100)}%`}"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["revenue_data"],
  data() {
    return {
      highest_revenue: ""
    };
  },
  created() {
    const revenues = this.revenue_data.map(data => data.revenue);
    this.highest_revenue = Math.max(...revenues);
  },
  methods: {}
};
</script>

<style>
.revenue-stats {
  display: flex;
}

.progress-background {
  background: #eee;
  width: 100%;
  height: 20px;
  margin-top: 1.5rem;
  align-self: flex-end;
}

.real-progress {
  background: linear-gradient(to right, #23c8cf, #11b3db);
  height: inherit;
}
</style>
