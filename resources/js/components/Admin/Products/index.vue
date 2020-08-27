<template>
  <div>
      <!-- Navbar -->
      <Navbar></Navbar>


      <!-- Products -->
      <products></products>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import { BounceLoader } from "@saeris/vue-spinners";
import moment from "moment";
import Navbar from '../navbar';
import Products from './products';
export default {
  components: {
    vSelect,
    BounceLoader,
    Navbar,
    Products
  },
  data() {
    return {
    };
  },

  methods: {

  }
};
</script>
