<template>
  <div class="background-dashboard">
    <img src="/img/bg13.jpg" style="width: 100%">
    <h1 class="welcome-admin typed-out">Chào mừng bạn đến với trang quản trị website!</h1>
  </div>
</template>
<script>
import Card from "../components/layouts/Cards/Card.vue"
import NTable from "../components/layouts/Table.vue"
import AnimatedNumber from "../components/layouts/AnimatedNumber.vue"
import NProgress from "../components/layouts/Progress.vue"


import LineChart from "../components/layouts/Charts/LineChart";

export default {
  components: {
    Card,
    NTable,
    AnimatedNumber,
    LineChart,
    NProgress,
  },
  data() {
    return {};
  },
};
</script>
<style>
    .welcome-admin {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      text-align: center;
      color: #fff;
      text-transform: uppercase;
    }
    .typed-out{
      overflow: hidden;
      border-right: .15em solid orange;
      white-space: nowrap;
      animation: typing 5s steps(56, end) forwards;
      font-size: 1.6rem;
      width: 0;
    }
    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }
</style>
