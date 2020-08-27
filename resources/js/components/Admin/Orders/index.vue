<template>
  <div>
      <!-- Navbar -->
      <Navbar></Navbar>


      <!-- Products -->
      <orders></orders>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import { BounceLoader } from "@saeris/vue-spinners";
import moment from "moment";
import Navbar from '../navbar';
import Orders from './orders';
export default {
  components: {
    vSelect,
    BounceLoader,
    Navbar,
    Orders
  },
  data() {
    return {
    };
  },

  methods: {

  }
};
</script>
