<template>
  <div>
      <!-- Navbar -->
      <Navbar></Navbar>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import { BounceLoader } from "@saeris/vue-spinners";
import moment from "moment";
import Navbar from './navbar';
export default {
  components: {
    vSelect,
    BounceLoader,
    Navbar,
  },
  data() {
    return {
    };
  },

  methods: {

  }
};
</script>
